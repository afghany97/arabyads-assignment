<?php

namespace Tests\Feature;

use App\Utils\DataProvidersUtil;
use Tests\TestCase;

class ProductsProvidersTest extends TestCase
{
    /**
     * @test
     */
    public function userCanGetProductsFromProviderXOnly()
    {
        $response = $this->getJson(route("products.index", ['provider' => "DataProviderX"]))
            ->assertStatus(200);

        $providerXProductsCount = count(json_decode(
            file_get_contents(DataProvidersUtil::getProviderFullPath(DataProvidersUtil::x)), true
        ));
        $this->assertCount($providerXProductsCount, $response->getData()->products);
    }

    /**
     * @test
     */
    public function userCanGetProductsFromProviderYOnly()
    {
        $response = $this->getJson(route("products.index", ['provider' => "DataProviderY"]))
            ->assertStatus(200);

        $providerXProductsCount = count(json_decode(
            file_get_contents(DataProvidersUtil::getProviderFullPath(DataProvidersUtil::y)), true
        ));
        $this->assertCount($providerXProductsCount, $response->getData()->products);
    }
}
