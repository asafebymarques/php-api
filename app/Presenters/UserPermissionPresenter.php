<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\UserPermissionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserPermissionPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class UserPermissionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserPermissionTransformer();
    }
}
