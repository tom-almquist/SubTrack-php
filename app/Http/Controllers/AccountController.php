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

    public function setup()
    {
        return view('crm.setup');
    }

    public function activate()
    {
        return view('crm.activate');
    }

    public function cancellation()
    {
        return view('crm.deactivate');
    }

    public function mass_update()
    {
        Account::push_to_active();

        return redirect('/');
    }

    public function update()
    {
        $account = Account::find(request('account_id'));

        if ($account->state == 'confirmed') {
            $account->to_setup();
        } else if ($account->state == 'set-up') {
            $account->activate();
        }

        return redirect('/');
    }
    
    public function store()
    {
        $request = request(['service_id', 'first_name', 'last_name', 'email']);

        $newAccount = Account::confirm(
            $request['first_name'],
            $request['last_name'],
            $request['email']
        )->add_service_id($request['service_id']);;

        //Account::add_service_id($account_id, $request['service_id']);

        return redirect('/');
    }

    public function deactivate()
    {
        $account_id = request('account_id');

        Account::deactivate($account_id);

        return redirect('/');
    }
}
