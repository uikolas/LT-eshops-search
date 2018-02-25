<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractDomCrawlerParser implements ParserInterface
{
    /**
     * @param string $content
     * @return Product[]
     */
    public function parse($content)
    {
        $data = [];

        $crawler = new Crawler($content);

        $products = $crawler->filter($this->styleName());

        if ($products->count()) {
            $data = $products->each(function (Crawler $node) {
                return $this->parseNode($node);
            });
        }

        return $data;
    }

    /**
     * @return string
     */
    abstract protected function styleName();

    /**
     * @param Crawler $node
     * @return Product
     */
    abstract protected function parseNode(Crawler $node);
}
