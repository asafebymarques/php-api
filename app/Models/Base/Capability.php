<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Nov 2019 16:37:31 -0200.
 */

namespace ApiWebPsp\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Capability
 * 
 * @property int $id
 * @property string $city
 * @property string $city_without_accent
 * @property string $key_primary
 * @property string $uf
 * @property string $fly_agent
 * @property string $fly_airline_highway
 * @property string $fly_sla
 * @property string $spd_agent
 * @property string $spd_airline_highway
 * @property string $spd_sla
 * @property string $std_agent
 * @property string $std_airline_highway
 * @property string $std_sla
 * @property string $obs
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package ApiWebPsp\Models\Base
 */
class Capability extends Eloquent
{

}
