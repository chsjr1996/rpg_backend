<?php

namespace App\Collections;

use App\Models\Partials\StatusEffect;
use App\Models\Status;
use stdClass;

/**
 * All statuses methods can be a DTO, no? Avoid to use array...
 */
class Statuses
{
    public const PROTECT = 'Protect';
    public const SHELL = 'Shell';
    public const FAITH = 'Faith';

    public static function protect(): Status
    {
        $status = new Status();
        $status->name = self::PROTECT;
        $status->effects = [self::makeEffects(true, 'defense', 10)];

        return $status;
    }

    public static function shell(): Status
    {
        $status = new Status();
        $status->name = self::SHELL;
        $status->effects = [self::makeEffects(true, 'magickResist', 5)];

        return $status;
    }

    public static function faith(): Status
    {
        $status = new Status();
        $status->name = self::FAITH;
        $status->effects = [self::makeEffects(true, 'magickPower', 15)];
        
        return $status;
    }

    /**
     * @return Status[]
     */
    public static function getAll(): array
    {
        return [self::protect(), self::shell(), self::faith()];
    }

    private static function makeEffects(bool $increase, string $targetAttribute, int $amount): object
    {
        $statusEffect = new StatusEffect();
        $statusEffect->increase = $increase;
        $statusEffect->targetAttribute = $targetAttribute;
        $statusEffect->amount = $amount;

        return $statusEffect;
    }
}
