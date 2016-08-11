<?php

namespace AppBundle\Service\SearchEngine\SkytechSearch;

use AppBundle\Service\ParseObject;
use AppBundle\Service\ParserInterface;
use AppBundle\Service\Util;
use Symfony\Component\DomCrawler\Crawler;

class SkytechParser implements ParserInterface
{
    const URL = 'http://www.skytech.lt/';

    /**
     * @param Crawler $crawler
     * @return array
     */
    public function parseDomCrawler(Crawler $crawler)
    {
        $data = [];

        if ($crawler->filter('.product-listing-grid-item')->count()) {
            $data = $crawler->filter('.product-listing-grid-item')->each(function (Crawler $node) {
                $parseObject = new ParseObject();
                $parseObject->setShop('Skytech');

                if ($node->filter('.image-wrap img')->count()) {
                    $parseObject->setImage(Util::addLink(self::URL, $node->filter('.image-wrap img')->attr('src')));
                }

                if ($node->filter('.product-name')->count()) {
                    $parseObject->setName($node->filter('.product-name')->text());
                }

                if ($node->filter('.eprice')->count()) {
                    $parseObject->setPrice($this->extractPrice($node->filter('.eprice')->text()));
                }

                if ($node->filter('.product-name a')->count()) {
                    $parseObject->setLink(Util::addLink(self::URL, $node->filter('.product-name a')->attr('href')));
                }

                return $parseObject;
            });
        }

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
}
