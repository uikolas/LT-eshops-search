<?php

namespace App\SearchHandler;

use App\Search\SearchResult;

interface SearchHandlerInterface
{
    /**
     * @param string $keyword
     * @param SearchResult $searchResult
     * @return void
     */
    public function search(string $keyword, SearchResult $searchResult);

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl(string $keyword);
}
