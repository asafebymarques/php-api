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
 * @property int $solicitation_id
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
class AuthorizedPeopleSolicitation extends Eloquent
{
    protected $table = 'authorized_people_solicitation';

	protected $casts = [
		'solicitation_id' => 'string'
	];

	public function solicitation()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Solicitation::class);
	}
}
