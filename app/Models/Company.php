<?php

namespace ApiWebPsp\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Company extends \ApiWebPsp\Models\Base\Company implements Transformable,Auditable
{
    use TransformableTrait, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

	protected $fillable = [
		'cnpj',
		'name',
		'contact_name',
		'phone',
		'email',
		'logo',
		'status',
		'ativo',
		'fiscal'
	];
}
