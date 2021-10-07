<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 17 Feb 2020 18:24:34 -0300.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Address
 * 
 * @property int $id
 * @property string $alias
 * @property string $street
 * @property string $number
 * @property string $complement
 * @property string $neighborhood
 * @property string $postal_code
 * @property string $city
 * @property string $uf
 * @property string $reference
 * @property string $type
 * @property string $status
 * @property string $cep_verify
 * @property bool $principal
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $receiver_id
 * 
 * @property \ApiWebPsp\Models\Receiver $receiver
 * @property \Illuminate\Database\Eloquent\Collection $solicitations
 *
 * @package ApiWebPsp\Models\Base
 */
class Address extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'principal' => 'bool',
		'receiver_id' => 'int'
	];

	public function receiver()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Receiver::class);
	}

	public function solicitations()
	{
		return $this->hasMany(\ApiWebPsp\Models\Solicitation::class);
	}
}
