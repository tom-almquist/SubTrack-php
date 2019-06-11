<?php

use Illuminate\Database\Seeder;
use App\Account;
use App\Service;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$accountChances = [1, 2, 2, 3, 3, 3, 4, 4, 4, 4];
		$serviceIds = Service::pluck('id')->toArray();

        factory(Account::class, 100)->create()->each( function($user) use ($accountChances, $serviceIds) {

            $accountType = $accountChances[array_rand($accountChances)];
        
            if ($accountType >= 2) {
                $service_id = $serviceIds[array_rand($serviceIds)];
                $user->add_service_id($service_id);
            }

            if ($accountType >= 3) {
                $user->to_setup();
            }

            if ($accountType >= 4) {
                $user->activate();
            }
        });
    }

    public function arrayRandValue($array)
    {
        return $array[array_rand($array)];
    }
}
