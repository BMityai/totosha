<?php

namespace App\Services;

use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;

class HomeControllerService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    /**
     * HomeControllerService constructor.
     * @param MainEloquentRepositoryInterface $mainEloquentRepository
     */
    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    /**
     * Get all products by category slug
     *
     * @param string $slug
     * @param array $filter
     * @param string|null $requestQueryString
     * @return object
     */
    public function getProductsByCategorySlug(string $slug, array $filter, ?string $requestQueryString): object
    {
        return $this->dbRepository->getActiveProductsByCategorySlug($slug, $filter, $requestQueryString);
    }

    /**
     * Get all active new products
     *
     * @return object
     */
    public function getActiveNewProducts(): object
    {
        return $this->dbRepository->getActiveNewProducts();
    }

    /**
     * Get all active recommended products
     *
     * @return object
     */
    public function getActiveRecommendedProducts(): object
    {
        return $this->dbRepository->getActiveRecommendedProducts();
    }

    /**
     * Get all active products by slug
     *
     * @param string $slug
     * @return object
     */
    public function getActiveProductBySlug(string $slug): ?object
    {
        return $this->dbRepository->getActiveProductBySlug($slug);
    }

    /**
     * Get all active categories by slug
     *
     * @param string $slug
     * @return object
     */
    public function getCategoryBySlug(string $slug): object
    {
        return $this->dbRepository->getActiveCategoryBySlug($slug);
    }

    /**
     * Save new preorder request
     *
     * @param array $data
     */
    public function savePreorder(array $data):void
    {
        $this->dbRepository->savePreorder($data);
    }

    /**
     * Create new review
     *
     * @param array $data
     */
    public function createReview(array $data): void
    {
        $this->dbRepository->createReview($data);
    }

    /**
     * Get all active coming soon products
     *
     * @param array $filter
     * @param null|string $requestQueryString
     * @return object
     */
    public function getActiveComingSoonProducts(array $filter, ?string $requestQueryString): object
    {
        return $this->dbRepository->getActiveComingSoonProducts($filter, $requestQueryString);
    }

    /**
     * Get all active discount products
     *
     * @param array $filter
     * @param null|string $requestQueryString
     * @return object
     */
    public function getActiveSalesProducts(array $filter, ?string $requestQueryString): object
    {
        return $this->dbRepository->getActiveSalesProducts($filter, $requestQueryString);
    }

    /**
     * Get all reviews
     *
     * @return object
     */
    public function getReviews(): object
    {
        return $this->dbRepository->getReviews();
    }


}
