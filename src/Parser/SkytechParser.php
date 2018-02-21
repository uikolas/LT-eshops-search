<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

class SkytechParser implements Parser
{
    /**
     * @param string $content
     * @return Product[]
     */
    public function parse($content)
    {
        $data = [];

        $crawler = new Crawler($content);

        $products = $crawler->filter('.product-listing-grid-item');

        if ($products->count()) {
            $data = $products->each(function (Crawler $node) {
                $image = trim($node->filter('.image-wrap img')->attr('src'));

                $name = trim($node->filter('.product-name')->text());

                $link = trim($node->filter('.product-name a')->attr('href'));

                $price = trim($node->filter('.eprice')->text());

                return new Product($name, $image, $price, $link, 'Skytech');
            });
        }

        return $data;
    }
    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl($keyword)
    {
        return 'http://www.skytech.lt/search.php?sand=0&pav=2&sort=5a&grp=0&page=1&pagesize=100&page=1&pagesize=100&keywords=' . $keyword . '&x=0&y=0&search_in_description=0&';
    }
}
