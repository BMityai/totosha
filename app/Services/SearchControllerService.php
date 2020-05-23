<?php


namespace App\Services;


use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;

class SearchControllerService
{

    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    public function __construct( MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    public function getSearchOptions($searchKey)
    {
        $result = collect([]);
        $keys = explode(' ', $searchKey);
        foreach(array_diff(array_unique($keys), ['']) as $key){
            $result->push($this->dbRepository->search($key));
        };
        return $result->unique();
    }
}
