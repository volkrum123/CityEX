<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CityRepository;

class CityService
{
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
        return $this->repository->findById($id);
    }

    public function searchCities(string $search): array
    {
        return $this->repository->search($search);
    }
}