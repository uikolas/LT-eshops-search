<?php

namespace App\Parser;

use App\Search\Product;

interface ParserInterface
{
    /**
     * @param string $content
     * @return Product[]
     */
    public function parse($content);

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl($keyword);
}
