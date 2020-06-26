<?php

namespace App\Filters;

class ProductsFilters extends FiltersService
{
    protected $filters = [
        "statusCode",
        "currency",
        "balanceMin",
        "balanceMax",
    ];

    public function statusCode(string $statusCode)
    {
        foreach ($this->collection as $key => $value) {
            if (strtolower($this->collection[$key]["Product Status"]) != $statusCode) {
                unset($this->collection[$key]);
            }
        }
    }

    public function currency(string $currency)
    {
        foreach ($this->collection as $key => $value) {
            if ($this->collection[$key]["Product Currency"] != $currency) {
                unset($this->collection[$key]);
            }
        }
    }

    public function balanceMin($price)
    {
        foreach ($this->collection as $key => $value) {
            if ($this->collection[$key]["Product Current Price"] < $price) {
                unset($this->collection[$key]);
            }
        }
    }

    public function balanceMax($price)
    {
        foreach ($this->collection as $key => $value) {
            if ($this->collection[$key]["Product Current Price"] > $price) {
                unset($this->collection[$key]);
            }
        }
    }
}
