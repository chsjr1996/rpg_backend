<?php

namespace RPG\Application\Status;

use RPG\Domain\Char\Char;
use RPG\Domain\Status\StatusEffect;

class AddStatusAction
{
    /**
     * @param Char $char
     * @param Status[] $statuses
     * @return void
     */
    public function execute(Char $char, array $statuses): void
    {
        foreach ($statuses as $status) {
            /** @var StatusEffect $effect */
            foreach ($status->effects() as $effect) {
                $effectAmount = $effect->amount();
                $effectTarget = $effect->targetAttribute();
                $currentAttribute = $char->charAttributes()->$effectTarget();
                $newAttribute = $effect->increase()
                    ? $currentAttribute + $effectAmount
                    : $currentAttribute - $effectAmount;

                $char->charAttributes()->$effectTarget($newAttribute);
            }

            $char->statuses($status->name());
        }
    }
}
