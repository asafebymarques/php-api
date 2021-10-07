<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Nov 2019 16:38:19 -0200.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserPermission
 * 
 * @property int $id
 * @property int $user_id
 * @property int $permission_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Permission $permission
 * @property \ApiWebPsp\Models\User $user
 *
 * @package ApiWebPsp\Models\Base
 */
class UserPermission extends Eloquent
{
	protected $casts = [
		'permission_id' => 'int',
		'user_id' => 'int'
	];

	public function permission()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Permission::class);
	}

	public function user()
	{
		return $this->belongsTo(\ApiWebPsp\Models\User::class);
	}
}
