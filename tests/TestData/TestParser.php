<?php

namespace App\Tests\TestData;

use App\Parser\ParserInterface;
use App\Search\Product;

class TestParser implements ParserInterface
{

    /**
     * @param string $content
     * @return Product[]
     */
    public function parse($content)
    {
        return [
            new Product('Name', 'Image', 'Price', 'url', 'Shop'),
        ];
    }

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl($keyword)
    {
        return 'TESTING_' . $keyword;
    }
}
