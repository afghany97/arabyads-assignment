<?php

namespace App\DataProviders;

class DataProviderX extends DataProviderInterface
{
    /**
     * @inheritDoc
     */
    protected function transform(array $collection)
    {
        return array_map(function ($item) {
            return [
                "Product Identifier" => $item["ProductIdentification"] ?? null,
                "Product Name" => $item["ProductName"] ?? null,
                "Product Currency" => $item["ProductCurrency"] ?? null,
                "Product Original Price" => $item["ProductOriginalPrice"] ?? null,
                "Product Current Price" => $item["ProductCurrentPrice"] ?? null,
                "Product Status" => $item["StatusCode"] === 1 ? "InStock" : "OutStock",
                "Product Include VAT" => !!$item["IncludeVAT"] ?? null,
                "Product End Date" => $item["OfferEndDate"] ?? null,
            ];
        }, $collection);
    }

    /**
     * @inheritDoc
     */
    protected function readData()
    {
        $filePath = storage_path() . "/data/DataProviderX.json";
        return json_decode(file_get_contents($filePath), true);
    }
}
