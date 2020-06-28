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
     * @var array
     */
    protected $forcedFilters = [];

    /**
     * @var string
     */
    protected $condition = null;

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

        foreach ($this->collection as $key => $value) {
            if (eval($this->prepareCondition())) {
                unset($this->collection[$key]);
            }
        }

        foreach ($this->forcedFilters as $forcedFilter) {
            if (method_exists($this, $forcedFilter) && $request->filled($forcedFilter)) {
                $this->$forcedFilter($request->$forcedFilter);
            }

        }

        return $this->collection;
    }

    protected function appendCondition(string $condition)
    {
        if (!$this->condition) {
            $this->condition = "return " . $condition;
        } else {
            $this->condition .= " && " . $condition;
        }
    }

    private function prepareCondition()
    {
        return $this->condition . ";";
    }
}
