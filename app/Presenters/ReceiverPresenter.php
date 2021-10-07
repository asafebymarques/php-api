<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\ReceiverTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PatientPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class ReceiverPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReceiverTransformer();
    }
}
