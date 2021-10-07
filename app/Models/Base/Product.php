<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 16 Aug 2019 19:02:12 +0000.
 */

namespace ApiWebPsp\Models\Base;

use ApiWebPsp\Models\Traits\UuidTrait;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $company_id
 * @property string $active_principle
 * @property string $cnpj
 * @property string $laboratory
 * @property string $ggrem
 * @property string $registry
 * @property string $ean
 * @property string $product
 * @property string $presentation
 * @property string $information
 * @property string $manifestation
 * @property string $discontinued
 * @property \Carbon\Carbon $release_date
 * @property string $code_protheus
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Company $company
 *
 * @package ApiWebPsp\Models\Base
 */
class Product extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'company_id' => 'int',
        'id' => 'int'
	];

	protected $dates = [
		'release_date',
        'created_at',
        'updated_at',
        'deleted_at'
	];

	public function company()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Company::class);
	}
}
