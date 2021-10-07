<?php

namespace ApiWebPsp\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'email', 'token'
    ];

}
