<?php

namespace App\DataProviders;

class ProvidersHandler
{
    /**
     * @var array
     */
    private $dataProviders = [
        DataProviderX::class,
        DataProviderY::class
    ];

    /**
     * @return array
     */
    public function list()
    {
        $products = [];

        foreach ($this->dataProviders as $dataProvider) {
            $products = array_merge((resolve($dataProvider))->listData(), $products);
        }
        return $products;
    }
}
