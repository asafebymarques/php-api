<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\SchedulingSolicitationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SchedulingSolicitationPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class SchedulingSolicitationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SchedulingSolicitationTransformer();
    }
}
