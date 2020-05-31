<?php

namespace App\Services;

use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;

class SearchControllerService
{

    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    /**
     * SearchControllerService constructor.
     * @param MainEloquentRepositoryInterface $mainEloquentRepository
     */
    public function __construct( MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    /**
     * Get products by search key
     *
     * @param string $searchKey
     * @return object
     */
    public function getSearchOptions(string $searchKey): object
    {
        $result = collect([]);
        $keys = explode(' ', $searchKey);
        foreach(array_diff(array_unique($keys), ['']) as $key){
            $result->push($this->dbRepository->search($key));
        };
        return $result->unique();
    }
}
