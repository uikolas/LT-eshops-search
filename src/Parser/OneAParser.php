<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

class OneAParser implements Parser
{
    /**
     * @param string $content
     * @return Product[]
     */
    public function parse($content)
    {
        $data = [];

        $crawler = new Crawler($content);

        $products = $crawler->filter('.product');

        if ($products->count()) {
            $data = $products->each(function (Crawler $node) {
                $image = trim($node->filter('.p-image img')->attr('src'));

                $name = trim($node->filter('.p-content h3 a')->text());

                $link = trim($node->filter('.p-content h3 a')->attr('href'));

                $price = trim($node->filter('.price')->text());

                return new Product($name, $image, $price, $link, '1A.lt');
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
        return 'https://www.1a.lt/search/' . $keyword . '/opened/1';
    }
}
