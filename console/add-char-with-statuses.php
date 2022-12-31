<?php

/**
 * Example: php console/add-char-with-status.php solrac protect,shell

 * @see fixtures/chars.json with available chars
 * @see fixtures/statuses.json with available statuses
 */

use RPG\Application\Status\AddStatusAction;
use RPG\Domain\Char\Char;
use RPG\Domain\Char\CharAttributes;
use RPG\Domain\Char\CharResistences;
use RPG\Domain\Char\CharXp;
use RPG\Domain\Status\Status;
use RPG\Domain\Status\StatusEffect;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;

require __DIR__ . '/../vendor/autoload.php';

$input = new ArgvInput();
$output = new ConsoleOutput();

$gameChars = get_fixture('chars.json', true);
$gameStatuses = get_fixture('statuses.json', true);

$charName = console_in_question($input, $output, 'Choose a char', array_keys($gameChars));
$statusesNames = console_in_question($input, $output, 'Choose statuses', array_keys($gameStatuses), true);

if (!$selectedChar = collection($gameChars)->findFirst(fn ($k, $v) => $k === $charName)) {
    console_out_error('Char not found... use \'list-chars.php\' to retrieve current chars...');
    exit(1);
}

$selectedStatuses = [];

$charXp = CharXp::makeFromArray((array) $selectedChar->xp);
$charAttributes = CharAttributes::makeFromArray((array) $selectedChar->attributes);
$charResistences = CharResistences::makeFromArray((array) $selectedChar->resistences);
$char = Char::withData($charName, $charXp, $charAttributes, $charResistences, [], []);

foreach ($statusesNames as $statusName) {
    $selectedStatus = collection($gameStatuses)->findFirst(fn ($k, $v) => $k === $statusName);
    
    if ($selectedStatus) {
        $selectedEffects = [];

        foreach ((array) $selectedStatus->effects as $effect) {
            $selectedEffects[] = StatusEffect::makeFromArray((array) $effect);
        }

        $selectedStatuses[$statusName] = Status::makeFromArray(['name' => $statusName, 'effects' => $selectedEffects]);
    }
}

$useCase = new AddStatusAction();
$useCase->execute($char, $selectedStatuses);

dump($char);
exit(0);