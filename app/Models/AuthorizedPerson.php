<?php

namespace ApiWebPsp\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AuthorizedPerson.
 *
 * @package namespace ApiWebPsp\Models;
 */
class AuthorizedPerson extends \ApiWebPsp\Models\Base\AuthorizedPerson implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_id',
        'name',
        'document',
        'phone'
    ];

}
