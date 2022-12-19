<?php

require __DIR__ . '/../vendor/autoload.php';

$chars = array_keys(get_fixture('chars.json', true));

dump($chars);
exit(0);
