<?php

namespace App\Reposotories\MoiMalyshEloquentRepository;

use App\Basket;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Auth;

class MoiMalyshEloquentRepository implements MoiMalyshEloquentRepositoryInterface
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
            Basket::create(
                ['session_id' => $sessionId, 'product_id' => $productId]
            );
        } else {
            $product->delete();
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
            Basket::create(
                [
                    'session_id' => $sessionId,
                    'user_id'    => $userId,
                    'product_id' => $productId
                ]
            );
        } else {
            $product->delete();
        }
    }

    public function getCartInfo()
    {
        if(Auth::check()){
            return Basket::where('user_id', Auth::user()->id)->get();
        }
        return Basket::where('session_id', session()->getId())->get();
    }

}
