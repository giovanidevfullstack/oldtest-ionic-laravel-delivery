<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Order;

/**
 * Class OrderTransformerTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes   = ['cupom','items'];

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
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
