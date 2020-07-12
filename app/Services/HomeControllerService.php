<?php

namespace App\Services;

use App\Helpers\SendEmailHelper;
use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;
use App\Reposotories\TelegramApiRepository\TelegramApiRepositoryInterface;
use Carbon\Carbon;

class HomeControllerService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    /**
     * @var SendEmailHelper
     */
    private $sendEmail;

    /**
     * @var TelegramApiRepositoryInterface
     */
    private $telegramApiRepository;

    /**
     * HomeControllerService constructor.
     * @param MainEloquentRepositoryInterface $mainEloquentRepository
     * @param TelegramApiRepositoryInterface $telegramApiRepository
     */
    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository, TelegramApiRepositoryInterface $telegramApiRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
        $this->telegramApiRepository = $telegramApiRepository;
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
        $date = Carbon::now()->subMonths(3)->format('Y-m-d');
        $newProducts = $this->dbRepository->getProductsAddedInTheLastThreeMonths($date);
        if(count($newProducts) < 50) {
            $newProducts = $this->dbRepository->getActiveLastProducts(50);
        }
        return $newProducts->shuffle()->take(50);
    }

    /**
     * Get all active recommended products
     *
     * @return object
     */
    public function getActiveRecommendedProducts(): object
    {
        return $this->dbRepository->getActiveRecommendedProducts()->shuffle()->take(50);
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
        $review = $this->dbRepository->createReview($data);
        $this->telegramApiRepository->sendMessage('review', $review);
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

    public function getAllActiveCategories():object
    {
        return $this->dbRepository->getAllActiveCategories();
    }

    public function getStoreInfo(string $slug): object
    {
        return $this->dbRepository->getStoreInfoBySlug($slug);
    }

    public function saveAdminReview(int $reviewId, array $data): void
    {
        $this->dbRepository->saveAdminReview($reviewId, $data);
    }
}
