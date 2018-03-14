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
    public function appendProducts(array $products)
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
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
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
