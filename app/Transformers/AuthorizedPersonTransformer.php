<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\AuthorizedPerson;

/**
 * Class AuthorizedPersonTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class AuthorizedPersonTransformer extends TransformerAbstract
{
    /**
     * Transform the AuthorizedPerson entity.
     *
     * @param \ApiWebPsp\Models\AuthorizedPerson $model
     *
     * @return array
     */
    public function transform(AuthorizedPerson $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'document' => $model->document,
            'phone' => $model->phone,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
