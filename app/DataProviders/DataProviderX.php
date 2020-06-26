<?php

namespace App\DataProviders;

use App\Utils\DataProvidersUtil;

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
        return json_decode(file_get_contents(DataProvidersUtil::getProviderFullPath(DataProvidersUtil::x)), true);
    }
}
