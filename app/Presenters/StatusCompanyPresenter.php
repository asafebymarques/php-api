<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\StatusCompanyTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatusCompanyPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class StatusCompanyPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StatusCompanyTransformer();
    }
}
