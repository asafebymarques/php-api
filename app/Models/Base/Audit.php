<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 22 Aug 2019 20:37:41 +0000.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Audit
 * 
 * @property int $id
 * @property string $user_type
 * @property int $user_id
 * @property string $event
 * @property string $auditable_type
 * @property string $auditable_id
 * @property string $old_values
 * @property string $new_values
 * @property string $url
 * @property string $ip_address
 * @property string $user_agent
 * @property string $tags
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \ApiWebPsp\Models\User $user
 *
 * @package ApiWebPsp\Models\Base
 */
class Audit extends Eloquent
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
	{
		return $this->belongsTo(\ApiWebPsp\Models\User::class);
	}
}
