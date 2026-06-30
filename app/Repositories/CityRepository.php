<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class CityRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function find(int|string $id): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM worldcities WHERE id = :id");
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM cities");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}