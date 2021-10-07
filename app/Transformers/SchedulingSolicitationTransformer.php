<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\SchedulingSolicitation;

/**
 * Class SchedulingSolicitationTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class SchedulingSolicitationTransformer extends TransformerAbstract
{
    /**
     * Transform the SchedulingSolicitation entity.
     *
     * @param \ApiWebPsp\Models\SchedulingSolicitation $model
     *
     * @return array
     */
    public function transform(SchedulingSolicitation $model)
    {
        return [
            'id'         => $model->id,
            'date_scheduling' => $model->date_scheduling,
            'date_canceled' => $model->date_canceled,
            'schedule_time' => $model->schedule_time,
            'user_create' => $model->user_create,
            'user_canceled' => $model->user_canceled,
            'period' => $model->period,
            'status' => $model->status,
            'note' => $model->note,
            'auth_contact' => $model->auth_contact,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
