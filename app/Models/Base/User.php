<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 13 Dec 2019 10:40:46 -0200.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $role
 * @property string $status
 * @property string $email
 * @property string $img_profile
 * @property \Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $extension
 * @property string $remember_token
 * @property \Carbon\Carbon $last_login_at
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection $audits
 * @property \Illuminate\Database\Eloquent\Collection $patients
 * @property \Illuminate\Database\Eloquent\Collection $scheduling_attempts
 * @property \Illuminate\Database\Eloquent\Collection $solicitations
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 *
 * @package ApiWebPsp\Models\Base
 */
class User extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'company_id' => 'int'
	];

	protected $dates = [
		'email_verified_at',
		'last_login_at'
	];

	public function company()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Company::class);
	}

	public function patients()
	{
		return $this->hasMany(\ApiWebPsp\Models\Patient::class);
	}

	public function scheduling_attempts()
	{
		return $this->hasMany(\ApiWebPsp\Models\SchedulingAttempt::class);
	}

	public function solicitations()
	{
		return $this->hasMany(\ApiWebPsp\Models\Solicitation::class);
	}

	public function permissions()
	{
		return $this->hasMany(\ApiWebPsp\Models\UserPermission::class);
	}
}
