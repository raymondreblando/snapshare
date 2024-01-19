<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class StringFormatter
{
    public static function username(string $username): string
    {
        return '@' . $username;
    }

    public static function abbreviate(string $fullname): string
    {
        return Str::substr($fullname, 0, 1) ;
    }
}