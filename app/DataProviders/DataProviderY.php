<?php

namespace App\DataProviders;

use App\Utils\DataProvidersUtil;

class DataProviderY extends DataProviderInterface
{
    /**
     * @inheritDoc
     */
    protected function transform(array $collection)
    {
        return array_map(function ($item) {
            return [
                "Product Identifier" => $item["id"] ?? null,
                "Product Name" => $item["name"] ?? null,
                "Product Currency" => $item["currency"] ?? null,
                "Product Original Price" => $item["original_price"] ?? null,
                "Product Current Price" => $item["current_price"] ?? null,
                "Product Status" => $item["status"] === 1 ? "InStock" : "OutStock",
                "Product Include VAT" => !!$item["include_VAT"] ?? null,
                "Product End Date" => $item["end_date"] ?? null,
            ];
        }, $collection);
    }

    /**
     * @inheritDoc
     */
    protected function readData()
    {
        return json_decode(file_get_contents(DataProvidersUtil::getProviderFullPath(DataProvidersUtil::y)), true);
    }
}
