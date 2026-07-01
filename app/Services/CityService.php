<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CityRepository;

class CityService
{
    private array $allowedSorts = [
    'city_asc'  => 'city ASC',
    'city_desc' => 'city DESC',
];

    public function __construct(
        private CityRepository $repository
    ) {
    }

    public function getAllCities(): array
    {
        return $this->repository->findAll();
    }

    public function getCityById(int $id): ?array
    {
        $city = $this->repository->findById($id);

        return $city ?: null;
    }

    public function searchCities(string $search): array
    {
        return $this->repository->search($search);
    }

    public function getCitiesPage(int $page, int $perPage, string $sort): array
    {
        $offset = ($page - 1) * $perPage;

        $orderBy = $this->allowedSorts[$sort] ?? 'city ASC';

        return $this->repository->findPage($perPage, $offset, $orderBy);
    }

    public function getTotalCities(): int
    {
        return $this->repository->count();
    }

    public function searchCitiesPaginated(string $search, int $page, int $perPage, string $sort): array
    {
        $offset = ($page - 1) * $perPage;

        $orderBy = $this->allowedSorts[$sort] ?? 'city ASC';

        return $this->repository->searchPaginated($search, $perPage, $offset, $orderBy);
    }

    public function countSearchResults(string $search): int
    {
        return $this->repository->countSearch($search);
    }

    
}