<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 30 Sep 2019 15:17:05 -0300.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SchedulingAttempt
 * 
 * @property int $id
 * @property string $phone
 * @property string $reason
 * @property string $sms
 * @property string $success
 * @property string $scheduling_solicitation_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Solicitation $solicitation
 * @property \ApiWebPsp\Models\User $user
 *
 * @package ApiWebPsp\Models\Base
 */
class SchedulingAttempt extends Eloquent
{
	public function solicitation()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Solicitation::class);
	}

	public function user()
	{
		return $this->belongsTo(\ApiWebPsp\Models\User::class);
	}
}
