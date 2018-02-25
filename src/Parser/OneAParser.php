<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

class OneAParser extends AbstractDomCrawlerParser
{
    const URL = 'https://www.1a.lt';

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl($keyword)
    {
        return self::URL . '/search/' . $keyword . '/opened/1';
    }

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
        $image = self::URL . trim($node->filter('.p-image img')->attr('src'));

        $name = trim($node->filter('.p-content h3 a')->text());

        $link = self::URL .  trim($node->filter('.p-content h3 a')->attr('href'));

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
