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
        return view('admin.settings.content');
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
}
