<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\Product;

/**
 * Class ProductTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{
    /**
     * Transform the Product entity.
     *
     * @param \ApiWebPsp\Models\Product $model
     *
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id'         =>  $model->id,
            'active_principle' => $model->active_principle,
            'cnpj' => $model->cnpj,
            'laboratory' => $model->laboratory,
            'ggrem' => $model->ggrem,
            'registry' => $model->registry,
            'ean' => $model->ean,
            'product' => $model->product,
            'presentation' => $model->presentation,
            'information' => $model->information,
            'manifestation' => $model->manifestation,
            'discontinued' => $model->discontinued,
            'release_date' => $model->release_date,
            'code_protheus' => $model->code_protheus,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
