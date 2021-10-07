<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\Capability;

/**
 * Class CapabilityTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class CapabilityTransformer extends TransformerAbstract
{
    /**
     * Transform the Capability entity.
     *
     * @param \ApiWebPsp\Models\Capability $model
     *
     * @return array
     */
    public function transform(Capability $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
