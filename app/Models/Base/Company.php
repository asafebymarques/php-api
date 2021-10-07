<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 Jan 2020 13:43:20 -0200.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 * 
 * @property int $id
 * @property string $cnpj
 * @property string $name
 * @property string $contact_name
 * @property string $phone
 * @property string $email
 * @property string $logo
 * @property bool $ativo
 * @property int $fiscal
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $products
 * @property \Illuminate\Database\Eloquent\Collection $solicitations
 * @property \Illuminate\Database\Eloquent\Collection $status_companies
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package ApiWebPsp\Models\Base
 */
class Company extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'ativo' => 'bool',
		'fiscal' => 'int'
	];

	public function products()
	{
		return $this->hasMany(\ApiWebPsp\Models\Product::class);
	}

	public function solicitations()
	{
		return $this->hasMany(\ApiWebPsp\Models\Solicitation::class);
	}

	public function status_companies()
	{
		return $this->hasMany(\ApiWebPsp\Models\StatusCompany::class);
	}

	public function users()
	{
		return $this->hasMany(\ApiWebPsp\Models\User::class);
	}
}
