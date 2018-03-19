<?php

namespace App\Search;

use App\SearchHandler\SearchHandlerInterface;
use React\EventLoop\LoopInterface;

class Searcher
{
    /**
     * @var SearchHandlerInterface[]
     */
    private $searchHandlers;

    /**
     * @var SearcherValidator
     */
    private $validator;

    /**
     * @var LoopInterface
     */
    private $loop;

    public function __construct(iterable $searchHandlers, SearcherValidator $validator, LoopInterface $loop)
    {
        $this->searchHandlers = $searchHandlers;
        $this->validator      = $validator;
        $this->loop           = $loop;
    }

    /**
     * @param string $keyword
     * @return SearchResult
     */
    public function search(string $keyword)
    {
        $searchResult = new SearchResult();

        foreach ($this->searchHandlers as $searchHandler) {
            $searchHandler->search($keyword, $searchResult);
        }

        $this->loop->run();

        return $searchResult;
    }
}
