<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Request;
use App\Repositories\CityRepository;
use App\Services\CityService;

class CityController extends Controller
{
    /**
     * Creates and returns the CityService.
     * This is a temporary solution until we introduce
     * a Dependency Injection Container.
     */
    private function getCityService(): CityService
    {
        $dbConfig = require __DIR__ . '/../../config/database.php';

        $database = new Database($dbConfig);

        $repository = new CityRepository(
            $database->getConnection()
        );

        return new CityService($repository);
    }

    /**
     * Display all cities.
     */
    public function index(Request $request): void
{
    $service = $this->getCityService();

    $search = trim((string) $request->getQuery('search', ''));

    if ($search === '') {
        $cities = $service->getAllCities();
    } else {
        $cities = $service->searchCities($search);
    }

    $this->render('cities', [
        'title'  => 'Cities',
        'cities' => $cities,
        'search' => $search
    ]);
}

    /**
     * Display a single city.
     */
    public function show(Request $request, $id): void
    {
        $city = $this->getCityService()->getCityById((int)$id);

        if ($city === null) {
            http_response_code(404);
            echo 'City not found';
            return;
        }

        $this->render('city', [
            'title' => $city['city'],
            'city'  => $city
        ]);
    }
}