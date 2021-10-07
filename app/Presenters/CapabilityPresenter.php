<?php

namespace ApiWebPsp\Presenters;

use ApiWebPsp\Transformers\CapabilityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CapabilityPresenter.
 *
 * @package namespace ApiWebPsp\Presenters;
 */
class CapabilityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CapabilityTransformer();
    }
}
