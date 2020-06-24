<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * @test
     */
    public function testIsProductsEndPointResponds()
    {
        $this->getJson(route("products.index"))
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function userCanListingAllProducts()
    {
        $response = $this->getJson(route("products.index"))
            ->assertStatus(200);

        $this->assertCount(2000, $response->getData()->products);
    }
}
