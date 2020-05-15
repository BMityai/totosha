<?php


namespace App\Services;


use App\Helpers\Helpers;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderControllerService
{

    /**
     * @var MainEloquentRepository
     */
    private $dbRepository;

    public function __construct(MainEloquentRepository $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
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
        $newOrder = $this->dbRepository->createOrder($params, $orderNumber);
        $this->createOrderProducts($newOrder->id);
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
            $this->dbRepository->deleteBasketProduct($basketProduct);
        }
    }
}
