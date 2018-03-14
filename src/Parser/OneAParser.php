<?php

namespace App\Parser;

use App\Product;
use App\SearchHandler\OneASearchHandler;
use Symfony\Component\DomCrawler\Crawler;

class OneAParser extends AbstractDomCrawlerParser
{
    /**
     * @return string
     */
    protected function styleName()
    {
        return '.product';
    }

    /**
     * @param Crawler $node
     * @return Product
     */
    protected function parseNode(Crawler $node)
    {
        $image = OneASearchHandler::URL . trim($node->filter('.p-image img')->attr('src'));

        $name = trim($node->filter('.p-content h3 a')->text());

        $link = OneASearchHandler::URL .  trim($node->filter('.p-content h3 a')->attr('href'));

        $price = $this->extractPrice($node);

        return new Product($name, $image, $price, $link, '1A.lt');
    }

    /**
     * @param Crawler $node
     * @return string
     */
    private function extractPrice(Crawler $node)
    {
        $price = trim($node->filter('.price')->text());

        $cents = substr($price, -2);

        $currency = mb_substr($price, 0, 1);

        $newPrice = str_replace([$cents, $currency], '', $price);

        return "{$newPrice}.{$cents} {$currency}";
    }
}
