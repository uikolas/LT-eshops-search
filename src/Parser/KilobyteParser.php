<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

class KilobyteParser implements ParserInterface
{
    const URL = 'https://www.kilobaitas.lt';

    /**
     * @param string $content
     * @return Product[]
     */
    public function parse($content)
    {
        $data = [];

        $crawler = new Crawler($content);

        $products = $crawler->filter('.itemNormal');

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
        return self::URL . '/Ieskoti/CatalogStore.aspx?criteria=' . $keyword;
    }

    /**
     * @param Crawler $node
     * @return Product
     */
    private function parseNode(Crawler $node)
    {
        $image = trim($node->filter('.itemBoxImage .ItemLink img')->attr('src'));

        $name = trim($node->filter('.ItemLink a')->text());

        $link = self::URL . trim($node->filter('.ItemLink a')->attr('href'));

        $price = str_replace(',', '.', trim($node->filter('.itemBoxPrice div')->eq(1)->text()));

        return new Product($name, $image, $price, $link, 'Kilobaitas');
    }
}
