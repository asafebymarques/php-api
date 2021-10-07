<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 Jan 2020 13:43:10 -0200.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StatusCompany
 * 
 * @property int $id
 * @property int $company_id
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\Company $company
 *
 * @package ApiWebPsp\Models\Base
 */
class StatusCompany extends Eloquent
{
	protected $casts = [
		'company_id' => 'int'
	];

	public function company()
	{
		return $this->belongsTo(\ApiWebPsp\Models\Company::class);
	}
}
