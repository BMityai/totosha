<?php

namespace App\Services;

use App\Helpers\Helpers;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;

class OrderControllerService
{

    /**
     * @var MainEloquentRepository
     */
    private $dbRepository;

    /**
     * @var BasketControllerService
     */
    private $basketControllerService;

    /**
     * OrderControllerService constructor.
     * @param MainEloquentRepository $mainEloquentRepository
     */
    public function __construct(MainEloquentRepository $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
        $this->basketControllerService = new BasketControllerService(new MainEloquentRepository());
    }

    /**
     * Create order
     *
     * @param array $params
     * @return string
     */
    public function createOrder(array $params): string
    {
        $orderNumber = Helpers::generateOrderNumber((int)$params['region']);
        $totalPrice = $this->basketControllerService->getTotalPrice();
        $deliveryPrice = $this->basketControllerService->getDeliveryPrice($params['region'], $params['deliveryType']);
        $newOrder = $this->dbRepository->createOrder($params, $orderNumber, $totalPrice, $deliveryPrice);
        $this->createOrderProducts($newOrder->id);
        $this->updateUserBonus($newOrder->spent_bonus);
        return $orderNumber;
    }

    /**
     * Create order products and delete basket
     *
     * @param int $orderId
     * @return void
     */
    private function createOrderProducts(int $orderId): void
    {
        $basketProducts = $this->dbRepository->getCartInfo();
        foreach ($basketProducts as $basketProduct){
            $this->dbRepository->createOrderProduct($orderId, $basketProduct->product, $basketProduct->count);
            $this->dbRepository->updateProductCountInStock($basketProduct->product_id, $basketProduct->count);
            $this->dbRepository->deleteBasketProduct($basketProduct);
        }
    }

    /**
     * Update user bonus after create order
     *
     * @param int $spentBonus
     */
    private function updateUserBonus(int $spentBonus): void
    {
        $this->dbRepository->updateUserBonusAfterCreateOrder($spentBonus);
    }

}
