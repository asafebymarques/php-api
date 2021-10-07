<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\Receiver;

/**
 * Class ReceiverTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class ReceiverTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['address','contact','authorized'];

    /**
     * Transform the Receiver entity.
     *
     * @param \ApiWebPsp\Models\Receiver $model
     *
     * @return array
     */
    public function transform(Receiver $model)
    {
        return [
            'id'         => $model->id,
            'name' => $model->name,
            'document' => $model->document,
            'genre' => $model->genre,
            'date_birth' => $model->date_birth,
            'brand' => $model->brand,
            'type' => $model->type,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    /**
     * @param Receiver $receiver
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeAddress(Receiver $receiver)
    {
        return $receiver->addresses ? $this->collection($receiver->addresses, new AddressTransformer()) : null;
    }

    /**
     * @param Receiver $receiver
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeContact(Receiver $receiver)
    {
        return $receiver->receiver_contacts ? $this->collection($receiver->receiver_contacts, new ReceiverContactTransformer()) : null;
    }

    /**
     * @param Receiver $receiver
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeAuthorized(Receiver $receiver)
    {
        return $receiver->authorized_people ? $this->collection($receiver->authorized_people, new AuthorizedPersonTransformer()) : null;
    }


}
