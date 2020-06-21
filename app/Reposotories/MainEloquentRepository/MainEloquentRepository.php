<?php

namespace App\Reposotories\MainEloquentRepository;

use App\Age;
use App\Basket;
use App\Category;
use App\CategoryImage;
use App\DeliveryType;
use App\Helpers\Helpers;
use App\KazPostTarif;
use App\Manufacturer;
use App\Material;
use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\PaymentForm;
use App\Preorder;
use App\Product;
use App\ProductImage;
use App\Region;
use App\Review;
use App\User;
use App\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Psr7\str;

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
        return Product::where('is_active', true)
            ->where('recommended', true)
            ->get();
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
                'name'                => $data['name'],
                'phone'               => $data['phone'],
                'email'               => $data['customerEmail'],
                'product_name'        => $data['productName'],
                'product_link'        => $data['productLink'],
                'product_description' => $data['productDescription'],
            ]
        );
    }

    public function createReview(array $data): void
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = null;
        }
        $productId = isset($data['productId']) ?? null;

        Review::create(
            [
                'name'       => $data['name'],
                'product_id' => $productId,
                'review'     => $data['review'],
                'user_id'    => $userId
            ]
        );
    }

    public function getActiveComingSoonProducts($filter, $requestQueryString)
    {
        $productsQuery = Product::query()
            ->where('is_active', true)
            ->where('coming_soon', true);
        if (!empty($filter)) {
            $this->filterAccordingToCustomerRequest($productsQuery, $filter);
        }
        return $productsQuery->paginate(12)->withPath('?' . $requestQueryString);
    }

    public function getActiveSalesProducts($filter, $requestQueryString)
    {
        $productsQuery = Product::query()
            ->where('is_active', true)
            ->where('discount', '>', 0);
        if (!empty($filter)) {
            $this->filterAccordingToCustomerRequest($productsQuery, $filter);
        }
        return $productsQuery->paginate(12)->withPath('?' . $requestQueryString);
    }

    /**
     * Get all reviews
     *
     * @return object
     */
    public function getReviews(): object
    {
        return Review::all()->sortByDesc('created_at');
    }

    /**
     * Get all orders
     *
     * @param array $filter
     * @param string|null $requestQueryString
     * @return object
     */
    public function getAllOrders(array $filter, ?string $requestQueryString): object
    {
        $ordersQuery = Order::query();
        if (!empty($filter)) {
            $this->filterOrdersByAdminRequest($ordersQuery, $filter);
        }
        return $ordersQuery->orderBy('created_at', 'DESC')->simplePaginate(20)->withPath('?' . $requestQueryString);
    }

    private function filterOrdersByAdminRequest(object $ordersQuery, array $filter): void
    {
        if (!empty($filter['orderNumber'])) {
            $number = $filter['orderNumber'];
            $ordersQuery->where('number', 'like', "%{$number}%");
        }

        if (!empty($filter['fromDate'])) {
            $date = Helpers::getCleanBirthDate($filter['fromDate']);
            $ordersQuery->where('created_at', '>', $date);
        }

        if (!empty($filter['toDate'])) {
            $date = Helpers::getCleanBirthDate($filter['toDate']);
            $ordersQuery->where('created_at', '<', $date);
        }

        if (!empty($filter['status'])) {
            $statusId = $filter['status'];
            $ordersQuery->whereHas(
                'status',
                function ($q) use ($statusId) {
                    $q->where('id', $statusId);
                }
            );
        }
    }

    /**
     * Get all products by filter
     *
     * @param array $filter
     * @param string|null $requestQueryString
     * @return object
     */
    public function getAllProducts(array $filter, ?string $requestQueryString): object
    {
        $productsQuery = Product::query();
        if (!empty($filter)) {
            $this->filterProductsByAdminRequest($productsQuery, $filter);
        }
        return $productsQuery->orderBy('created_at', 'DESC')->paginate(50)->withPath('?' . $requestQueryString);
    }

    /**
     * Filter products
     *
     * @param object $productsQuery
     * @param array $filter
     */
    private function filterProductsByAdminRequest(object $productsQuery, array $filter): void
    {
        if (!empty($filter['name'])) {
            $name = $filter['name'];
            $productsQuery->where('name', 'like', "%{$name}%");
        }
        if (!empty($filter['category'])) {
            $categoryId = $filter['category'];
            $productsQuery->whereHas(
                'category',
                function ($q) use ($categoryId) {
                    $q->where('id', $categoryId);
                }
            );
        }
        if (!empty($filter['priceFrom'])) {
            $productsQuery->where('discount_price', '>', $filter['priceFrom']);
        }

        if (!empty($filter['priceTo'])) {
            $productsQuery->where('discount_price', '<', $filter['priceTo']);
        }

        if (isset($filter['isActive']) && strlen($filter['isActive'])) {
            $productsQuery->where('is_active', $filter['isActive']);
        }
    }

    /**
     * Get all statuses
     *
     * @return object
     */
    public function getAllStatuses(): object
    {
        return OrderStatus::all();
    }

    public function getOrderById(int $orderId): object
    {
        return Order::find($orderId);
    }

    public function updateOrder(object $order, array $changeFields): void
    {
        foreach ($changeFields as $key => $value) {
            if ($value !== false) {
                $order->update([$key => $value]);
            }
        }
    }

    public function deleteProductInOrder(object $orderProduct)
    {
        $orderProduct->delete();
    }

    public function getAges(): object
    {
        return Age::all();
    }

    public function getManufacturers(): object
    {
        return Manufacturer::all();
    }

    public function getMaterials(): object
    {
        return Material::all();
    }

    public function saveProduct(array $productData): object
    {
        $product = Product::create(
            [
                'name'            => $productData['name'],
                'slug'            => $productData['slug'],
                'cost_price'      => $productData['costPrice'],
                'price'           => $productData['price'],
                'discount'        => $productData['discount'],
                'discount_price'  => $productData['priceWithDiscount'],
                'category_id'     => $productData['category'],
                'count'           => $productData['count'],
                'weight'          => $productData['weight'],
                'note'            => $productData['note'],
                'description'     => $productData['description'],
                'recommended'     => $productData['recommended'],
                'new'             => $productData['new'],
                'coming_soon'     => $productData['comingSoon'],
                'height'          => $productData['height'],
                'width'           => $productData['width'],
                'depth'           => $productData['depth'],
                'material_id'     => $productData['material'],
                'manufacturer_id' => $productData['manufacturer'],
                'age_id'          => $productData['age'],
            ]
        );
        $artNo   = Helpers::getProductArtNo(
            $productData['category'],
            $productData['manufacturer'],
            $productData['material'],
            $product->id
        );
        $product->update(['art_no' => $artNo]);
        return $product;
    }

    public function saveProductImage(int $productId, string $title, string $path, bool $isMain): void
    {
        ProductImage::create(
            [
                'product_id' => $productId,
                'title'      => $title,
                'path'       => $path,
                'on_main'    => $isMain
            ]
        );
    }

    public function getProductById(int $productId): object
    {
        return Product::find($productId);
    }

    public function getImageById(int $imageId): object
    {
        return ProductImage::find($imageId);
    }

    public function skipMainImage(object $mainImage): void
    {
        $mainImage->on_main = false;
        $mainImage->save();
    }

    public function setMainImage(object $mainImage)
    {
        $mainImage->on_main = true;
        $mainImage->save();
    }

    public function updateProduct(int $productId, array $productData)
    {
        $product = Product::find($productId);
        $product->update(
            [
                'name'            => $productData['name'],
                'slug'            => $productData['slug'],
                'cost_price'      => $productData['costPrice'],
                'price'           => $productData['price'],
                'discount'        => $productData['discount'],
                'discount_price'  => $productData['priceWithDiscount'],
                'category_id'     => $productData['category'],
                'count'           => $productData['count'],
                'weight'          => $productData['weight'],
                'note'            => $productData['note'],
                'description'     => $productData['description'],
                'recommended'     => $productData['recommended'],
                'new'             => $productData['new'],
                'coming_soon'     => $productData['comingSoon'],
                'height'          => $productData['height'],
                'width'           => $productData['width'],
                'depth'           => $productData['depth'],
                'material_id'     => $productData['material'],
                'manufacturer_id' => $productData['manufacturer'],
                'age_id'          => $productData['age'],
                'is_active'       => $productData['is_active']
            ]
        );
        return $product;
    }

    public function getAllCategories(): ?object
    {
        return Category::all()->sortByDesc('created_at');
    }

    public function getCategoryById(int $catgoryId): object
    {
        return Category::find($catgoryId);
    }

    public function createCategory(array $categoryData): object
    {
        return Category::create(
            [
                'name'         => $categoryData['name'],
                'slug'         => $categoryData['slug'],
                'image'        => $categoryData['imagePath'],
                'mobile_image' => $categoryData['mobileImagePath'],
                'is_active'    => $categoryData['is_active'],
                'description'  => $categoryData['description']
            ]
        );
    }

    public function updateCategory(int $categoryId, array $categoryData): void
    {
        $category      = Category::find($categoryId);
        $imgPath       = $categoryData['imagePath'] ?? $category->image;
        $mobileImgPath = $categoryData['mobileImagePath'] ?? $category->mobile_image;
        $category->update(
            [
                'name'         => $categoryData['name'],
                'slug'         => $categoryData['slug'],
                'image'        => $imgPath,
                'mobile_image' => $mobileImgPath,
                'is_active'    => $categoryData['is_active'],
                'description'  => $categoryData['description']
            ]
        );
    }

    public function getAllCustomers(array $filter, ?string $requestQueryString)
    {
        $customersQuery = User::query();
        if (!empty($filter)) {
            $this->filterCustomersByAdminRequest($customersQuery, $filter);
        }
        return $customersQuery->orderBy('created_at', 'DESC')->paginate(50)->withPath('?' . $requestQueryString);
    }

    private function filterCustomersByAdminRequest(object $customersQuery, array $filter): void
    {
        if (!empty($filter['name'])) {
            $name = $filter['name'];
            $customersQuery->where('name', 'like', "%{$name}%");
        }

        if (!empty($filter['phone'])) {
            $phone = $filter['phone'];
            $customersQuery->where('phone', 'like', "%{$phone}%");
        }

        if (!empty($filter['email'])) {
            $email = $filter['email'];
            $customersQuery->where('email', 'like', "%{$email}%");
        }

        if (!empty($filter['status'])) {
            $statusId = $filter['status'];
            $customersQuery->whereHas(
                'status',
                function ($q) use ($statusId) {
                    $q->where('id', $statusId);
                }
            );
        }
    }

    public function getCustomer(int $customerId): object
    {
        return User::find($customerId);
    }

    public function updateUserDataFromAdminPanel(array $data, int $customerId)
    {
        $user = User::find($customerId);
        $user->update(
            [
                'name'       => $data['name'],
                'phone'      => $data['phone'],
                'email'      => $data['email'],
                'bonus'      => $data['bonus'],
                'birth_date' => $data['birth_date'],
                'is_active'  => $data['is_active']
            ]
        );
    }

}
