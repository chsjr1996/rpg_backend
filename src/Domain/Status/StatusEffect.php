<?php

namespace RPG\Domain\Status;

class StatusEffect
{
    private bool $increase;
    private string $targetAttribute;
    private int $amount;

    public function __construct(bool $increase, string $targetAttribute, int $amount)
    {
        $this->increase = $increase;
        $this->targetAttribute = $targetAttribute;
        $this->amount = $amount;
    }

    public static function makeFromArray(array $arr): self
    {
        return new StatusEffect($arr['increase'], $arr['targetAttribute'], $arr['amount']);
    }

    public function increase(): bool
    {
        return $this->increase;
    }

    public function targetAttribute(): string
    {
        return $this->targetAttribute;
    }

    public function amount(): int
    {
        return $this->amount;
    }
}
