<?php

namespace App\Http\Controllers;

use App\Category;
use App\Reposotories\MoiMalyshEloquentRepository\MoiMalyshEloquentRepository;
use App\Services\HomeControllerService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * @var HomeControllerService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new HomeControllerService(new MoiMalyshEloquentRepository());
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getCategoryProducts($slug)
    {
        $category = $this->service->getCategoryBySlug($slug);
        return view('category', ['category' => $category]);
    }
}
