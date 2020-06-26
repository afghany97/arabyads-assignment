<?php

namespace App\Utils;

class DataProvidersUtil
{
    const x = "DataProviderX";
    const y = "DataProviderY";
    private const providerExtension = ".json";


    /**
     * @var array
     */
    private static $providersWithExtension = [
        self::x => self::x . self::providerExtension,
        self::y => self::y . self::providerExtension
    ];

    /**
     * @param string $provider
     * @return string
     */
    public static function getProviderFullPath(string $provider)
    {
        return storage_path("data/") . self::$providersWithExtension[$provider] ?? null . ".json";
    }
}

