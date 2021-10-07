<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 19 Aug 2019 15:13:46 +0000.
 */

namespace ApiWebPsp\Models\Base;

use ApiWebPsp\Models\Traits\UuidTrait;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PatientContact
 * 
 * @property int $id
 * @property int $receiver_id
 * @property string $type
 * @property string $content
 * @property boolean $principal
 * @property string $status
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Receiver $receiver
 *
 * @package ApiWebPsp\Models\Base
 */
class ReceiverContact extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	public function receiver()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Receiver::class);
	}
}
