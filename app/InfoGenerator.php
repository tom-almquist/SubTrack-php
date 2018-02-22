<?php

namespace App;

class InfoGenerator
{
    protected static $vowels = 'aeiou';
    protected static $consonants  = 'bcdfghjklmnpqrstvwxyz';

    public static function account()
    {
        $account = [
            'first' => static::name(3),
            'last' => static::name(6),
            'email' => static::email()
        ];

        return $account;
    }

    public static function account_type($chances)
    {
        return static::array_rand_value($chances);
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

    protected static function array_rand_value($array)
    {
        return $array[array_rand($array)];
    }
}
