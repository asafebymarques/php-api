<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 30 Sep 2019 15:18:31 -0300.
 */

namespace ApiWebPsp\Models\Base;

use ApiWebPsp\Models\Traits\UuidTrait;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SchedulingSolicitation
 * 
 * @property int $id
 * @property int $solicitation_id
 * @property \Carbon\Carbon $date_scheduling
 * @property \Carbon\Carbon $date_canceled
 * @property string $schedule_time
 * @property string $auth_contact
 * @property string $user_create
 * @property string $user_canceled
 * @property string $period
 * @property string $status
 * @property string $note
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Solicitation $solicitation
 * @property \Illuminate\Database\Eloquent\Collection $scheduling_attempts
 *
 * @package ApiWebPsp\Models\Base
 */
class SchedulingSolicitation extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $dates = [
		'date_scheduling',
		'date_canceled'
	];

	public function solicitation()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Solicitation::class);
	}

	public function scheduling_attempts()
	{
		return $this->hasMany(\ApiWebPsp\Models\SchedulingAttempt::class);
	}
}
