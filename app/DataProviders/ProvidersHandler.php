<?php

namespace App\DataProviders;

use App\Factories\DataProviderFactory;

class ProvidersHandler
{
    /**
     * @param string|null $provider
     * @return array
     */
    public function list(string $provider = null)
    {
        $products = [];
        foreach (DataProviderFactory::getProviders($provider) as $dataProvider) {
            $products = array_merge($dataProvider->listData(), $products);
        }
        return $products;
    }
}
