<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = ['id'];

    public static function confirm($first_name, $last_name, $email)
        {
            $newAccount = static::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email
            ]);

            return $newAccount;
        }

    public function add_service_id($service_id)
    {
        $this->service_id = $service_id;
        $this->save();
    }

    public function to_setup()
    {
        if (Eligible::to_setup($this->id))
        {
            $this->state = 'set-up';
            $this->save();
            Logger::log_change($this->id, 'set-up');
        }
    }

    public function activate()
    {
        if (Eligible::to_activate($this->id))
        {
            $this->state = 'active';
            $this->active = true;
            $this->save();
            Logger::log_change($this->id, 'activated');

        }
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
