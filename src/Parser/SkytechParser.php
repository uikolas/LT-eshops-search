<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

class SkytechParser extends AbstractDomCrawlerParser
{
    const URL = 'http://www.skytech.lt/';

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl($keyword)
    {
        return self::URL . 'search.php?sand=0&pav=2&sort=5a&grp=0&page=1&pagesize=100&page=1&pagesize=100&keywords=' . $keyword . '&x=0&y=0&search_in_description=0&';
    }

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
        $image = self::URL . trim($node->filter('.image-wrap img')->attr('src'));

        $name = trim($node->filter('.product-name')->text());

        $link = self::URL . trim($node->filter('.product-name a')->attr('href'));

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
