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

    public static function add_service_id($id, $service_id)
    {
        static::find($id)
            ->update([
                'service_id' => $service_id
            ]);
    }

    public static function to_setup($id)
    {
        if (Eligible::to_setup($id)) {
        
            static::find($id)
                ->update([
                    'state' => 'set-up'
                ]);
        }
    }

    public static function activate($id)
    {
        if (Eligible::to_activate($id)) {

            static::find($id)
                ->update([
                    'state' => 'active',
                    'active' => true
                ]);
        }
    }
}
