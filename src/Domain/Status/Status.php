<?php

namespace RPG\Domain\Status;

class Status
{
    private string $name = '';
    private array $effects = [];

    public function __construct(string $name, array $effects)
    {
        $this->name = $name;
        $this->effects = $effects;
    }

    public static function makeFromArray(array $arr): self
    {
        return new Status($arr['name'], $arr['effects']);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function effects(): array
    {
        return $this->effects;
    }
}
