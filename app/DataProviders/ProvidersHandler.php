<?php

namespace App\DataProviders;

use App\Factories\DataProviderFactory;
use Illuminate\Http\Request;

class ProvidersHandler
{
    /**
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $products = [];
        foreach (DataProviderFactory::getProviders($request->provider) as $dataProvider) {
            $products = array_merge($dataProvider->listData(), $products);
        }
        return $products;
    }
}
