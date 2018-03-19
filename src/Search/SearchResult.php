<?php

namespace App\Search;

use App\Product;

class SearchResult implements \Countable, \JsonSerializable
{
    /**
     * @var Product[]
     */
    private $products = [];

    /**
     * @param Product[] $products
     */
    public function addProducts(array $products)
    {
        $this->products = array_merge($products, $this->products);
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->products);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'data'  => $this->getProducts(),
            'total' => $this->count(),
        ];
    }
}
