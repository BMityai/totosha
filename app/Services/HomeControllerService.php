<?php


namespace App\Services;


use App\Reposotories\MoiMalyshEloquentRepository\MoiMalyshEloquentRepositoryInterface;

class HomeControllerService
{
    /**
     * @var MoiMalyshEloquentRepositoryInterface
     */
    private $dbRepository;

    public function __construct(MoiMalyshEloquentRepositoryInterface $moiMalyshEloquentRepository)
    {
        $this->dbRepository = $moiMalyshEloquentRepository;
    }

    public function getCategoryBySlug($slug)
    {
        return $this->dbRepository->getCategoryBySlug($slug);
    }

}
