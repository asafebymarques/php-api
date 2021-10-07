<?php


namespace ApiWebPsp\Models\Traits;


use Ramsey\Uuid\Uuid;

trait UuidTrait
{
    /*function generate uuid*/
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($obj) {
            $obj->id = Uuid::uuid4();
        });
    }

    public function getKeyType()
    {
        return 'string';
    }
}
