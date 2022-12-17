<?php

namespace App\Console;

use App\Collections\Statuses;
use App\Services\ApplyStatusService;

class Actions
{
    /**
     * Add specific status on specific char
     *
     * @todo Use "ID" instead "Name"
     * @todo The code of this method can be improved? More clean?
     * 
     * @param array $chars Current chars (can be the 'party', or 'enemies', or 'party of enemies'...)
     * @param string $targetChar The "ID" of the char... for now the name is used, but later it will be replaced by "ID"
     * @param string $targetStatus The "ID" of the status... for now the name is used, but later it will be replaced by "ID"
     * @return void
     */
    public function addStatus(array $chars, string $targetChar, string $targetStatus): void
    {
        $selectedStatus = collection(Statuses::getAll())->findFirst(fn ($k, $v) => $v->name === $targetStatus);
        $affectedChar = collection($chars)->findFirst(fn ($k, $v) => $v->name === $targetChar);

        if (is_null($selectedStatus) || is_null($affectedChar)) {
            return;
        }

        ApplyStatusService::make($affectedChar, [$selectedStatus]);
    }
}