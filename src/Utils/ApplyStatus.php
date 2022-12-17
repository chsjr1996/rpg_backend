<?php

namespace App\Utils;

use App\Models\Char;
use App\Models\Partials\StatusEffect;
use App\Models\Status;

class ApplyStatus
{
    /**
     * @param Char $char
     * @param Status[] $statuses
     * @return void
     */
    public static function make(Char $char, array $statuses): void
    {
        $propertyAcessor = new PropertyAcessor();

        foreach ($statuses as $status) {
            /** @var StatusEffect $effect */
            foreach ($status->effects as $effect) {
                if ($effect->increase) {
                    $effectAmount = $propertyAcessor->get($effect, 'amount', 0);
                    $effectTarget = $propertyAcessor->get($effect, 'targetAttribute');
                    $currentAttribute = $propertyAcessor->get($char, "attributes.{$effectTarget}", 0);
                    $newAttribute = $currentAttribute + $effectAmount;
                    $propertyAcessor->set($char, "attributes.{$effectTarget}", $newAttribute);
                }
            }

            $char->statuses[] = $status->name;
        }
    }
}
