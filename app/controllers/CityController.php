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

        $search = trim((string)$request->getQuery('search', ''));
        $page   = max(1, (int)$request->getQuery('page', 1));
        $sort   = (string)$request->getQuery('sort', 'city_asc');

        $perPage = 20;

        if ($search !== '') {
            $cities = $service->searchCitiesPaginated($search, $page, $perPage, $sort);
            $total  = $service->countSearchResults($search);
        } else {
            $cities = $service->getCitiesPage($page, $perPage, $sort);
            $total  = $service->getTotalCities();
        }

        $totalPages = (int) ceil($total / $perPage);

        $this->render('cities', [
            'title'       => 'Cities',
            'cities'      => $cities,
            'search'      => $search,
            'sort'        => $sort,
            'currentPage' => $page,
            'totalPages'  => $totalPages
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

            $this->render('errors/404', [
                'title' => 'Not Found'
            ]);

            return;
        }

        $this->render('city', [
            'title' => $city['city'],
            'city'  => $city
        ]);
    }
    
}