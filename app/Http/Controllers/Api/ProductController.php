<?php

namespace App\Http\Controllers\Api;

use App\DataProviders\ProvidersHandler;
use App\Filters\ProductsFilters;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @param ProvidersHandler $providersHandler
     * @param ProductsFilters $productsFilters
     * @return array
     */
    public function index(Request $request, ProvidersHandler $providersHandler, ProductsFilters $productsFilters)
    {
        $products = $providersHandler->list($request->provider);
        return response()->json(["products" => $productsFilters->apply($products, $request)]);
    }
}
