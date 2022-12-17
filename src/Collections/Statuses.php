<?php

namespace App\Collections;

use stdClass;

/**
 * All statuses methods can be a DTO, no? Avoid to use array...
 */
class Statuses
{
    public const PROTECT = 'Protect';
    public const SHELL = 'Shell';
    public const FAITH = 'Faith';

    public static function protect(): array
    {
        return [self::PROTECT, [self::makeEffects(true, 'defense', 10)]];
    }

    public static function shell(): array
    {
        return [self::SHELL, [self::makeEffects(true, 'magickResist', 5)]];
    }

    public static function faith(): array
    {
        return [self::FAITH, [self::makeEffects(true, 'magickPower', 15)]];
    }

    public static function getAll(): array
    {
        return [self::protect(), self::shell(), self::faith()];
    }

    private static function makeEffects(bool $increase, string $target, int $amount): object
    {
        // TODO: Can be a DTO?
        $effectObj = new stdClass();
        $effectObj->increase = $increase;
        $effectObj->target = $target;
        $effectObj->amount = $amount;

        return $effectObj;
    }
}
