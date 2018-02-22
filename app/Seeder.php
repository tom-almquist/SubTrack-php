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
        }
    }
}
