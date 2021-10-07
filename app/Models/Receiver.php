<?php

namespace ApiWebPsp\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Receiver extends \ApiWebPsp\Models\Base\Receiver implements Transformable,Auditable
{
    use TransformableTrait;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'user_id',
		'name',
        'brand',
		'document',
		'type',
        'genre',
		'date_birth'
	];
}
