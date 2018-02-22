<?php

namespace App;

class InfoGenerator
{
    protected static $vowels = 'aeiou';
    protected static $consonants  = 'bcdfghjklmnpqrstvwxyz';
    protected static $chances = [1, 2, 2, 3, 3, 3, 4, 4, 4, 4];

    public static function account()
    {
        $account = [
            'first' => static::name(3),
            'last' => static::name(6),
            'email' => static::email()
        ];

        return $account;
    }

    public static function account_type()
    {
        return static::array_rand_value(static::$chances);
    }

    public static function rand_service_id()
    {
        return static::array_rand_value(Service::pluck('id')->toArray());
    }

    protected static function name($letters)
    {
        $vowels = static::$vowels;
        $consonants = static::$consonants;

        $name = '';

        for ($letters; $letters > 0; $letters--) { //this whole for-loop is too damn hacky
            if (($letters == 5) or ($letters == 2)) {
                $character = static::array_rand_value(str_split($vowels));
            } else {
                $character = static::array_rand_value(str_split($consonants));
            }

            $name = $name . $character;
        }

        return ucwords($name);
    }

    protected static function email()
    {
        return (uniqid() . '@' . uniqid('', true));
    }

    public static function array_rand_value($array)
    {
        return $array[array_rand($array)];
    }
}
