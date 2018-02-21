<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = ['id'];

    public static function confirm($first_name, $last_name, $email)
        {
            static::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email
            ]);
        }
}
