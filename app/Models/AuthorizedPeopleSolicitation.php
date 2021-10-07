<?php

namespace ApiWebPsp\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AuthorizedPerson.
 *
 * @package namespace ApiWebPsp\Models;
 */
class AuthorizedPeopleSolicitation extends \ApiWebPsp\Models\Base\AuthorizedPeopleSolicitation implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'solicitation_id',
        'name',
        'document',
        'phone'
    ];

}
