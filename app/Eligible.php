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

    public static function to_setup($id)
    {
        $info = static::get_info($id, ['service_id', 'state']);

        $service_eligible = ($info['service_id'] > 0);
        $state_eligible = ($info['state'] == 'confirmed');

        return ($service_eligible and $state_eligible);
    }

    public static function to_activate($id)
    {
        $info = static::get_info($id, ['state']);

        return ($info['state'] == 'set-up');
    }
}
