<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\SolicitationItem;

/**
 * Class SolicitationItemTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class SolicitationItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['product'];
    /**
     * Transform the SolicitationItem entity.
     *
     * @param \ApiWebPsp\Models\SolicitationItem $model
     *
     * @return array
     */
    public function transform(SolicitationItem $model)
    {
        return [
            'id'         =>  $model->id,
            'total' => $model->total,
            'price_unitary' => $model->price_unitary,
            'qtd' => $model->qtd,
            'lot' => $model->lot,
            'pen' => $model->pen,
            'peca' => $model->peca,
            'expiration_date' => $model->expiration_date,
            'item_type' => $model->item_type,
            'item_type_formated' => $this->humanType($model->item_type),
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    /**
     * @param SolicitationItem $item
     * @return \League\Fractal\Resource\Item
     */
    public function includeProduct(SolicitationItem $item)
    {
        return $this->item($item->product, new ProductTransformer());
    }

    /**
     * @param string $type
     * @return string
     */
    public function humanType($type)
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
