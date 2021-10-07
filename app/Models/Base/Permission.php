<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Nov 2019 16:37:58 -0200.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permission
 * 
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $entity
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package ApiWebPsp\Models\Base
 */
class Permission extends Eloquent
{
	public function users()
	{
		return $this->belongsToMany(\ApiWebPsp\Models\User::class, 'user_permissions')
					->withPivot('id')
					->withTimestamps();
	}
}
