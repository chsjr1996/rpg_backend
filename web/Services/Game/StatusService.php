<?php

namespace Web\Services\Game;

class StatusService
{
    public function list()
    {
        try {
            return [array_keys(get_fixture('statuses.json', true)), null];
        } catch (\Throwable $e) {
            return [null, $e->getMessage()];
        }
    }
}
