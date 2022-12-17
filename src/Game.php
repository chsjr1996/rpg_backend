<?php

namespace App;

use App\Collections\MainChars;
use App\Console\Actions;
use App\Models\Char;
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
        // TODO: By default, "Vaan" is always on party, another chars will be added from REPL
        $mainChars = new ArrayCollection([MainChars::VAAN]);
        $partyChars = $mainChars->map(fn ($char) => (new Char())->make($char));

        // TODO: This will be called from REPL
        (new Actions())->addStatus($partyChars->toArray(), 'Vaan', 'Protect');
        (new Actions())->addStatus($partyChars->toArray(), 'Vaan', 'Shell');

        // TODO: All output will be shown on REPL
        dd('Running!', ['main_chars' => $partyChars->toArray()]);
    }
}
