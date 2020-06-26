<?php

namespace Tests\Feature;

use App\Utils\DataProvidersUtil;
use Tests\TestCase;

class ProductsFiltersTest extends TestCase
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

    /**
     * @test
     */
    public function useCanFilterProductsByCurrency()
    {
        $currency = "USD";
        $response = $this->getJson(route("products.index", ['currency' => $currency]))
            ->assertStatus(200);

        foreach ($response->getData()->products as $product) {
            $product = json_decode(json_encode($product), true);
            $this->assertSame($product["Product Currency"], $currency);
        }
    }

    /**
     * @test
     */
    public function userCanFilterProductsByStatus()
    {
        $status = "instock";
        $response = $this->getJson(route("products.index", ['statusCode' => $status]))
            ->assertStatus(200);

        foreach ($response->getData()->products as $product) {
            $product = json_decode(json_encode($product), true);
            $this->assertSame(strtolower($product["Product Status"]), $status);
        }

        $status = "outstock";
        $response = $this->getJson(route("products.index", ['statusCode' => $status]))
            ->assertStatus(200);

        foreach ($response->getData()->products as $product) {
            $product = json_decode(json_encode($product), true);
            $this->assertSame(strtolower($product["Product Status"]), $status);
        }
    }

    /**
     * @test
     */
    public function userCanFilterProductsByBalance()
    {
        $balanceMin = 1000;
        $balanceMax = 2000;
        $response = $this->getJson(route("products.index", compact('balanceMin')))
            ->assertStatus(200);

        foreach ($response->getData()->products as $product) {
            $product = json_decode(json_encode($product), true);
            $this->assertTrue($product["Product Current Price"] > $balanceMin);
        }

        $response = $this->getJson(route("products.index", compact('balanceMax')))
            ->assertStatus(200);

        foreach ($response->getData()->products as $product) {
            $product = json_decode(json_encode($product), true);
            $this->assertTrue($product["Product Current Price"] < $balanceMax);
        }

        $response = $this->getJson(route("products.index", compact('balanceMin', 'balanceMax')))
            ->assertStatus(200);

        foreach ($response->getData()->products as $product) {
            $product = json_decode(json_encode($product), true);
            $this->assertTrue($product["Product Current Price"] > $balanceMin && $product["Product Current Price"] < $balanceMax);
        }
    }

    /**
     * @test
     */
    public function userCanCombineProductsFilters()
    {
        $currency = "EUR";
        $statusCode = "instock";
        $balanceMin = 2000;
        $balanceMax = 3000;

        $response = $this->getJson(route("products.index", compact("currency", "statusCode", "balanceMin", "balanceMax")))
            ->assertStatus(200);

        foreach ($response->getData()->products as $product) {
            $product = json_decode(json_encode($product), true);
            $this->assertTrue(
                $product["Product Currency"] == $currency &&
                strtolower($product["Product Status"]) == $statusCode &&
                $product["Product Current Price"] > $balanceMin &&
                $product["Product Current Price"] < $balanceMax
            );
        }
    }
}
