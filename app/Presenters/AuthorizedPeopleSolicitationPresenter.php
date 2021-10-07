<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\AuthorizedPeopleSolicitationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AuthorizedPeopleSolicitationPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class AuthorizedPeopleSolicitationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AuthorizedPeopleSolicitationTransformer();
    }
}
