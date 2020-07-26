<?php

namespace App\Services;

use App\Helpers\Helpers;
use App\Helpers\SendEmailHelper;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Reposotories\TelegramApiRepository\TelegramApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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
     * @var SendEmailHelper
     */
    private $sendEmail;
    /**
     * @var TelegramApiRepositoryInterface
     */
    private $telegramApiRepository;

    /**
     * OrderControllerService constructor.
     * @param MainEloquentRepository $mainEloquentRepository
     * @param TelegramApiRepositoryInterface $telegramApiRepository
     */
    public function __construct(MainEloquentRepository $mainEloquentRepository, TelegramApiRepositoryInterface $telegramApiRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
        $this->basketControllerService = new BasketControllerService(new MainEloquentRepository());
        $this->sendEmail = new SendEmailHelper($this->dbRepository);
        $this->telegramApiRepository = $telegramApiRepository;
    }

    /**
     * Create order
     *
     * @param array $params
     * @return string
     */
    public function createOrder(array $params): string
    {
        $params['spentBonus'] = !empty($params['spentBonus']) ? $params['spentBonus'] : 0;
        $orderNumber = Helpers::generateOrderNumber((int)$params['region']);
        $totalPrice = $this->basketControllerService->getTotalPrice();
        $deliveryPrice = $this->basketControllerService->getDeliveryPrice($params['region'], $params['deliveryType']);
        $receivedBonus = $this->getReceivedBonuses($params['spentBonus'], $totalPrice, $deliveryPrice);
        $newOrder = $this->dbRepository->createOrder($params, $orderNumber, $totalPrice, $deliveryPrice, $receivedBonus);
        $this->createOrderProducts($newOrder->id);
        $this->updateUserBonus($newOrder->spent_bonus);
        $this->telegramApiRepository->sendMessage('order', $newOrder);
        $this->sendEmail->sendEmailToCustomer('order', $newOrder);
        return $orderNumber;
    }

    private function getReceivedBonuses(int $spentBonus, int $totalSum, int $deliveryPrice): int
    {
        $bonusCoefficient = $this->basketControllerService->getBonusCoefficient();

        if (Auth::check()){
            $receivedBonus = round(($totalSum - $spentBonus) * $bonusCoefficient / 100);
        } else {
            $receivedBonus = 0;
        }
        return $receivedBonus;
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
        if (Auth::check()){
            $this->dbRepository->updateUserBonusAfterCreateOrder($spentBonus);
        }
    }

}
