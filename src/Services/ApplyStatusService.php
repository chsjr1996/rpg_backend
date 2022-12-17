<?php

namespace App\Services;

use App\Models\Char;
use App\Models\Partials\StatusEffect;
use App\Models\Status;

class ApplyStatusService
{
    /**
     * @param Char $char
     * @param Status[] $statuses
     * @return void
     */
    public static function make(Char $char, array $statuses): void
    {
        foreach ($statuses as $status) {
            /** @var StatusEffect $effect */
            foreach ($status->effects as $effect) {
                if ($effect->increase) {
                    $effectAmount = data_get($effect, 'amount', 0);
                    $effectTarget = data_get($effect, 'targetAttribute');
                    $currentAttribute = data_get($char, "attributes.{$effectTarget}", 0);
                    $newAttribute = $currentAttribute + $effectAmount;
                    data_set($char, "attributes.{$effectTarget}", $newAttribute);
                }
            }

            $char->statuses[] = $status->name;
        }
    }
}
