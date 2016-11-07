<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\OrderItem;

/**
 * Class OrderItemTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['product'];

    /**
     * Transform the \OrderItem entity
     * @param \OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model)
    {
        return [
            'price'         => $model->price,
            'qtd'           => $model->qtd
        ];
    }

    public function includeProduct(OrderItem $order)
    {
        return $this->item($order->product, new ProductTransformer());
    }
}
