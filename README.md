# crm-test
A simple CRM meant to advance my knowledge with PHP and Laravel.

All you need to be able to run this is an installation of Laravel and a database compatible with what's described in the `.env` file--the current file requires a mysql database named `crmtest` with a username `root` and a blank password.

To do that, follow the instructions at: https://laravel.com/docs/5.6/installation

Once you can create a project with `laravel new blog` then you can clone this repository.

From there, go into the project root folder with a terminal and format your database by running `php artisan migrate`, then everything is accessible through `php artisan tinker`

You may have to run `composer update` before you can run this app.

The commands are:

---

`App\Service::new_service(string $service_type, text $description, decimal $cost)`

Create a new service entry with the specified '$service_type`, `$description`, and `$cost`.

---

`App\Account::confirm(string $first_name, string $last_name, unique_string $email);`

Create a `confirmed`--but inactive--account with the specified `$first_name`,`$last_name`, and `$email`.

---

`App\Account::add_service_id(integer $account_id, integer $service_id);`

Add a `$service_id` to the specified `$account_id`.

---

`App\Account::to_setup(integer $account_id);`

Push an account from `confirmed` to `set-up`. This will only work if the account has picked a service.

---

`App\Account::activate(integer $account_id);`

Push an account from `set-up` to `active`.

---

`App\Account::deactivate(integer $account_id);`

Deactivate an account from any point in the work-flow. `active` accounts are set to `deactivated`; `confirmed` and `set-up` accounts are `cancelled`.

---

`App\Account::find_id(string $email);`

Returns the ID of an account with the specified email.

---

`App\Account::collect_states(array_of_strings $states, boolean $return_ids = false);`

Returns an Eloquent collection of accounts that are in any of the states specified in `$states`. Returns an array of `$account_ids` if `$return_ids` is set to `true`.

---

`App\Account::collect_active();`

Returns an Eloquent collection of accounts that are `active`.

---

`App\Account::update_history(string $time_interval);`

Returns an array of `$account_ids` that have been updated within the past `$time_interval`.
Currently, it only accepts the strings `'day'`, `'week'`, `'month'`, and `'year'`.

---

`App\Account::push_to_active();`

Interate through all `confirmed` and `set-up` accounts and push any eligible accounts to 'active'. 

---

`App\Seeder::seed_accounts(integer $to_seed = 10, boolean $to_cancel = false);`

Seed the database with randomly generated accounts. Specify the number of accounts to generate with `$to_seed` default is ten accounts. Setting `$to_cancel` to true will randomly deactivate 10% of ALL TOTAL accounts.

---
