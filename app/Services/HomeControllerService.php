<?php


namespace App\Services;


use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;

class HomeControllerService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
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
