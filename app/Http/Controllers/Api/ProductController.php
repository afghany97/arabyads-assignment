<?php

namespace App\Http\Controllers\Api;

use App\DataProviders\ProvidersHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @param ProvidersHandler $providersHandler
     * @return array
     */
    public function index(Request $request, ProvidersHandler $providersHandler)
    {
        return response()->json(["products" => $providersHandler->list($request)]);
    }
}
