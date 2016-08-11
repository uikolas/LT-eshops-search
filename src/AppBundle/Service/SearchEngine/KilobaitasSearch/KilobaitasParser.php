<?php

namespace AppBundle\Service\SearchEngine\KilobaitasSearch;

use AppBundle\Service\ParseObject;
use AppBundle\Service\ParserInterface;
use AppBundle\Service\Util;
use Symfony\Component\DomCrawler\Crawler;

class KilobaitasParser implements ParserInterface
{
    const URL = 'http://www.kilobaitas.lt/';

    /**
     * @param Crawler $crawler
     * @return array
     */
    public function parseDomCrawler(Crawler $crawler)
    {
        $data = [];

        if ($crawler->filter('.itemNormal')->count()) {
            $data = $crawler->filter('.itemNormal')->each(function (Crawler $node) {
                $parseObject = new ParseObject();
                $parseObject->setShop('Kilobaitas');

                if ($node->filter('.itemBoxImage .ItemLink img')->count()) {
                    $parseObject->setImage($this->fixImgUrl($node->filter('.itemBoxImage .ItemLink img')->attr('src')));
                }

                if ($node->filter('.ItemLink a')->count()) {
                    $parseObject->setName($this->fixName($node->filter('.ItemLink a')->text()));
                }

                if ($node->filter('.itemBoxPrice div')->count()) {
                    $parseObject->setPrice($this->extractPrice($node->filter('.itemBoxPrice div')->eq(1)->text()));
                }

                if ($node->filter('.ItemLink a')->count()) {
                    $parseObject->setLink(Util::addLink(self::URL, $node->filter('.ItemLink a')->attr('href')));
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
        $price = trim($price);
        $price = explode(' ', $price);
        $price = count($price) > 4 ? $price[2] : $price[0];
        $price = str_replace(',', '.', $price);

        return $price;
    }

    /**
     * @param $url
     * @return string
     */
    private function fixImgUrl($url)
    {
        if (!Util::hasHttp($url)) {
            $url = Util::addLink(self::URL, $url);
        }

        return $url;
    }

    private function fixName($name)
    {
        $name = trim($name);

        return $name;
    }
}
