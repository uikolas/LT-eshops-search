<?php

namespace App\Tests\Unit\Parser;

use App\Parser\KilobyteParser;
use App\Search\Product;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\TestCase;

class KilobyteParserTest extends UnitTestCase
{
    public function testParse()
    {
        $content = $this->loadTestData('kilobyte.txt');

        $parser = new KilobyteParser();

        $result = $parser->parse($content);

        $this->assertCount(29, $result);
        $this->productTest($result[0]);
    }

    /**
     * @param Product $product
     */
    private function productTest(Product $product)
    {
        $serialized = $product->jsonSerialize();

        $this->assertEquals('Qoltec Premium case for smartphone Samsung Galaxy S8 | TPU', $serialized['name']);
        $this->assertEquals('https://www.kilobaitas.lt/Pub/ShowImage.aspx?itemID=ABCDATA_C8331212&image=C8331212&h=125&w=175&errorImage=/Images/design/noImage.gif', $serialized['image']);
        $this->assertEquals('2.44 €', $serialized['price']);
        $this->assertEquals('https://www.kilobaitas.lt/Mobiliu_telefonu_priedai/Qoltec/Qoltec_Premium_case_for_smartp/51386/CatalogStoreDetail.aspx?CatID=PL_554&ID=732267', $serialized['url']);
    }
}
