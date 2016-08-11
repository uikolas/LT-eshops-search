<?php

namespace AppBundle\Service\SearchEngine\OneASearch;

use AppBundle\Service\ParseObject;
use AppBundle\Service\ParserInterface;
use AppBundle\Service\Util;
use Symfony\Component\DomCrawler\Crawler;

class OneAParser implements ParserInterface
{
    const URL = 'http://www.1a.lt/';

    /**
     * @param Crawler $crawler
     * @return mixed
     */
    public function parseDomCrawler(Crawler $crawler)
    {
        $data = [];

        if ($crawler->filter('.product')->count()) {
            $data = $crawler->filter('.product')->each(function (Crawler $node) {
                $parseObject = new ParseObject();
                $parseObject->setShop('1a');

                if ($node->filter('.p-image img')->count()) {
                    $parseObject->setImage(Util::addLink(self::URL, $node->filter('.p-image img')->attr('src')));
                }

                if ($node->filter('.p-content h3 a')->count()) {
                    $parseObject->setName($node->filter('.p-content h3 a')->text());
                }

                $parseObject->setPrice($this->extractPrice($node));

                if ($node->filter('.p-content h3 a')->count()) {
                    $parseObject->setLink(Util::addLink(self::URL, $node->filter('.p-content h3 a')->attr('href')));
                }

                return $parseObject;
            });
        }

        return $data;
    }

    /**
     * @param Crawler $node
     * @return string
     */
    private function extractPrice(Crawler $node)
    {
        $price = null;

        if ($node->filter('.new-price')->count()) {
            $price = $node->filter('.new-price')->text();
        }

        if ($node->filter('.price')->count()) {
            $price = $node->filter('.price')->text();
        }

        return $price;
    }
}
