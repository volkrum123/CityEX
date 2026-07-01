<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class CityRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * Returns all cities.
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT *
            FROM worldcities
            ORDER BY city ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Finds a city by its primary key.
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM worldcities
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $city = $stmt->fetch(PDO::FETCH_ASSOC);

        return $city ?: null;
    }

    /**
     * Search cities by name.
     */
    public function search(string $searchTerm): array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM worldcities
            WHERE city ILIKE :search
            ORDER BY city ASC
        ");

        $stmt->execute([
            'search' => '%' . $searchTerm . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}