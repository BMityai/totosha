<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\SearchControllerService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var SearchControllerService
     */
    private $service;

    public function __construct()
    {
        $this->service = new SearchControllerService(new MainEloquentRepository());
    }

    public function search(SearchRequest $request)
    {
        $results = $this->service->getSearchOptions($request->get('search'));
        return view('searchResult', ['results' => $results->first()]);
    }
}
