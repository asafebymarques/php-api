<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\SolicitationItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SolicitationItemPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class SolicitationItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SolicitationItemTransformer();
    }
}
