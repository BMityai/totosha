<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrDeleteBasketProductRequest;
use App\Http\Requests\BasketProductCountChangeRequest;
use App\Http\Requests\DeliveryPriceRequest;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\BasketControllerService;

class BasketController extends Controller
{
    /**
     * @var BasketControllerService
     */
    private $service;

    public function __construct()
    {
        $this->service = new BasketControllerService(new MainEloquentRepository());
    }

    public function addOrDelete(AddOrDeleteBasketProductRequest $request)
    {
        $addInfo = $this->service->addOrDeleteProducts((int)$request->productId);
        if (is_object($addInfo)) {
            $data = [
                'id'    => $addInfo->product->id,
                'count' => $addInfo->product->count,
                'name'  => $addInfo->product->name,
                'price' => $addInfo->product->discount_price
            ];
            return response()->json($data);
        };
    }

    public function changeCount(BasketProductCountChangeRequest $request)
    {
        $this->service->changeProductCountInMiniBasket((int)$request->productId, (int)$request->count);
    }

    public function getBasket()
    {
        $basket           = $this->service->getBasket();
        $totalPrice       = $this->service->getTotalPrice();
        $paymentTypes     = $this->service->getPaymentTypes();
        $deliveryTypes    = $this->service->getDeliveryTypes();
        $regions          = $this->service->getRegions();
        $bonusСoefficient = $this->service->getBonusCoefficient();
        return view(
            'basket',
            [
                'basket'           => $basket,
                'totalPrice'       => $totalPrice,
                'regions'          => $regions,
                'paymentTypes'     => $paymentTypes,
                'deliveryTypes'    => $deliveryTypes,
                'bonusСoefficient' => $bonusСoefficient
            ]
        );
    }

    public function getDeliveryPrice(DeliveryPriceRequest $request)
    {
        $deliveryPrice = $this->service->getDeliveryPrice($request->get('deliveryLocation'), $request->get('deliveryType'));
        return response()->json($deliveryPrice);
    }

    public function getCheckout()
    {
        $basket           = $this->service->getBasket();
        $totalPrice       = $this->service->getTotalPrice();
        $paymentTypes     = $this->service->getPaymentTypes();
        $deliveryTypes    = $this->service->getDeliveryTypes();
        $regions          = $this->service->getRegions();
        $bonusСoefficient = $this->service->getBonusCoefficient();
        return view(
            'checkout',
            [
                'basket'           => $basket,
                'totalPrice'       => $totalPrice,
                'regions'          => $regions,
                'paymentTypes'     => $paymentTypes,
                'deliveryTypes'    => $deliveryTypes,
                'bonusСoefficient' => $bonusСoefficient
            ]
        );    }
}
