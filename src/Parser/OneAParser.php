<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

class OneAParser implements ParserInterface
{
    const URL = 'https://www.1a.lt';

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
                return $this->parseNode($node);
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
        return self::URL . '/search/' . $keyword . '/opened/1';
    }

    /**
     * @param Crawler $node
     * @return Product
     */
    private function parseNode(Crawler $node)
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
