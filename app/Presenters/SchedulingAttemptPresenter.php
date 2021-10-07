<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\SchedulingAttemptTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SchedulingAttemptPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class SchedulingAttemptPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SchedulingAttemptTransformer();
    }
}
