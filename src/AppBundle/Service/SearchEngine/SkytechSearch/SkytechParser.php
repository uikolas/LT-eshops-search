<?php

namespace AppBundle\Service\SearchEngine\SkytechSearch;

use AppBundle\Service\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;

class SkytechParser implements ParserInterface
{
    const URL = 'http://www.skytech.lt/';
    const SHOP = 'Skytech';

    /**
     * @param Crawler $crawler
     * @return mixed
     */
    public function parse(Crawler $crawler)
    {
        $data = $crawler->filter('.product-listing-grid-item')->count() ? $crawler->filter('.product-listing-grid-item')->each(
            function (Crawler $node) {
                $array['image'] = $node->filter('.image-wrap img')->count() ? $this->addLink(
                    $node->filter('.image-wrap img')->attr('src')
                ) : null;

                $array['name'] = $node->filter('.product-name')->count() ? $node->filter('.product-name')->text() : null;

                $array['price'] = $node->filter('.eprice')->count() ? $this->extractPrice(
                    $node->filter('.eprice')->text()
                ) : null;

                $array['link'] = $node->filter('.product-name a')->count() ? $this->addLink(
                    $node->filter('.product-name a')->attr('href')
                ) : null;

                $array['shop'] = self::SHOP;

                return $array;
            }
        ) : null;

        return $data;
    }

    /**
     * @param $price
     * @return string
     */
    private function extractPrice($price)
    {
        $price = explode('/', $price);
        $price = str_replace(' ', '', $price[0]);

        return $price;
    }

    /**
     * @param $string
     * @return string
     */
    private function addLink($string)
    {
        $string = ltrim($string, '/');
        return self::URL.$string;
    }
}
