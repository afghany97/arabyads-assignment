<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * @test
     */
    public function testIsProductsEndResponds()
    {
        $this->getJson("/api/v1/products")
            ->assertStatus(200);
    }
}
