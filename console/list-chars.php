<?php

use Symfony\Component\Console\Output\ConsoleOutput;

require __DIR__ . '/../vendor/autoload.php';

$chars = array_keys(get_fixture('chars.json', true));

$output = new ConsoleOutput();
console_out_table($output, ['name'], array_chunk($chars, 1));
exit(0);
