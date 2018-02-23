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
}
