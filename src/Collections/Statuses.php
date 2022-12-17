<?php

namespace App\Collections;

use stdClass;

class Statuses
{
    public static function protect()
    {
        return ['Protect', [self::makeEffects(true, 'physicalDefense', 10)]];
    }

    public static function shell()
    {
        return ['Shell', [self::makeEffects(true, 'magickDefense', 5)]];
    }

    private static function makeEffects(bool $increase, string $target, int $amount): object
    {
        $effectObj = new stdClass();
        $effectObj->increase = $increase;
        $effectObj->target = $target;
        $effectObj->amount = $amount;

        return $effectObj;
    }
}
