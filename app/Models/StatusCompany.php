<?php

namespace ApiWebPsp\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StatusCompany.
 *
 * @package namespace ApiWebPsp\Models;
 */
class StatusCompany extends \ApiWebPsp\Models\Base\StatusCompany implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'status'
    ];
}
