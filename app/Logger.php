<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Logger
{
    static protected $log_file = 'logs/crm-test.log';

    protected static function create_message($id, $state)
    {
        $datetime = '[ ' . date("Y-m-d H:i:s") . ' ] ';
        $info = "Account number: %s has been %s.";

        return ($datetime . sprintf($info, $id, $state));
    }

    protected static function log($message)
    {
        Storage::disk('local')->append(static::$log_file, $message);
    }

    public static function log_change($id, $state)
    {
        $message = static::create_message($id, $state);

        static::log($message);
    }
}
