<?php

namespace RPG\Domain\Char;

use RPG\Domain\Char\CharAttributes;
use RPG\Domain\Char\CharResistences;
use RPG\Domain\Char\CharXp;

class Char
{
    public function __construct(
        private string $id,
        private string $name,
        private CharXp $charXp,
        private CharAttributes $charAttributes,
        private CharResistences $charResistences,
        private array $equipedItems = [],
        private array $statuses
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->charXp = $charXp;
        $this->charAttributes = $charAttributes;
        $this->charResistences = $charResistences;
        $this->equipedItems = $equipedItems;
        $this->statuses = $statuses;
    }

    public static function withData(
        string $name,
        CharXp $charXp,
        CharAttributes $charAttributes,
        CharResistences $charResistences,
        array $equipedItems = [],
        array $statuses = []
    ): self {
        $id = uniqid('char_');

        return new Char($id, $name, $charXp, $charAttributes, $charResistences, $equipedItems, $statuses);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function charXp(): CharXp
    {
        return $this->charXp;
    }

    public function charAttributes(): CharAttributes
    {
        return $this->charAttributes;
    }

    public function charResistences(): CharResistences
    {
        return $this->charResistences;
    }

    public function equipedItems(): array
    {
        return $this->equipedItems;
    }

    public function statuses(?string $newValue = null): array
    {
        if (!is_null($newValue)) {
            $this->statuses[] = $newValue;
        }

        return $this->statuses;
    }
}
