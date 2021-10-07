<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\AddressTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AddressPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class AddressPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AddressTransformer();
    }
}
