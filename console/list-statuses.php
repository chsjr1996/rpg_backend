<?php

require __DIR__ . '/../vendor/autoload.php';

$statuses = array_keys(get_fixture('statuses.json', true));

dd($statuses);
