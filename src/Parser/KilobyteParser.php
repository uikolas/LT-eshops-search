<?php

namespace App\Parser;

use App\Product;
use App\SearchHandler\KilobyteSearchHandler;
use Symfony\Component\DomCrawler\Crawler;

class KilobyteParser extends AbstractDomCrawlerParser
{
    /**
     * @return string
     */
    protected function styleName()
    {
        return '.itemNormal';
    }

    /**
     * @param Crawler $node
     * @return Product
     */
    protected function parseNode(Crawler $node)
    {
        $image = trim($node->filter('.itemBoxImage .ItemLink img')->attr('src'));

        $name = trim($node->filter('.ItemLink a')->text());

        $link = KilobyteSearchHandler::URL . trim($node->filter('.ItemLink a')->attr('href'));

        $price = $this->extractPrice($node->filter('.itemBoxPrice div')->eq(1));

        return new Product($name, $image, $price, $link, 'Kilobaitas');
    }

    /**
     * @param Crawler $node
     * @return string
     */
    private function extractPrice(Crawler $node)
    {
        $dateNode = $node->filter('.DeliveryDate');

        if ($dateNode->count()) {
            $date  = $dateNode->text();
            $line  = trim($node->text());
            $price = trim(str_replace($date, '', $line));
        } else {
            $price = trim($node->text());
        }

        return str_replace(',', '.', $price);
    }
}
