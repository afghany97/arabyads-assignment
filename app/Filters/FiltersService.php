<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class FiltersService
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $collection;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @param array $collection
     * @param Request $request
     * @return array
     */
    public function apply(array $collection, Request $request)
    {
        $this->request = $request;
        $this->collection = $collection;

        foreach ($this->filters as $filter) {
            if (method_exists($this, $filter) && $request->filled($filter)) {
                $this->$filter($request->$filter);
            }
        }
        return $this->collection;
    }
}
