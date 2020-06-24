<?php

namespace App\DataProviders;

abstract class DataProviderInterface
{
    /**
     * @param array $collection
     * @return array
     */
    abstract protected function transform(array $collection);

    /**
     * @return array
     */
    abstract protected function readData();

    /**
     * @return array
     */
    public function listData()
    {
        return $this->transform($this->readData());
    }
}
