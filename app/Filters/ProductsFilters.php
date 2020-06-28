<?php

namespace App\Filters;

class ProductsFilters extends FiltersService
{
    protected $filters = [
        "statusCode",
        "currency"
    ];

    protected $forcedFilters = [
        "balanceMin",
        "balanceMax"
    ];

    public function statusCode(string $statusCode)
    {
        $this->appendCondition('strtolower($this->collection[$key]["Product Status"]) != $request->statusCode');
    }

    public function currency(string $currency)
    {
        $this->appendCondition('$this->collection[$key]["Product Currency"] != $request->currency');
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
