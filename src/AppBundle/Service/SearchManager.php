<?php

namespace AppBundle\Service;

class SearchManager
{
    /**
     * @var SearchInterface
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

        /*** @var SearchInterface $search */
        if ($this->searchEngine) {
            foreach ($this->searchEngine as $search) {
                $array[] = $search->search($keyword);
                $data = array_merge($array);
            }
        }

        return $data;
    }
}
