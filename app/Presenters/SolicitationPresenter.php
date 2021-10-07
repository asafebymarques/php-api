<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\SolicitationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SolicitationPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class SolicitationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SolicitationTransformer();
    }
}
