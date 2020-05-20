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

    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    public function addOrDeleteWishListProduct(int $productId): void
    {
        if (Auth::check()) {
            $this->dbRepository->createOrDeleteWishListByUserId($productId);
        } else {
            $this->dbRepository->createOrDeleteWishListBySessionId($productId);
        }
    }

    public function getWishList(): object
    {
        return $this->dbRepository->getWishList();
    }

    public function getCategories():object
    {
        return $this->dbRepository->getAllActiveCategories();
    }

}
