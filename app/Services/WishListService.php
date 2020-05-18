<?php


namespace App\Services;


use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;

class WishListService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }


}
