<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 24 Jan 2020 10:28:00 -0200.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AuthorizedPerson
 * 
 * @property int $id
 * @property int $receiver_id
 * @property string $name
 * @property string $document
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Receiver $receiver
 *
 * @package ApiWebPsp\Models\Base
 */
class AuthorizedPerson extends Eloquent
{
	protected $casts = [
		'receiver_id' => 'int'
	];

	public function receiver()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Receiver::class);
	}
}
