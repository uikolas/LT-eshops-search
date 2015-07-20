<?php

namespace AppBundle\Service\SearchEngine\OneASearch;

use AppBundle\Service\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;

class OneAParser implements ParserInterface
{
    const URL = 'http://www.1a.lt/';
    const SHOP = '1a.lt';

    /**
     * @param Crawler $crawler
     * @return mixed
     */
    public function parse(Crawler $crawler)
    {
        $data = $crawler->filter('.product')->count() ? $crawler->filter('.product')->each(
            function (Crawler $node) {
                $array['image'] = $node->filter('.p-image img')->count() ? $this->addLink(
                    $node->filter('.p-image img')->attr('src')
                ) : null;

                $array['name'] = $node->filter('.p-content h3 a')->count() ? $node->filter('.p-content h3 a')->text() : null;

                $array['price'] = $this->extractPrice($node);

                $array['link'] = $node->filter('.p-content h3 a')->count() ? $this->addLink(
                    $node->filter('.p-content h3 a')->attr('href')
                ) : null;

                $array['shop'] = self::SHOP;

                return $array;
            }
        ) : null;

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
