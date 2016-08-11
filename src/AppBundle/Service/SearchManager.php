<?php

namespace AppBundle\Service;

class SearchManager
{
    /**
     * @var SearchInterface[]
     */
    private $searchEngine;

    /**
     * @param SearchInterface $searchInterface
     */
    public function setSearchEngine(SearchInterface $searchInterface)
    {
        $this->searchEngine[] = $searchInterface;
    }

    /**
     * @param $keyword
     * @return array
     */
    public function search($keyword)
    {
        $data = [];

        foreach ($this->searchEngine as $search) {
            $data[] = $search->search($keyword);
        }

        return $data;
    }
}
