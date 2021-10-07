<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 19 Aug 2019 15:29:16 +0000.
 */

namespace ApiWebPsp\Models\Base;

use ApiWebPsp\Models\Traits\UuidTrait;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SolicitationItem
 * 
 * @property int $id
 * @property int $product_id
 * @property string $solicitation_id
 * @property float $total
 * @property float $price_unitary
 * @property int $qtd
 * @property string $lot
 * @property string $pen
 * @property string $item_type
 * @property \Carbon\Carbon expiration_date
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Product $product
 * @property \ApiWebPsp\Models\Solicitation $solicitation
 *
 * @package ApiWebPsp\Models\Base
 */
class SolicitationItem extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'product_id' => 'int',
		'solicitation_id' => 'string',
		'total' => 'float',
		'price_unitary' => 'float',
		'qtd' => 'int'
	];

	protected $dates = [
	  'expiration_date'
    ];

	public function product()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Product::class);
	}

	public function solicitation()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Solicitation::class);
	}
}
