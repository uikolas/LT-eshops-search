<?php

namespace App\Parser;

use App\Search\Product;
use Symfony\Component\DomCrawler\Crawler;

class KilobyteParser implements ParserInterface
{
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
                $image = trim($node->filter('.itemBoxImage .ItemLink img')->attr('src'));

                $name = trim($node->filter('.ItemLink a')->text());

                $link = trim($node->filter('.ItemLink a')->attr('href'));

                $price = trim($node->filter('.itemBoxPrice div')->eq(1)->text());

                return new Product($name, $image, $price, $link, 'Kilobaitas');
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
        return 'https://www.kilobaitas.lt/Ieskoti/CatalogStore.aspx?criteria=' . $keyword;
    }
}
