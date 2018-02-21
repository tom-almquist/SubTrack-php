<?php

namespace App;

/*
 * This is a static object meant to check to eligibility
 * of an account to transition to the next workflow.
 */

class Eligible
{
    protected static function get_info($id, $info)
    {
        return Account::find($id)->only($info);
    }
}
