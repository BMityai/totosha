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

    public function getProductsByCategorySlug($slug, $filter, $requestQueryString)
    {
        return $this->dbRepository->getActiveProductsByCategorySlug($slug, $filter, $requestQueryString);
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

    public function getCategoryBySlug($slug)
    {
        return $this->dbRepository->getActiveCategoryBySlug($slug);
    }

}
