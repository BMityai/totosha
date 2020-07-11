<?php


namespace App\Services;

use App\Helpers\BonusCalcHelper;
use App\Helpers\Helpers;
use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class AdminControllerService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;
    /**
     * @var BonusCalcHelper
     */
    private $bonusHelper;

    /**
     * AdminControllerService constructor.
     * @param MainEloquentRepositoryInterface $mainEloquentRepository
     */
    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
        $this->bonusHelper = new BonusCalcHelper();
    }

    /**
     * Get all orders
     *
     * @param array $filter
     * @param string $requestQueryString
     * @return object
     */
    public function getAllOrders(array $filter, ?string $requestQueryString): object
    {
        return $this->dbRepository->getAllOrders($filter, $requestQueryString);
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
        $this->updateCustomerBonuses($order, $changeFields);
        $this->dbRepository->updateOrder($order, $changeFields);
        return $order;
    }

    private function updateCustomerBonuses(object $order, array $changeFields): void
    {
        if ($changeFields['order_status_id'] == 4 && !is_null($order->user_id)) {
            $this->dbRepository->updateCustomerBonuses($order->user_id, $order->received_bonus);
        }
    }

    private function getOrderChangeFields(object $order, array $data): array
    {
        $result                    = [];
        $result['order_status_id'] = $order->order_status_id != $data['orderStatus'] ? $data['orderStatus'] : false;
        $result['name']            = $order->name != $data['customerName'] ? $data['customerName'] : false;
        $result['phone']           = $order->phone != $data['customerPhone'] ? $data['customerPhone'] : false;
        $result['mail']           = $order->email != $data['customerEmail'] ? $data['customerEmail'] : false;
        $result['region_id']       = $order->region_id != $data['deliveryRegion'] ? $data['deliveryRegion'] : false;
        $result['district']        = $order->district != $data['deliveryDistrict'] ? $data['deliveryDistrict'] : false;
        $result['city']            = $order->city != $data['deliveryCity'] ? $data['deliveryCity'] : false;
        $result['street']          = $order->street != $data['deliveryStreet'] ? $data['deliveryStreet'] : false;
        $result['building']        = $order->building != $data['deliveryBuilding'] ? $data['deliveryBuilding'] : false;
        $result['apartment']       = $order->apartment != $data['deliveryApartment'] ? $data['deliveryApartment'] : false;
        if (isset($data['adminComment'])) {
            $result['admin_comment'] = $order->admin_comment != $data['adminComment'] ? $data['adminComment'] : false;
        }
        return $result;
    }

    public function getAges(): object
    {
        return $this->dbRepository->getAges();
    }

    public function getManufacturers(): object
    {
        return $this->dbRepository->getManufacturers();
    }

    public function getMaterials(): object
    {
        return $this->dbRepository->getMaterials();
    }

    public function createNewProduct($data): void
    {
        $discountPrice             = Helpers::getDiscountPrice($data['price'], $data['discount']);
        $productSlug               = Str::slug($data['name']);
        $data['priceWithDiscount'] = $discountPrice;
        $data['slug']              = $productSlug;
        $product                   = $this->dbRepository->saveProduct($data);
        $categorySlug              = Str::slug($product->category->name);
        $this->saveProductImages($product->id, $productSlug, $categorySlug, $data['img']);
    }

    private function saveProductImages(
        int $productId,
        string $productSlug,
        string $categorySlug,
        array $images,
        int $i = 0
    ) {
        foreach ($images as $image) {
            $format = $image->getClientOriginalExtension();
            $path   = '/catalog/products/' . $categorySlug . '/' . $productId;
            $isMain = $this->checkIsMain($image->getClientOriginalName());
            $title  = $productSlug . '__' . $i;
            $image->move(public_path() . $path . '/', $title . '.' . $format);
            $path = $path . '/' . $title . '.' . $format;
            $this->dbRepository->saveProductImage($productId, $title, $path, $isMain);
            $i++;
        }
    }

    private function checkIsMain(string $productName): bool
    {
        if (stristr($productName, 'main_', true) !== false) {
            return true;
        };
        return false;
    }

    public function getProductById(int $productId): object
    {
        return $this->dbRepository->getProductById($productId);
    }

    public function deleteImage(int $imageId): void
    {
        $image = $this->dbRepository->getImageById($imageId);
        if (File::exists(public_path($image->path))) {
            File::delete(public_path($image->path));
        }
        $image->delete();
    }

    public function changeMainImage(int $imageId): ?int
    {
        $image        = $this->dbRepository->getImageById($imageId);
        $product      = $this->dbRepository->getProductById($image->product_id);
        $oldMainImgId = $this->skipMainImage($product);
        $this->dbRepository->setMainImage($image);
        return $oldMainImgId;
    }

    private function skipMainImage(object $product): ?int
    {
        $onMainImgId = null;
        foreach ($product->images as $image) {
            if ($image->on_main) {
                $this->dbRepository->skipMainImage($image);
                $onMainImgId = $image->id;
            }
        }
        return $onMainImgId;
    }

    public function updateProduct(int $productId, array $data)
    {
        $discountPrice             = Helpers::getDiscountPrice($data['price'], $data['discount']);
        $productSlug               = Str::slug($data['name']);
        $data['priceWithDiscount'] = $discountPrice;
        $data['slug']              = $productSlug;
        $product                   = $this->dbRepository->updateProduct($productId, $data);
        $categorySlug              = Str::slug($product->category->name);
        $i                         = $this->getImageUniqueNumber($product);
        if (!empty($data['img'])) {
            $this->saveProductImages($product->id, $productSlug, $categorySlug, $data['img'], $i);
        }
    }

    public function getImageUniqueNumber(object $product): int
    {
        $lastImage = $product->images->last();
        $number    = strrchr($lastImage->title, '__');
        return substr($number, 1, strlen($number));
    }

    public function getAllCategories(): ?object
    {
        return $this->dbRepository->getAllCategories();
    }

    public function getCategoryById(int $categoryId): object
    {
        return $this->dbRepository->getCategoryById($categoryId);
    }

    public function createNewCategory(array $data): void
    {
        $data['slug']      = Str::slug($data['name']);
        $data['imagePath'] = $this->getCategoryImagePath($data);
        $data['mobileImagePath'] = $this->getCategoryMobileImagePath($data);
        $this->dbRepository->createCategory($data);
    }

    private function getCategoryImagePath(array $categoryData): string
    {
        $format = $categoryData['img']->getClientOriginalExtension();
        $path   = '/catalog/categories/' . $categoryData['slug'];
        $categoryData['img']->move(public_path() . $path . '/', $categoryData['slug'] . '.' . $format);
        return $path . '/' . $categoryData['slug'] . '.' . $format;
    }

    private function getCategoryMobileImagePath(array $categoryData): string
    {
        $format = $categoryData['mobile_img']->getClientOriginalExtension();
        $path   = '/catalog/categories/' . $categoryData['slug'];
        $categoryData['mobile_img']->move(public_path() . $path . '/', $categoryData['slug'] . '_mobile.' . $format);
        return $path . '/' . $categoryData['slug'] . '_mobile.' . $format;
    }

    public function updateCategory(int $categoryId, array $categoryData)
    {
        $categoryData['slug']      = Str::slug($categoryData['name']);
        if (empty($categoryData['img'])){
            $categoryData['imagePath'] = null;
        } else {
            $categoryData['imagePath'] = $this->getCategoryImagePath($categoryData);
        }
        if (empty($categoryData['mobile_img'])){
            $categoryData['imagePath'] = null;
        } else {
            $categoryData['mobileImagePath'] = $this->getCategoryMobileImagePath($categoryData);
        }
        $this->dbRepository->updateCategory($categoryId, $categoryData);
    }

    public function getAllCustomers(array $filter, ?string $requestQueryString)
    {
        return $this->dbRepository->getAllCustomers($filter, $requestQueryString);
    }

    public function getCustomer(int $customerId)
    {
        return $this->dbRepository->getCustomer($customerId);
    }

    public function updateUserData(array $data, int $userId):void
    {
        $this->dbRepository->updateUserDataFromAdminPanel($data, $userId);
    }

    public function getCustomerById(int $customerId): object
    {
        return $this->dbRepository->getCustomer($customerId);
    }

    public function getBanners(string $position)
    {
        return $this->dbRepository->getBanners($position);
    }

    public function updateBanner(string $position, array $data): void
    {
        if (empty($data['img'])){
            $data['mainImagePath'] = null;
        } else {
            $data['mainImagePath'] = $this->getBannerMainImagePath($position, $data);
        }

        if (empty($data['content_image'])){
            $data['contentImagePath'] = null;
        } else {
            $data['contentImagePath'] = $this->getBannerContentImagePath($position, $data);
        }

        $this->dbRepository->updateBanner($position, $data);
    }

    private function getBannerMainImagePath(string $position, array $bannerData): string
    {
        $format = $bannerData['img']->getClientOriginalExtension();
        $path   = '/catalog/banner/' . $position;
        $bannerData['img']->move(public_path() . $path . '/', 'banner_top_main.' . $format);
        return $path . '/' . 'banner_top_main.' . $format;
    }

    private function getBannerContentImagePath(string $position, array $bannerData): string
    {
        $format = $bannerData['content_image']->getClientOriginalExtension();
        $path   = '/catalog/banner/' . $position;
        $bannerData['content_image']->move(public_path() . $path . '/', 'banner_top_content.' . $format);
        return $path . '/' . 'banner_top_content.' . $format;
    }

    public function getStoreInfo(): object
    {
        return $this->dbRepository->getStoreInfo();
    }

    public function getStoreInfoBySlug(string $slug):object
    {
        return $this->dbRepository->getStoreInfoBySlug($slug);
    }

    public function updateStoreInfo(array $data, string $slug): void
    {
        $this->dbRepository->updateStoreInfo($data, $slug);
    }

    public function getDeliveryTypes(): object
    {
        return $this->dbRepository->getDeliveryTypes();
    }

    public function getDeliveryTypeBySlug(string $slug): object
    {
        return $this->dbRepository->getDeliveryTypeBySlug($slug);
    }

    public function updateDeliveryType(array $data, string $slug): void
    {
        $this->dbRepository->updateDeliveryType($data, $slug);
    }

    public function getManufacturer(int $id): object
    {
        return $this->dbRepository->getManufacturerById($id);
    }

    public function updateManufacturer(array $data, int $id): void
    {
        $this->dbRepository->updateManufacturer($data, $id);
    }

    public function createManufacturer(array $data):void
    {
        $this->dbRepository->createManufacturer($data);
    }

    public function getMaterialById(int $id): object
    {
        return $this->dbRepository->getMaterialById($id);
    }

    public function updateMaterial(array $data, int $id): void
    {
        $this->dbRepository->updateMaterial($data, $id);
    }

    public function createMaterial(array $data): void
    {
        $this->dbRepository->createMaterial($data);
    }

    public function getRegion(int $id): object
    {
        return $this->dbRepository->getRegion($id);
    }

    public function updateRegion(array $data, int $id): void
    {
        $this->dbRepository->updateRegion($data, $id);
    }

    public function addRegion(array $data): void
    {
        $this->dbRepository->addRegion($data);
    }

    public function getAge(int $id)
    {
        return $this->dbRepository->getAge($id);
    }

    public function updateAge(array $data, int $id): void
    {
        $this->dbRepository->updateAge($data, $id);
    }

    public function createAge(array $data):void
    {
        $this->dbRepository->createAge($data);
    }
}
