<?php

namespace Delivery\Transformers;

use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;
use Delivery\Models\Order;

/**
 * Class OrderTransformerTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes   = ['cupom','items', 'client'];

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'            => $model->id,
            'total'         => $model->total,
            'product_names' => $this->getArrayProductNames($model->items),
            'status'        => $model->status,
            'created_at'    => $model->created_at
        ];
    }

    protected function getArrayProductNames(Collection $items){
        $names = [];

        foreach ($items as $item){
            $names[] = $item->product->name;
        }

        return $names;
    }

    public function includeClient(Order $order)
    {
        return $this->item($order->client, new ClientTransformer());
    }

    public function includeCupom(Order $order)
    {
        if(!$order->cupom){
            return null;
        }
        return $this->item($order->cupom, new CupomTransformer());
    }

    public function includeItems(Order $order)
    {
        return $this->collection($order->items, new OrderItemTransformer());
    }
}
