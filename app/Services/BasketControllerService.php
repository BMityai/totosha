<?php


namespace App\Services;


use App\Reposotories\MoiMalyshEloquentRepository\MoiMalyshEloquentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BasketControllerService
{
    /**
     * @var MoiMalyshEloquentRepositoryInterface
     */
    private $dbRepository;

    public function __construct(MoiMalyshEloquentRepositoryInterface $moiMalyshEloquentRepository)
    {
        $this->dbRepository = $moiMalyshEloquentRepository;
    }

    public function addOrDeleteProducts(int $productId)
    {
        if(Auth::check()){
            $this->dbRepository->createOrDeleteBasketByUserId($productId);
        } else {
            $this->dbRepository->createOrDeleteBasketBySessionId($productId);
        }
    }
}
