<?php

namespace RPG\Domain\Char;

class CharAttributes
{
    public function __construct(
        private $attackPower,
        private $defense,
        private $magickResist,
        private $evade,
        private $magickEvade,
        private $strength,
        private $magickPower,
        private $vitality,
        private $speed,
        private $currentHealthPoints,
        private $maxHealthPoints,
        private $currentMagickPoints,
        private $maxMagickPoints,
    ) {
        $this->attackPower = $attackPower;
        $this->defense = $defense;
        $this->magickResist = $magickResist;
        $this->evade = $evade;
        $this->magickEvade = $magickEvade;
        $this->strength = $strength;
        $this->magickPower = $magickPower;
        $this->vitality = $vitality;
        $this->speed = $speed;
        $this->currentHealthPoints = $currentHealthPoints;
        $this->maxHealthPoints = $maxHealthPoints;
        $this->currentMagickPoints = $currentMagickPoints;
        $this->maxMagickPoints = $maxMagickPoints;
    }

    public static function makeFromArray(array $arr): self
    {
        return new CharAttributes(
            $arr['attackPower'],
            $arr['defense'],
            $arr['magickResist'],
            $arr['evade'],
            $arr['magickEvade'],
            $arr['strength'],
            $arr['magickPower'],
            $arr['vitality'],
            $arr['speed'],
            $arr['currentHealthPoints'],
            $arr['maxHealthPoints'],
            $arr['currentMagickPoints'],
            $arr['maxMagickPoints']
        );
    }

    public function attackPower(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->attackPower = $newValue;
        }

        return $this->attackPower;
    }

    public function defense(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->defense = $newValue;
        }

        return $this->defense;
    }

    public function magickResist(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->magickResist = $newValue;
        }

        return $this->magickResist;
    }

    public function evade(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->evade = $newValue;
        }

        return $this->evade;
    }

    public function magickEvade(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->magickEvade = $newValue;
        }

        return $this->magickEvade;
    }

    public function strength(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->strength = $newValue;
        }

        return $this->strength;
    }

    public function magickPower(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->magickPower = $newValue;
        }

        return $this->magickPower;
    }

    public function vitality(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->vitality = $newValue;
        }

        return $this->vitality;
    }

    public function speed(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->speed = $newValue;
        }

        return $this->speed;
    }

    public function currentHealthPoints(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->currentHealthPoints = $newValue;
        }

        return $this->currentHealthPoints;
    }

    public function maxHealthPoints(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->maxHealthPoints = $newValue;
        }

        return $this->maxHealthPoints;
    }

    public function currentMagickPoints(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->currentMagickPoints = $newValue;
        }

        return $this->currentMagickPoints;
    }

    public function maxMagickPoints(?int $newValue = null): int
    {
        if (!is_null($newValue)) {
            $this->maxMagickPoints = $newValue;
        }

        return $this->maxMagickPoints;
    }
}
