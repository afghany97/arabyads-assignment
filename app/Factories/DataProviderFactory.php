<?php

namespace App\Factories;

use App\DataProviders\DataProviderX;
use App\DataProviders\DataProviderY;

class DataProviderFactory
{
    /**
     * @param string $provider
     * @return array
     */
    public static function getProviders(string $provider = null)
    {
        switch ($provider) {
            case "DataProviderX":
                return [resolve(DataProviderX::class)];
            case "DataProviderY":
                return [resolve(DataProviderY::class)];
            default:
                return [resolve(DataProviderX::class), resolve(DataProviderY::class)];
        }
    }
}
