<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\StatusCompany;

/**
 * Class StatusCompanyTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class StatusCompanyTransformer extends TransformerAbstract
{
    /**
     * Transform the StatusCompany entity.
     *
     * @param \ApiWebPsp\Models\StatusCompany $model
     *
     * @return array
     */
    public function transform(StatusCompany $model)
    {
        return [
            'id'         => (int) $model->id,
            'status' => $model->status,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
