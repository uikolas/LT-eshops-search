<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

class KilobyteParser extends AbstractDomCrawlerParser
{
    const URL = 'https://www.kilobaitas.lt';

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl($keyword)
    {
        return self::URL . '/Ieskoti/CatalogStore.aspx?criteria=' . $keyword;
    }

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

        $link = self::URL . trim($node->filter('.ItemLink a')->attr('href'));

        $price = str_replace(',', '.', trim($node->filter('.itemBoxPrice div')->eq(1)->text()));

        return new Product($name, $image, $price, $link, 'Kilobaitas');
    }
}
