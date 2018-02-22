<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];

    public static function new_service($service_type, $description, $cost)
    {
        static::create([
            'service_type' => $service_type,
            'description' => $description,
            'cost' => $cost
        ]);
    }
}
