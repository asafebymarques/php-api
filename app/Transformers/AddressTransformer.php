<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\Address;

/**
 * Class AddressTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class AddressTransformer extends TransformerAbstract
{
    /**
     * Transform the Address entity.
     *
     * @param \ApiWebPsp\Models\Address $model
     *
     * @return array
     */
    public function transform(Address $model)
    {
        return [
            'id'         => $model->id,
            'alias'         => $model->alias,
            'street' => $model->street,
            'number' => $model->number,
            'complement' => $model->complement,
            'neighborhood' => $model->neighborhood,
            'postal_code' => $model->postal_code,
            'type' => $model->type,
            'city' => $model->city,
            'uf' => $model->uf,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
