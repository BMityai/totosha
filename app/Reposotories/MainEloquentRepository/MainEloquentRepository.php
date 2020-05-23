<?php

namespace App\Reposotories\MainEloquentRepository;

use App\Basket;
use App\Category;
use App\DeliveryType;
use App\Helpers\Helpers;
use App\KazPostTarif;
use App\Order;
use App\OrderProduct;
use App\PaymentForm;
use App\Preorder;
use App\Product;
use App\Region;
use App\User;
use App\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainEloquentRepository implements MainEloquentRepositoryInterface
{
    public function getActiveProductsByCategorySlug($slug, $filter, $requestQueryString)
    {
        $productsQuery = Category::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first()
            ->products()
            ->where('is_active', true);
        if (!empty($filter)) {
            $this->filterAccordingToCustomerRequest($productsQuery, $filter);
        }
        return $productsQuery->paginate(12)->withPath('?' . $requestQueryString);
    }

    public function getAllActiveCategories()
    {
        return Category::where('is_active', true)->get();
    }

    public function getActiveNewProducts()
    {
        return Product::where('is_active', true)->where('new', true)->get();
    }

    public function getActiveRecommendedProducts()
    {
        return Product::where('is_active', true)->where('recommended', true)->get();
    }

    public function getActiveProductBySlug($slug)
    {
        return Product::where('is_active', true)->where('slug', $slug)->first();
    }

    public function getActiveCategoryBySlug($slug)
    {
        return Category::where('is_active', true)->where('slug', $slug)->first();
    }

    private function filterAccordingToCustomerRequest($productsQuery, $filter)
    {
        if (!empty($filter['priceFrom']) && !is_null($filter['priceFrom'])) {
            $productsQuery->where('discount_price', '>=', $filter['priceFrom']);
        }

        if (!empty($filter['priceTo']) && !is_null($filter['priceTo'])) {
            $productsQuery->where('discount_price', '<=', $filter['priceTo']);
        }

        if (!empty($filter['stockFilter']) && $filter['stockFilter'] == 'inStock') {
            $productsQuery->where('count', '>', 0);
        }

        if (!empty($filter['stockFilter']) && $filter['stockFilter'] == 'comingSoon') {
            $productsQuery->where('coming_soon', '=', 1);
        }

        if (!empty($filter['sort']) && $filter['sort'] == 'priceDown') {
            $productsQuery->orderBy('price', 'DESC');
        }

        if (!empty($filter['sort']) && $filter['sort'] == 'priceUp') {
            $productsQuery->orderBy('price', 'asc');
        }

        if (!empty($filter['sort']) && $filter['sort'] == 'new') {
            $productsQuery->orderBy('created_at', 'DESC');
        }
    }

    public function createOrDeleteBasketBySessionId($productId)
    {
        $sessionId = session()->getId();
        $product   = Basket::where('session_id', $sessionId)
            ->where('product_id', $productId)
            ->first();
        if (empty($product)) {
            return Basket::create(
                ['session_id' => $sessionId, 'product_id' => $productId]
            );
        } else {
            return $product->delete();
        }
    }

    public function createOrDeleteBasketByUserId($productId)
    {
        $sessionId = session()->getId();
        $userId    = Auth::user()->id;
        $product   = Basket::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        if (empty($product)) {
            return Basket::create(
                [
                    'session_id' => $sessionId,
                    'user_id'    => $userId,
                    'product_id' => $productId
                ]
            );
        } else {
            return $product->delete();
        }
    }

    public function getCartInfo()
    {
        if (Auth::check()) {
            return Auth::user()->BasketProducts;
        }
        return Basket::where('session_id', session()->getId())->get();
    }

    public function changeProductCountInBasket($productId, $count)
    {
        if (Auth::check()) {
            return Basket::where('user_id', Auth::user()->id)
                ->where('product_id', $productId)
                ->update(['count' => $count]);
        }
        return Basket::where('session_id', session()->getId())
            ->where('product_id', $productId)
            ->update(['count' => $count]);
    }

    public function getRegions()
    {
        return Region::all();
    }

    public function getPaymentTypes()
    {
        return PaymentForm::all();
    }

    public function getDeliveryTypes()
    {
        return DeliveryType::all();
    }

    public function getKazpostTarifByValue($deliveryTypeId, $value): object
    {
        return KazPostTarif::where('delivery_type_id', (int)$deliveryTypeId)->where('value', $value)->first();
    }

    /**
     * Create order
     *
     * @param array $params
     * @param int $orderNumber
     * @return object
     */
    public function createOrder(array $params, string $orderNumber, int $totalPrice, int $deliveryPrice): object
    {
        $userId     = Auth::check() ? Auth::user()->id : null;
        $spentBonus = $params['spentBonus'] ?? 0;
        return Order::create(
            [
                'number'           => $orderNumber,
                'user_id'          => $userId,
                'name'             => $params['name'],
                'phone'            => $params['phone'],
                'email'            => $params['customerEmail'],
                'region_id'        => (int)$params['region'],
                'district'         => $params['district'],
                'city'             => $params['city'],
                'street'           => $params['street'],
                'building'         => $params['building'],
                'apartment'        => $params['apartment'],
                'delivery_type_id' => (int)$params['deliveryType'],
                'payment_form_id'  => (int)$params['paymentType'],
                'comment'          => $params['comment'],
                'spent_bonus'      => $spentBonus,
                'total_sum'        => $totalPrice,
                'delivery_price'   => $deliveryPrice,
            ]
        );
    }

    /**
     * Create order products
     *
     * @param int $orderId
     * @param object $product
     * @param int $count
     */
    public function createOrderProduct(int $orderId, object $product, int $count): void
    {
        OrderProduct::create(
            [
                'order_id'       => $orderId,
                'product_id'     => $product->id,
                'name'           => $product->name,
                'cost_price'     => $product->cost_price,
                'price'          => $product->price,
                'discount'       => $product->discount,
                'discount_price' => $product->discount_price,
                'art_no'         => $product->art_no,
                'count'          => $count,
            ]
        );
    }

    public function updateUserBonusAfterCreateOrder(int $spentBonus): void
    {
        Auth::user()->bonus -= $spentBonus;
        Auth::user()->save();
    }

    public function deleteBasketProduct($basketProduct)
    {
        $basketProduct->delete();
    }

    public function getActiveProductById($productId): object
    {
        return Product::where('is_active', true)->where('id', $productId)->get();
    }

    public function getAvtiveDeliveryTypeById(int $deliveryTypeId): object
    {
        return DeliveryType::where('is_active', true)->where('id', $deliveryTypeId)->get();
    }

    public function getActiveDeliveryLocationById(int $deliveryLocationId): object
    {
        return Region::where('is_active', true)->where('id', $deliveryLocationId)->get();
    }

    public function getActivePaymentTypeById(int $paymentTypeId): object
    {
        return PaymentForm::where('is_active', true)->where('id', $paymentTypeId)->get();
    }

    public function createOrDeleteWishListBySessionId(int $productId): void
    {
        $sessionId       = session()->getId();
        $wishListProduct = WishList::where('session_id', $sessionId)->where('product_id', $productId)->first();
        if (empty($wishListProduct)) {
            WishList::create(
                [
                    'session_id' => $sessionId,
                    'product_id' => $productId
                ]
            );
        } else {
            $wishListProduct->delete();
        }
    }

    public function createOrDeleteWishListByUserId(int $productId): void
    {
        $userId          = Auth::user()->id;
        $sessionId       = session()->getId();
        $wishListProduct = WishList::where('user_id', $userId)->where('product_id', $productId)->first();
        if (empty($wishListProduct)) {
            WishList::create(
                [
                    'session_id' => $sessionId,
                    'user_id'    => $userId,
                    'product_id' => $productId
                ]
            );
        } else {
            $wishListProduct->delete();
        }
    }

    public function getWishList(): object
    {
        if (Auth::check()) {
            return Auth::user()->WishListProducts;
        } else {
            return WishList::where('session_id', session()->getId())->get();
        }
    }

    public function updateUserData($data, $checkIsNotChangeEmail)
    {
        Auth::user()->update(
            [
                'name'  => $data['name'],
                'phone' => Helpers::getCleanPhone($data['phone']),
                'email' => $data['email'],

            ]
        );
        if (!$checkIsNotChangeEmail) {
            Auth::user()->email_verified_at = null;
            Auth::user()->save();
        }
    }

    public function changePassword(string $newPassword): void
    {
        Auth::user()->update(['password' => Hash::make($newPassword)]);
    }

    public function search(string $searchKey)
    {
        return Product::query()
            ->where('name', 'like', "%{$searchKey}%")
            ->orWhere('description', 'like', "%{$searchKey}%")
            ->get();
    }

    public function savePreorder($data)
    {
        Preorder::create(
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['customerEmail'],
                'product_name' => $data['productName'],
                'product_link' => $data['productLink'],
                'product_description' => $data['productDescription'],
            ]
        );
    }
}
