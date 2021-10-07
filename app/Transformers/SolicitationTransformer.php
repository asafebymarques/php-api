<?php

namespace ApiWebPsp\Transformers;

use ApiWebPsp\Models\AuthorizedPeopleSolicitation;
use ApiWebPsp\Models\User;
use ApiWebPsp\Models\Address;
use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\Solicitation;

/**
 * Class SolicitationTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class SolicitationTransformer extends TransformerAbstract
{
    /**
     * @var array include relationships
     */
    protected $defaultIncludes = ['receiver','items','company','scheduling','address','user','attempts','authorized'];

    /**
     * Transform the Solicitation entity.
     *
     * @param \ApiWebPsp\Models\Solicitation $model
     *
     * @return array
     */
    public function transform(Solicitation $model)
    {
        return [
            'id' => $model->id,
            'voucher' => $model->voucher,
            'document' => $model->document,
            'pi' => $model->pi,
            'cod_tp_estoque' =>$model->cod_tp_estoque,
            'information' => $model->information,
            'parkinglist' => $model->parkinglist,
            'center_number' => $model->center_number,
            'description_other_type' => $model->description_other_type,
            'type' => $model->type,
            'observation' => $model->observation,
            'status' => $model->status,
            'sends' => $model->sends,
            'parcial' => $model->parcial,
            /* place your other model properties here */
            'data_atendimento' => $model->data_atendimento,
            'data_despachado' => $model->data_despachado,
            'data_pendente' => $model->data_pendente,
            'data_concluido' => $model->data_concluido,
            'data_frustado' => $model->data_frustado,
            'data_cancelado' => $model->data_cancelado,
            'data_agendado' => $model->data_agendado,
            'data_aguardando' => $model->data_aguardando,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    /**
     * @param Solicitation $solicitation
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeUser(Solicitation $solicitation)
    {
        //return $solicitation->user ? $this->item($solicitation->user,
        //    new UserTransformer()) : null;
        return $solicitation->user ? $this->item($solicitation->user,
            new UserTransformer()) : $this->item(new User(), new UserTransformer());
    }

    /**
     * @param Solicitation $solicitation
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeItems(Solicitation $solicitation)
    {
        return $solicitation->solicitation_items ? $this->collection($solicitation->solicitation_items,
            new SolicitationItemTransformer()) : null;
    }

    /**
     * @param Solicitation $solicitation
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeScheduling(Solicitation $solicitation)
    {
        return $solicitation->scheduling_solicitations ? $this->collection($solicitation->scheduling_solicitations,
            new SchedulingSolicitationTransformer()) : null;
    }
    /**
     * @param Solicitation $solicitation
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeAttempts(Solicitation $solicitation)
    {
        return $solicitation->attempt_solicitations ? $this->collection($solicitation->attempt_solicitations,
            new SchedulingAttemptTransformer()) : null;
    }


    /**
     * @param Solicitation $solicitation
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeReceiver(Solicitation $solicitation)
    {
        return $solicitation->receiver ? $this->item($solicitation->receiver,
            new ReceiverTransformer()) : null;
    }

    /**
     * @param Solicitation $solicitation
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeCompany(Solicitation $solicitation)
    {
        return $solicitation->company ? $this->item($solicitation->company,
            new CompanyTransformer()) : null;
    }

    /**
     * @param Solicitation $solicitation
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeAddress(Solicitation $solicitation)
    {
        //return $solicitation->address ? $this->item($solicitation->address,
        //    new AddressTransformer()) : null;
        return $solicitation->address ? $this->item($solicitation->address,
            new AddressTransformer()) : $this->item(new Address(), new AddressTransformer());
    }

    /**
     * @param Solicitation $solicitation
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeAuthorized(Solicitation $solicitation)
    {
        return $solicitation->authorized_people_solicitation ?
            $this->collection($solicitation->authorized_people_solicitation,
                new AuthorizedPeopleSolicitationTransformer()) : null;
    }


    /**
     * @param string $type
     * @return string
     */
    public function humanType(string $type):string
    {
        switch ($type) {
            case 'delivery':
                return 'Entrega';
                break;
            case 'collect':
                return  'Coleta';
                break;
            case 'other':
                return 'Outro';
                break;
            case 'exchange':
                return 'Troca';
                break;
            default:
                return 'Não localizado';
                break;
        }
    }
}
