<?php

namespace RPG\Domain\Char;

class CharResistences
{
    public function __construct(
        private int $water,
        private int $fire,
        private int $ice,
        private int $thunder,
        private int $earth,
        private int $air,
        private int $poison,
        private int $dark,
        private int $holy
    ) {
        $this->water = $water;
        $this->fire = $fire;
        $this->ice = $ice;
        $this->thunder = $thunder;
        $this->earth = $earth;
        $this->air = $air;
        $this->poison = $poison;
        $this->dark = $dark;
        $this->holy = $holy;
    }

    public static function makeFromArray(array $arr): self
    {
        return new CharResistences(
            $arr['water'],
            $arr['fire'],
            $arr['ice'],
            $arr['thunder'],
            $arr['earth'],
            $arr['air'],
            $arr['poison'],
            $arr['dark'],
            $arr['holy']
        );
    }

    public function water(): int
    {
        return $this->water;
    }

    public function fire(): int
    {
        return $this->fire;
    }

    public function ice(): int
    {
        return $this->ice;
    }

    public function thunder(): int
    {
        return $this->thunder;
    }

    public function earth(): int
    {
        return $this->earth;
    }

    public function air(): int
    {
        return $this->air;
    }

    public function poison(): int
    {
        return $this->poison;
    }

    public function dark(): int
    {
        return $this->dark;
    }

    public function holy(): int
    {
        return $this->holy;
    }
}
