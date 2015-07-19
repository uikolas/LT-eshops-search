<?php

namespace AppBundle\Service\SearchEngine\KilobaitasSearch;

use AppBundle\Service\ParserInterface;
use AppBundle\Service\Util;
use Symfony\Component\DomCrawler\Crawler;

class KilobaitasParser implements ParserInterface
{
    const URL = 'http://www.kilobaitas.lt/';
    const SHOP = 'Kilobaitas';

    /**
     * @param Crawler $crawler
     * @return mixed
     */
    public function parse(Crawler $crawler)
    {
        $data = $crawler->filter('.itemNormal')->count() ? $crawler->filter('.itemNormal')->each(
            function (Crawler $node) {
                $array['image'] = $node->filter('.itemBoxImage .ItemLink img')->count() ? $this->fixImgUrl(
                    $node->filter('.itemBoxImage .ItemLink img')->attr('src')
                ) : null;

                $array['name'] = $node->filter('.ItemLink a')->count() ? $node->filter('.ItemLink a')->text() : null;

                $array['price'] = $node->filter('.itemBoxPrice div')->count() ? $this->extractPrice(
                    $node->filter('.itemBoxPrice div')->eq(1)->text()
                ) : null;

                $array['link'] = $node->filter('.ItemLink a')->count() ? $this->addLink(
                    $node->filter('.ItemLink a')->attr('href')
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
        $price = trim($price);
        $price = explode(' ', $price);
        $price = count($price) > 4 ? $price[2] : $price[0];
        $price = str_replace(',', '.', $price);

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

    /**
     * @param $string
     * @return string
     */
    private function fixImgUrl($string)
    {
        if (!Util::hasHttp($string)) {
            $string = $this->addLink($string);
        }

        return $string;
    }
}
