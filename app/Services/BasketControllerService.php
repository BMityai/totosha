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

    /**
     * Add or delete product in basket
     *
     * @param int $productId
     * @return object|bool
     */
    public function addOrDeleteProducts(int $productId)
    {
        if(Auth::check()){
            return $this->dbRepository->createOrDeleteBasketByUserId($productId);
        } else {
            return $this->dbRepository->createOrDeleteBasketBySessionId($productId);
        }
    }

    /**
     * Change product count
     *
     * @param int $productId
     * @param int $count
     * @return object
     */
    public function changeProductCountInMiniBasket(int $productId, int $count): object
    {
        return $this->dbRepository->changeProductCountInBasket($productId, $count);
    }

    /**
     * Get basket info
     *
     * @return object
     */
    public function getBasket(): object
    {
        return $this->dbRepository->getCartInfo();
    }

    /**
     * Get basket items total price
     *
     * @return int
     */
    public function getTotalPrice(): int
    {
        $summ        = 0;
        $basketItems = $this->getBasket();
        foreach ($basketItems as $basketItem) {
            $summ += (int)$basketItem->count * (int)$basketItem->product->discount_price;
        }
        return $summ;
    }

    /**
     * Get all regions
     *
     * @return object
     */
    public function getRegions(): object
    {
        return $this->dbRepository->getRegions();
    }

    /**
     * Get all payment types
     *
     * @return object
     */
    public function getPaymentTypes(): object
    {
        return $this->dbRepository->getPaymentTypes();
    }

    /**
     * Get all delivery types
     *
     * @return object
     */
    public function getDeliveryTypes(): object
    {
        return $this->dbRepository->getDeliveryTypes();
    }

    /**
     * Calculate delivery price by region
     *
     * @param int $regionId
     * @param int $deliveryTypeId
     * @return int
     */
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

    /**
     * Сalculation of the total weight of products in the basket
     *
     * @return float
     */
    private function getBasketProductsTotalWeight(): float
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

    /**
     * Calculate bonus koefficient by birth date
     *
     * @return float
     */
    public function getBonusCoefficient(): float
    {
       return $this->bonusHelper->getBonusCoefficient();
    }



}
