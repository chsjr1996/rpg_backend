<?php

namespace App\Models;

use App\Enums\CharDataEnum;
use stdClass;

class Char
{
    public string $name;
    public object $xp; 
    public int $level;
    public int $lp;
    public object $attributes;
    public object $resistences;
    public object $health;
    public object $mp;
    public array $equipedItems;
    public array $status;

    public function make(array $data): self
    {
        $this->name = $data[CharDataEnum::Name->value];
        $attributes = new stdClass();
        $attributes->physicalDefense = 0;
        $attributes->magickDefense = 0;
        $this->attributes = $attributes;

        return $this;
    }
}
