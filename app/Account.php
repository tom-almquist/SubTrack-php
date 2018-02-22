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

    public static function collect_states($states, $return_ids = false)
    {
        $collection = new \Illuminate\Database\Eloquent\Collection;

        foreach ($states as $state) {
            $accounts = static::where('state', '=', $state)->get();
            $collection = $collection->merge($accounts);
        }

        if ($return_ids) {
            return $collection->pluck('id')->toArray();
        } else {
            return $collection;
        }
    }

    public static function collect_active()
    {
        return static::where('active', '=', true)->get();
    }

    /*
     * This function returns a list of IDs that have been
     * updated within the past interval
     *
     * Currently, this method only takes three intervals
     * 'month' to check updates in the past month.
     * 'week' to check the past week
     * 'day' to check the past day 
     *
     *  NOTE: REFACTOR THIS!!!
     */
    public static function update_history($interval)
    {
        $format = 'Y-m-d H:m:s';

        $past_date = new \DateTime('-1 ' . $interval);
        $past_date = $past_date->format($format);

        $ids = static::pluck('id')->toArray();

        $ids_to_delete = [];

        foreach ($ids as $id) {
            $account_date = static::find($id)->updated_at->format($format);
            if ($past_date > $account_date) {
                $ids_to_delete[] = $id;
            }
        }
        
        return array_values(array_diff($ids, $ids_to_delete));
    }

    public static function push_to_active()
    {
        $inactive_ids = static::collect_states(['confirmed', 'set-up'], true);

        foreach ($inactive_ids as $id) {
            static::to_setup($id);
            static::activate($id);
        }
    }
}
