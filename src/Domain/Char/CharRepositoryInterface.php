<?php

namespace RPG\Domain\Char;

interface CharRepositoryInterface
{
    public function add(Char $char): bool;

    /** @return Char[] */
    public function list(): array;
}
