<?php

namespace RPG\Domain\Char;

class CharXp
{
    public function __construct(
        private int $current,
        private int $next,
        private int $level
    ) {
        $this->current = $current;
        $this->next = $next;
        $this->level = $level;
    }

    public static function makeFromArray(array $arr)
    {
        return new CharXp($arr['current'], $arr['next'], $arr['level']);
    }

    public function current(): int
    {
        return $this->current;
    }

    public function next(): int
    {
        return $this->next;
    }

    public function level(): int
    {
        return $this->level;
    }
}
