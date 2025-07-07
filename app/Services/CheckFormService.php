<?php

namespace App\Services;

class CheckFormService
{
    public static function checkGender($data)
    {
        if ($data->gender === '0') {
            return '男性';
        } else {
            return '女性';
        }
    }
}
