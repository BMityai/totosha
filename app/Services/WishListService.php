<?php


namespace App\Services;


use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class WishListService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    /**
     * WishListService constructor.
     * @param MainEloquentRepositoryInterface $mainEloquentRepository
     */
    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    /**
     * Add or delete wishlist product
     *
     * @param int $productId
     */
    public function addOrDeleteWishListProduct(int $productId): void
    {
        if (Auth::check()) {
            $this->dbRepository->createOrDeleteWishListByUserId($productId);
        } else {
            $this->dbRepository->createOrDeleteWishListBySessionId($productId);
        }
    }

    /**
     * Get wishlist products
     *
     * @return object
     */
    public function getWishList(): object
    {
        return $this->dbRepository->getWishList();
    }

    /**
     * Get all active categories
     *
     * @return object
     */
    public function getCategories():object
    {
        return $this->dbRepository->getAllActiveCategories();
    }

}
