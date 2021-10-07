<?php

namespace ApiWebPsp\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Address.
 *
 * @package namespace ApiWebPsp\Models;
 */
class Address extends \ApiWebPsp\Models\Base\Address implements Transformable,Auditable
{
    use TransformableTrait, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_id',
        'alias',
        'street',
        'number',
        'complement',
        'neighborhood',
        'type',
        'city',
        'uf',
        'postal_code',
        'principal'
    ];

}
