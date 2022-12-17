<?php

namespace App;

use App\Collections\MainChars;
use App\Collections\Statuses;
use App\Console\Actions;
use App\Models\Char;

class Game
{
    /**
     * Run the game
     * 
     * @todo All game will be an API/socket (Swoole)
     * @todo The game loop will be controled by the frontend application
     */
    public function run()
    {
        $mainChars = collection([MainChars::SOLRAC]);
        $partyChars = $mainChars->map(fn ($char) => (new Char())->make($char))->toArray();

        Actions::addStatus($partyChars, MainChars::SOLRAC, Statuses::PROTECT);
        Actions::addStatus($partyChars, MainChars::SOLRAC, Statuses::SHELL);
        Actions::addStatus($partyChars, MainChars::SOLRAC, Statuses::FAITH);

        dd('Running!', ['main_chars' => $partyChars]);
    }
}
