<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    public function accounts_overview()
    {
        $account_data = [ // I need to update the API to make this cleaner
            count(Account::collect_states(['confirmed'], true)),
            count(Account::collect_states(['set-up'], true)),
            count(Account::collect_states(['active'], true)),
            count(Account::collect_states(['deactivated'], true)),
            count(Account::collect_states(['cancelled'], true))
        ];

        return view('crm.lorem', ['account_data' => $account_data]);
    }

    public function confirm()
    {
        return view('crm.confirm');
    }

    public function store()
    {
        $request = request(['service_id', 'first_name', 'last_name', 'email']);

        Account::confirm(
            $request['first_name'],
            $request['last_name'],
            $request['email']
        );

        $account_id = Account::find_id($request['email']);

        Account::add_service_id($account_id, $request['service_id']);

        return redirect('/');
    }

    public function update()
    {
        $account_id = request('account_id');

        $state = Acccount::find($account_id)->state;

        if ($state == 'confirmed') {
            Account::to_setup($account_id);
        } else if ($state == 'set-up') {
            Account::activate($account_id)
        }

        return redirect('/');
    }
}
