<?php


namespace App\Services;

use App\Helpers\Helpers;
use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;
use Illuminate\Support\Str;


class AdminControllerService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    /**
     * AdminControllerService constructor.
     * @param MainEloquentRepositoryInterface $mainEloquentRepository
     */
    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    /**
     * Get all orders
     *
     * @param array $filter
     * @return object
     */
    public function getAllOrders(array $filter): object
    {
        return $this->dbRepository->getAllOrders($filter);
    }

    /**
     * Get all products
     *
     * @param array $filter
     * @param string|null $requestQueryString
     * @return object|null
     */
    public function getAllProducts(array $filter, ?string $requestQueryString): ?object
    {
        return $this->dbRepository->getAllProducts($filter, $requestQueryString);
    }

    /**
     * Get all categories
     *
     * @return object|null
     */
    public function getAllActiveCategories(): ?object
    {
        return $this->dbRepository->getAllActiveCategories();
    }

    /**
     * Get all statuses
     *
     * @return object
     */
    public function getAllStatuses(): object
    {
        return $this->dbRepository->getAllStatuses();
    }

    public function getOrderById(int $orderId): object
    {
        return $this->dbRepository->getOrderById($orderId);
    }

    public function getRegions(): object
    {
        return $this->dbRepository->getRegions();
    }

    public function getStatuses(): object
    {
        return $this->dbRepository->getAllStatuses();
    }

    public function updateOrder(int $orderId, array $data): object
    {
        $order        = $this->dbRepository->getOrderById($orderId);
        $changeFields = $this->getOrderChangeFields($order, $data);
        $this->dbRepository->updateOrder($order, $changeFields);
        return $order;
    }

    private function getOrderChangeFields(object $order, array $data): array
    {
        $result                    = [];
        $result['order_status_id'] = $order->order_status_id != $data['orderStatus'] ? $data['orderStatus'] : false;
        $result['name']            = $order->name != $data['customerName'] ? $data['customerName'] : false;
        $result['phone']           = $order->phone != $data['customerPhone'] ? $data['customerPhone'] : false;
        $result['email']           = $order->email != $data['customerEmail'] ? $data['customerEmail'] : false;
        $result['region_id']       = $order->region_id != $data['deliveryRegion'] ? $data['deliveryRegion'] : false;
        $result['district']        = $order->district != $data['deliveryDistrict'] ? $data['deliveryDistrict'] : false;
        $result['city']            = $order->city != $data['deliveryCity'] ? $data['deliveryCity'] : false;
        $result['street']          = $order->street != $data['deliveryStreet'] ? $data['deliveryStreet'] : false;
        $result['building']        = $order->building != $data['deliveryBuilding'] ? $data['deliveryBuilding'] : false;
        $result['apartment']       = $order->apartment != $data['deliveryApartment'] ? $data['deliveryApartment'] : false;
        if (isset($data['adminComment'])){
            $result['admin_comment']   = $order->admin_comment != $data['adminComment'] ? $data['adminComment'] : false;
        }
        return $result;
    }

    public function getAges():object
    {
        return $this->dbRepository->getAges();
    }

    public function getManufacturers():object
    {
        return $this->dbRepository->getManufacturers();
    }

    public function getMaterials():object
    {
        return $this->dbRepository->getMaterials();
    }

    public function createNewProduct($data):void
    {
        $discountPrice = Helpers::getDiscountPrice($data['price'], $data['discount']);
        $slug = Str::slug($data['name']);
        $data['priceWithDiscount'] = $discountPrice;
        $data['slug'] = $slug;
        $productId = $this->dbRepository->saveProduct($data);
        $this->saveImages( $productId, $slug, $data['img']);
    }

    private function saveImages( int $productId, string $slug, array $images)
    {
        $i = 0;
        foreach ($images as $image){
            $isMain = $this->checkIsMain($image->getClientOriginalName());
            $title = $slug . '-' . $i;

            $image->move(public_path().'/123/', $title);
            dd($image);
            dump($isMain);
            dd($title);

            dd($title);
        }
    }

    private function checkIsMain(string $productName): bool
    {
        if(stristr($productName, 'main_', true) !== false)
        {
            return true;
        };
        return false;
    }
}
