<?php

namespace App\Models;

use App\Models\CharPartials\CharAttributes;
use App\Models\CharPartials\CharResistences;
use App\Models\CharPartials\CharXp;

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
    public array $status = [];

    public function make(string $name): self
    {
        $this->name = $name;
        $this->xp = new CharXp();
        $this->attributes = new CharAttributes();
        $this->resistences = new CharResistences();

        return $this;
    }
}
