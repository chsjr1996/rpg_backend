<?php

namespace App\Models;

use App\Models\Partials\CharAttributes;
use App\Models\Partials\CharResistences;
use App\Models\Partials\CharXp;

/**
 * @todo create ID scheme
 */
class Char
{
    public string $name;
    public CharXp $xp; 
    public CharAttributes $attributes;
    public CharResistences $resistences;
    public array $equipedItems = [];
    public array $statuses = [];

    public function make(string $name): self
    {
        $this->name = $name;
        $this->xp = new CharXp();
        $this->attributes = new CharAttributes();
        $this->resistences = new CharResistences();

        return $this;
    }
}
