<?php

namespace App\Models;

use App\Enums\StatusesDataEnum;

class Status
{
    public string $name;
    public array $effects;

    public function __construct(array $status)
    {
        $this->name = $status[StatusesDataEnum::NAME->value];
        $this->effects = $status[StatusesDataEnum::EFFECTS->value];
    }
}
