<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCategoryRequest;
use App\Http\Requests\Admin\AddProductRequest;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\AdminControllerService;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @var AdminControllerService
     */
    private $service;

    public function __construct()
    {
        $this->service = new AdminControllerService(new MainEloquentRepository());
    }

    public function index()
    {
        return view('admin.home');
    }

    public function getOrders(Request $request)
    {
        $requestQueryString = $request->getQueryString();
        $orders             = $this->service->getAllOrders($request->all(), $requestQueryString);
        $statuses           = $this->service->getAllStatuses();
        return view('admin.orders', ['orders' => $orders, 'statuses' => $statuses]);
    }

    public function getOrder($orderId)
    {
        $regions  = $this->service->getRegions();
        $statuses = $this->service->getStatuses();
        $order    = $this->service->getOrderById($orderId);
        return view('admin.order', ['order' => $order, 'regions' => $regions, 'statuses' => $statuses]);
    }

    public function getProducts(Request $request)
    {
        $requestQueryString = $request->getQueryString();
        $categories         = $this->service->getAllActiveCategories();
        $products           = $this->service->getAllProducts($request->all(), $requestQueryString);
        return view('admin.products', ['products' => $products, 'categories' => $categories]);
    }

    public function editOrder(Request $request, $orderId)
    {
        $this->service->updateOrder($orderId, $request->all());
        return redirect()->back();
    }

    public function getAddProductForm()
    {
        $ages          = $this->service->getAges();
        $manufacturers = $this->service->getManufacturers();
        $categories    = $this->service->getAllActiveCategories();
        $materials     = $this->service->getMaterials();
        return view(
            'admin.addProductForm',
            [
                'ages'          => $ages,
                'manufacturers' => $manufacturers,
                'categories'    => $categories,
                'materials'     => $materials,
            ]
        );
    }

    public function addProduct(AddProductRequest $request)
    {
        $this->service->createNewProduct($request->all());
        return redirect()->back();
    }

    public function getProductEditForm($productId)
    {
        $product       = $this->service->getProductById($productId);
        $ages          = $this->service->getAges();
        $manufacturers = $this->service->getManufacturers();
        $categories    = $this->service->getAllActiveCategories();
        $materials     = $this->service->getMaterials();
        $selectValue   = collect([1 => 'Да', 0 => 'Нет']);
        return view(
            'admin.product',
            [
                'product'       => $product,
                'ages'          => $ages,
                'manufacturers' => $manufacturers,
                'categories'    => $categories,
                'materials'     => $materials,
                'selectValue'   => $selectValue
            ]
        );
    }

    public function updateProduct(AddProductRequest $request, int $productId)
    {
        $this->service->updateProduct($productId, $request->all());
        return redirect()->back();
    }

    public function deleteProductImage(Request $request)
    {
        $this->service->deleteImage($request->get('imageId'));
    }

    public function changeMainImage(Request $request)
    {
        $oldMainImgId = $this->service->changeMainImage($request->get('imageId'));
        return response()->json(['oldMainImgId' => $oldMainImgId]);
    }

    public function getCategories()
    {
        $categories = $this->service->getAllCategories();
        return view('admin.categories', ['categories' => $categories]);
    }

    public function getAddCategoryForm(Request $request)
    {
        return view('admin.addCategoryForm');
    }

    public function addCategory(AddCategoryRequest $request)
    {
        $this->service->createNewCategory($request->all());
        return redirect()->route('admin.categories');
    }

    public function getCategoryEditForm(int $categoryId)
    {
        $category = $this->service->getCategoryById($categoryId);
        return view('admin.category', ['category' => $category]);
    }

    public function updateCategory(AddCategoryRequest $request, int $categoryId)
    {
        $this->service->updateCategory($categoryId, $request->all());
        return redirect()->back();
    }

    public function getCustomers(Request $request)
    {
        $requestQueryString = $request->getQueryString();
        $customers          = $this->service->getAllCustomers($request->all(), $requestQueryString);
        return view('admin.customers', ['customers' => $customers]);
    }

    public function getCustomer($customerId)
    {
        $customer = $this->service->getCustomer($customerId);
        return view('admin.customer', ['customer' => $customer]);
    }

    public function updateCustomer(Request $request, int $customerId)
    {
        $this->service->updateUserData($request->all(), $customerId);
        return redirect()->back();
    }

    public function getCustomerOrders(int $customerId)
    {
        $customer = $this->service->getCustomerById($customerId);
        $orders   = $customer->orders->sortByDesc('created_at');
        return view('admin.customerOrders', ['orders' => $orders]);
    }

    public function showSettings()
    {
        return view('admin.settings.home');
    }

    public function showSettingsContent()
    {
        $storeInfo = $this->service->getStoreInfo();
        return view('admin.settings.content', ['storeInfo' => $storeInfo]);
    }

    public function getBanner(string $position)
    {
        $banner = $this->service->getBanners($position);
        return view('admin.settings.banner', ['banner' => $banner]);
    }

    public function updateBanner(Request $request, string $position)
    {
        $this->service->updateBanner($position, $request->all());
        return redirect()->back();
    }

    public function getStoreInfoForm($slug)
    {
        $storeInfo = $this->service->getStoreInfoBySlug($slug);
        return view('admin.settings.storeInfo', ['storeInfo' => $storeInfo]);
    }

    public function updateStoreInfo(Request $request, $slug)
    {
        $this->service->updateStoreInfo($request->all(), $slug);
        return redirect()->back();
    }

    public function getDeliveryTypes()
    {
        $deliveryTypes = $this->service->getDeliveryTypes();
        return view('admin.settings.deliveryTypes', ['deliveryTypes' => $deliveryTypes]);
    }

    public function getDeliveryType($slug)
    {
        $deliveryType = $this->service->getDeliveryTypeBySlug($slug);
        return view('admin.settings.deliveryType', ['deliveryType' => $deliveryType]);
    }

    public function updateDeliveryType(Request $request, $slug)
    {
        $this->service->updateDeliveryType($request->all(), $slug);
        return redirect()->back();
    }

    public function getManufacturers()
    {
        $manufacturers = $this->service->getManufacturers();
        return view('admin.settings.manufacturers', ['manufacturers' => $manufacturers]);
    }

    public function getManufacturer($id)
    {
        $manufacturer = $this->service->getManufacturer($id);
        return view('admin.settings.manufacturer', ['manufacturer' => $manufacturer]);
    }

    public function updateManufacturer(Request $request, $id)
    {
        $this->service->updateManufacturer($request->all(), $id);
        return redirect()->back();
    }

    public function getAddManufacturerForm()
    {
        return view('admin.settings.addManufacturerForm');
    }

    public function addManufacturer(Request $request)
    {
        $this->service->createManufacturer($request->all());
        return redirect()->route('admin.settings.manufacturers');
    }

    public function getMaterials()
    {
        $materials = $this->service->getMaterials();
        return view('admin.settings.materials', ['materials' => $materials]);
    }

    public function getMaterial($id)
    {
        $material = $this->service->getMaterialById($id);
        return view('admin.settings.material', ['material' => $material]);
    }

    public function updateMaterial(Request $request, $id)
    {
        $this->service->updateMaterial($request->all(), $id);
        return redirect()->back();
    }

    public function getMaterialForm()
    {
        return view('admin.settings.addMaterialForm');
    }

    public function addMaterial(Request $request)
    {
        $this->service->createMaterial($request->all());
        return redirect()->back();
    }

    public function getRegions()
    {
        $regions = $this->service->getRegions();
        return view('admin.settings.regions', ['regions' => $regions]);
    }

    public function getRegion(int $id)
    {
        $region = $this->service->getRegion($id);
        return view('admin.settings.region', ['region' => $region]);
    }

    public function updateRegion(Request $request, int $id)
    {
        $this->service->updateRegion($request->all(), $id);
        return redirect()->back();
    }

    public function getRegionForm()
    {
        return view('admin.settings.addRegionForm');
    }

    public function addRegion(Request $request)
    {
        $this->service->addRegion($request->all());
        return redirect()->back();
    }

    public function getAges()
    {
        $ages = $this->service->getAges();
        return view('admin.settings.ages', ['ages' => $ages]);
    }

    public function getAge(int $id)
    {
        $age = $this->service->getAge($id);
        return view('admin.settings.age', ['age' => $age]);
    }

    public function getAgeForm()
    {
        return view('admin.settings.addAgeForm');
    }

    public function updateAge(Request $request, int $id)
    {
        $this->service->updateAge($request->all(), $id);
        return redirect()->back();
    }

    public function addAge(Request $request)
    {
        $this->service->createAge($request->all());
        return redirect()->back();
    }

}
