<?php

namespace ApiWebPsp\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserPermission.
 *
 * @package namespace ApiWebPsp\Models;
 */
class UserPermission extends \ApiWebPsp\Models\Base\UserPermission implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'permission_id'
    ];

}
