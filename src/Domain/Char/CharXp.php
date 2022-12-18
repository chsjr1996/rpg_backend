<?php

namespace RPG\Domain\Char;

class CharXp
{
    private int $current = 0;
    private int $next = 0;
    private int $level = 0;

    public function __construct(int $current, int $next, int $level)
    {
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
