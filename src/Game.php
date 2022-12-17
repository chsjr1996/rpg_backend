<?php

namespace App;

use App\Collections\MainChars;
use App\Collections\Statuses;
use App\Models\Char;
use App\Models\Status;
use App\Utils\ApplyStatus;
use Doctrine\Common\Collections\ArrayCollection;

class Game
{
    /**
     * Run the game
     * 
     * @todo loop game here?
     */
    public function run()
    {
        $mainChars = new ArrayCollection([MainChars::VAAN]);
        $generatedMainChars = $mainChars->map(fn ($char) => (new Char())->make($char));
    
        $protectStatus = Statuses::protect();
        $tmp = new Status($protectStatus[0], $protectStatus[1]);
        $shellStatus = Statuses::shell();
        $tmp2 = new Status($shellStatus[0], $shellStatus[1]);

        ApplyStatus::make($generatedMainChars[0], [$tmp, $tmp2]);
        dd('Running!', ['main_chars' => $generatedMainChars->toArray()]);
    }
}