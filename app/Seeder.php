<?php

namespace App;

class Seeder
{
    public static function seed_accounts($to_seed = 10, $cancel = false)
    {
        for ($to_seed; $to_seed > 0; $to_seed--) {

            $account_type = InfoGenerator::account_type();

            if ($account_type >=1) {
                $account = InfoGenerator::account();

                Account::confirm(
                    $account['first'],
                    $account['last'],
                    $account['email']
                );

            $account_id = Account::find_id($account['email']);
            }
        
            if ($account_type >= 2) {
                $service_id = InfoGenerator::rand_service_id();

                Account::add_service_id($account_id, $service_id);
            }

            if ($account_type >= 3) {
                Account::to_setup($account_id);
            }

            if ($account_type >= 4) {
                Account::activate($account_id);
            }
        }

        if ($cancel) {
            static::seed_cancels();
        }
    }

    protected static function seed_cancels()
    {
        $account_ids = Account::pluck('id')->toArray();
        $to_cancel = (count($account_ids) / 10); //cancel 10% of all accounts

        for ($to_cancel; $to_cancel > 0; $to_cancel--) {
            $deactivate_id = InfoGenerator::array_rand_value($account_ids);
            Account::deactivate($deactivate_id);
        }
    }
}
