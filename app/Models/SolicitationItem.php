<?php

namespace ApiWebPsp\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SolicitationItem.
 *
 * @package namespace ApiWebPsp\Models;
 */
class SolicitationItem extends \ApiWebPsp\Models\Base\SolicitationItem implements Transformable,Auditable
{
    use TransformableTrait;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'solicitation_id',
        'total',
        'price_unitary',
        'peca',
        'qtd',
        'lot',
        'pen',
        'expiration_date',
        'item_type'
    ];
}
