<?php

namespace App\Parser;

use App\Product;
use App\SearchHandler\SkytechSearchHandler;
use Symfony\Component\DomCrawler\Crawler;

class SkytechParser extends AbstractDomCrawlerParser
{
    /**
     * @return string
     */
    protected function styleName()
    {
        return '.product-listing-grid-item';
    }

    /**
     * @param Crawler $node
     * @return Product
     */
    protected function parseNode(Crawler $node)
    {
        $image = SkytechSearchHandler::URL . trim($node->filter('.image-wrap img')->attr('src'));

        $name = trim($node->filter('.product-name')->text());

        $link = SkytechSearchHandler::URL . trim($node->filter('.product-name a')->attr('href'));

        $price = $this->extractPrice($node);

        return new Product($name, $image, $price, $link, 'Skytech');
    }

    /**
     * @param Crawler $node
     * @return string
     */
    private function extractPrice(Crawler $node)
    {
        $price = trim($node->filter('.eprice')->text());

        $priceWithoutCurrency = mb_substr($price, 0, -1);

        $currency = mb_substr($price, -1);

        return "{$priceWithoutCurrency} {$currency}";
    }
}
