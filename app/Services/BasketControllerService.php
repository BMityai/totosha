<?php


namespace App\Services;


use App\Helpers\BonusCalcHelper;
use App\Helpers\KazpostTarifConverter;
use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BasketControllerService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    /**
     * @var KazpostTarifConverter
     */
    private $kazpostHelper;

    /**
     * @var BonusCalcHelper
     */
    private $bonusHelper;

    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
        $this->kazpostHelper = new KazpostTarifConverter();
        $this->bonusHelper = new BonusCalcHelper();
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

    public function getBasket()
    {
        return $this->dbRepository->getCartInfo();
    }

    public function getTotalPrice()
    {
        $summ        = 0;
        $basketItems = $this->getBasket();
        foreach ($basketItems as $basketItem) {
            $summ += (int)$basketItem->count * (int)$basketItem->product->discount_price;
        }
        return $summ;
    }

    public function getRegions()
    {
        return $this->dbRepository->getRegions();
    }

    public function getPaymentTypes()
    {
        return $this->dbRepository->getPaymentTypes();
    }

    public function getDeliveryTypes()
    {
        return $this->dbRepository->getDeliveryTypes();
    }

    public function getDeliveryPrice(int $regionId,int $deliveryTypeId): int
    {
        $totalWeight = $this->getBasketProductsTotalWeight();
        $totalPrice = $this->getTotalPrice();

        if ($regionId == 1 ){
            $value = $this->kazpostHelper->convertValueByPrice($totalPrice);
        } else {
            $value = $this->kazpostHelper->convertValueByWeight($totalWeight);
        }
        return $this->dbRepository->getKazpostTarifByValue($deliveryTypeId, $value)->price;
    }

    private function getBasketProductsTotalWeight()
    {
        $basketProducts = $this->dbRepository->getCartInfo();
        $totalWeight = 0.01;
        foreach ($basketProducts as $basketProduct){
            if (is_null($basketProduct->product->weight)){
                continue;
            }
            $totalWeight += $basketProduct->product->weight;
        }
        return $totalWeight;
    }

    public function getBonusCoefficient()
    {
       return $this->bonusHelper->getBonusCoefficient();
    }



}
