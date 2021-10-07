<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\AuthorizedPersonTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AuthorizedPersonPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class AuthorizedPersonPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AuthorizedPersonTransformer();
    }
}
