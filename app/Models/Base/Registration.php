<?php

namespace ApiWebPsp\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    protected $table = 'registration';

    protected $fillable = [
        'solicitation_id',
        'attempt',
        'date_attempt',
        'document',
        'status'
    ];
//
//    protected $casts = [
//        'solicitation_id' => 'string'
//    ];

    public function solicitation()
    {
        return $this->belongsTo(\ApiWebPsp\Models\Solicitation::class);
    }
}
