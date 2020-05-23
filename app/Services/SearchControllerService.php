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
        return $this->dbRepository->search($searchKey);
    }
}
