<?php

namespace AppBundle\Service;

interface SearchInterface
{
    /**
     * @param string $keyword
     * @return mixed
     */
    public function search($keyword);

    /**
     * @param string $keyword
     * @return string
     */
    public function getSearchUrlWithKeyword($keyword);
}
