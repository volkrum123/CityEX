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

    public function count(): int
    {
        $stmt = $this->pdo->query("
            SELECT COUNT(*)
            FROM worldcities
        ");

        return (int)$stmt->fetchColumn();
    }

    public function findPage(int $limit, int $offset, string $orderBy): array
    {
        $sql = "
            SELECT *
            FROM worldcities
            ORDER BY $orderBy
            LIMIT :limit
            OFFSET :offset
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchPaginated(string $search, int $limit, int $offset, string $orderBy): array
    {
        $sql = "
            SELECT *
            FROM worldcities
            WHERE city ILIKE :search
            ORDER BY $orderBy
            LIMIT :limit
            OFFSET :offset
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countSearch(string $search): int
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*)
            FROM worldcities
            WHERE city ILIKE :search
        ");

        $stmt->execute([
            'search' => '%' . $search . '%'
        ]);

        return (int) $stmt->fetchColumn();
    }
}