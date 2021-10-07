<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\ReceiverContactTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PatientContactPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class ReceiverContactPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReceiverContactTransformer();
    }
}
