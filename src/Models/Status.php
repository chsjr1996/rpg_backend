<?php

namespace App\Models;

class Status
{
    public string $name;
    public array $effects;

    public function __construct(string $name, array $effects)
    {
        $this->name = $name;
        $this->effects = $effects;
    }
}
