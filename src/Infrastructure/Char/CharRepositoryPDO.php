<?php

namespace RPG\Infrastructure\Char;

use RPG\Domain\Char\Char;
use RPG\Domain\Char\CharRepositoryInterface;

class CharRepositoryPDO implements CharRepositoryInterface
{
    public function __construct(private \PDO $conn)
    {
    }

    public function add(Char $char): bool
    {
        try {
            $sql = 'INSERT INTO chars VALUES (:name, :level, :current_xp, :next_xp)';
            $statement = $this->conn->prepare($sql);
            $statement->bindValue('name', $char->name());
            $statement->bindValue('level', $char->charXp()->level());
            $statement->bindValue('current_xp', $char->charXp()->current());
            $statement->bindValue('next_xp', $char->charXp()->next());
            $statement->execute();

            return true;
        } catch (\Throwable $ex) {
            // TODO: Log this... (monolog?)
            return false;
        }
    }

    public function list(): array
    {
        try {
            $sql = 'SELECT * FROM chars';
            $statement = $this->conn->prepare($sql);
            $statement->execute();

            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            // TODO: Log this... (monolog?)
            return [];
        }
    }
}
