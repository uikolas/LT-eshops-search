<?php

namespace App\Parser;

use App\Product;

interface ParserInterface
{
    /**
     * @param string $content
     * @return Product[]
     */
    public function parse($content);

}
