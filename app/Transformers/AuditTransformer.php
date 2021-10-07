<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\Audit;

/**
 * Class AuditTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class AuditTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['user'];
    /**
     * Transform the Audit entity.
     *
     * @param \ApiWebPsp\Models\Audit $model
     *
     * @return array
     */
    public function transform(Audit $model)
    {
        return [
            'id'         => $model->id,
            'user_type' => $model->user_type,
            'event' => $model->event,
            'auditable_type' => $model->auditable_type,
            'auditable_id' => $model->auditable_id,
            'old_values' => $model->old_values,
            'new_values' => $model->new_values,
            'url' => $model->url,
            'ip_address' => $model->ip_address,
            'user_agent' => $model->user_agent,
            'tags' => $model->tags,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    /**
     * @param Audit $audit
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Audit $audit)
    {
        return $this->item($audit->user, new UserTransformer());
    }
}
