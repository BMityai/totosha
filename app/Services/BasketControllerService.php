<?php


namespace App\Services;


use App\Reposotories\MoiMalyshEloquentRepository\MainEloquentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BasketControllerService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    public function addOrDeleteProducts(int $productId)
    {
        if(Auth::check()){
            return $this->dbRepository->createOrDeleteBasketByUserId($productId);
        } else {
            return $this->dbRepository->createOrDeleteBasketBySessionId($productId);
        }
    }

    public function changeProductCountInMiniBasket($productId, $count)
    {
        return $this->dbRepository->changeProductCountInBasket($productId, $count);
    }
}
