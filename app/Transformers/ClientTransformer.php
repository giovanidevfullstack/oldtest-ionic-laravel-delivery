<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Client;

/**
 * Class ClientTransformer
 * @package namespace App\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

    /**
     * Transform the \client entity
     * @param \client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id'         => (int) $model->id,
            'phone'      => $model->phone,
            'address'    => $model->address,
            'city'       => $model->city,
            'state'      => $model->state,
            'zipcode'    => $model->zipcode,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
