<?php

namespace ApiWebPsp\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends \ApiWebPsp\Models\Base\Registration
{
    //
    protected $fillable = [
        'solicitation_id',
        'attempt',
        'date_attempt',
        'document',
        'status'
    ];
}
