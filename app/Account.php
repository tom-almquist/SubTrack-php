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

        Logger::log_change($id, 'set-up');
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

        Logger::log_change($id, 'activated');
    }

    public static function deactivate($id)
    {
        $account_state = Eligible::deactivate_or_cancel($id);

        static::find($id)
            ->update([
                'state' => $account_state,
                'active' => false
            ]);

        Logger::log_change($id, $account_state);
    }

    public static function find_id($email)
    {
        return static::where('email', '=', $email)->first()->id;
    }
}
