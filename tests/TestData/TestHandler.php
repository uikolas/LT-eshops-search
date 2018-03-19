<?php


namespace App\Tests\TestData;

use App\Product;
use App\Search\SearchResult;
use App\SearchHandler\SearchHandlerInterface;

class TestHandler implements SearchHandlerInterface
{

    /**
     * @param string $keyword
     * @param SearchResult $searchResult
     * @return void
     */
    public function search(string $keyword, SearchResult $searchResult)
    {
        $searchResult->addProduct(new Product('Test', 'Test', 'Test', 'Test', 'Test'));
    }

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl(string $keyword)
    {
        // TODO: Implement getUrl() method.
    }
}
