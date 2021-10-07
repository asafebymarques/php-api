<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\AuditTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AuditPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class AuditPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AuditTransformer();
    }
}
