<?php

namespace App;

class Seeder
{
    protected static $chances = [1, 2, 2, 3, 3, 3, 4, 4, 4, 4];

    public static function seed_accounts($to_seed = 10, $cancel = false)
    {
        for ($to_seed; $to_seed > 0; $to_seed--) {

            $account_type = InfoGenerator::account_type(static::$chances);

            if ($account_type >=1) {
                $account = InfoGenerator::account();

                Account::confirm(
                    $account['first'],
                    $account['last'],
                    $account['email']
                );

            $account_id = Account::find_id($account['email']);
            }
        }
    }
}
