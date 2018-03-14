<?php

namespace App\SearchHandler;

use App\Search\SearchResult;

class KilobyteSearchHandler implements SearchHandlerInterface
{
    const URL = 'https://www.kilobaitas.lt';

    /**
     * @param string $keyword
     * @param SearchResult $searchResult
     * @return void
     */
    public function search(string $keyword, SearchResult $searchResult)
    {
        // TODO: Implement search() method. Use post with headers?
    }

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl(string $keyword)
    {
        return self::URL . '/Ieskoti/CatalogStore.aspx?criteria=' . $keyword;
    }
}
