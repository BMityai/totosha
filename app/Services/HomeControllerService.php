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
        return $this->dbRepository->getActiveCategoryBySlug($slug);
    }

    public function getActiveNewProducts()
    {
        return $this->dbRepository->getActiveNewProducts();
    }

    public function getActiveRecommendedProducts()
    {
        return $this->dbRepository->getActiveRecommendedProducts();
    }

    public function getActiveProductBySlug($slug)
    {
        return $this->dbRepository->getActiveProductBySlug($slug);
    }

}
