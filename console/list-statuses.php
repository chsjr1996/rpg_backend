<?php

use Symfony\Component\Console\Output\ConsoleOutput;

require __DIR__ . '/../vendor/autoload.php';

$statuses = array_keys(get_fixture('statuses.json', true));

$output = new ConsoleOutput();
console_out_table($output, ['name'], array_chunk($statuses, 1));
exit(0);
