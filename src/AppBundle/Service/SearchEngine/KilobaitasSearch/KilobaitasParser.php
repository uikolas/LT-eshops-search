<?php

namespace AppBundle\Service\SearchEngine\KilobaitasSearch;

use AppBundle\Service\ParserInterface;
use AppBundle\Service\Util;
use Symfony\Component\DomCrawler\Crawler;

class KilobaitasParser implements ParserInterface
{
    const URL = 'http://www.kilobaitas.lt/';

    /**
     * @param Crawler $crawler
     * @return mixed
     */
    public function parse(Crawler $crawler)
    {
        $data = null;

        if ($crawler->filter('.itemNormal')->count()) {
            $data = $crawler->filter('.itemNormal')->each(function (Crawler $node) {
                $array['image'] = null;
                $array['name']  = null;
                $array['price'] = null;
                $array['link']  = null;

                if ($node->filter('.itemBoxImage .ItemLink img')->count()) {
                    $array['image'] = $this->fixImgUrl($node->filter('.itemBoxImage .ItemLink img')->attr('src'));
                }

                if ($node->filter('.ItemLink a')->count()) {
                    $array['name'] = $this->fixName($node->filter('.ItemLink a')->text());
                }

                if ($node->filter('.itemBoxPrice div')->count()) {
                    $array['price'] = $this->extractPrice($node->filter('.itemBoxPrice div')->eq(1)->text());
                }

                if ($node->filter('.ItemLink a')->count()) {
                    $array['link'] = $this->addLink($node->filter('.ItemLink a')->attr('href'));
                }

                $array['shop'] = 'Kilobaitas';

                return $array;
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

    private function fixName($name)
    {
        $name = trim($name);

        return $name;
    }
}
