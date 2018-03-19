<?php

namespace App\Tests\Unit\Parser;

use App\Parser\OneAParser;
use App\Product;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\TestCase;

class OneAParserTest extends UnitTestCase
{
    public function testParse()
    {
        $content = $this->loadTestData('1a.txt');

        $parser = new OneAParser();

        $results = $parser->parse($content);

        $this->assertCount(72, $results);
        $this->productTest($results[0]);
    }

    /**
     * @param Product $product
     */
    private function productTest(Product $product)
    {
        $serialized = $product->jsonSerialize();

        $this->assertEquals('BlueStar Tempered Glass Extra Shock Screen Protector For Samsung Galaxy S8', $serialized['name']);
        $this->assertEquals('https://www.1a.lt/images/products/common/000988/723049_small.jpg', $serialized['image']);
        $this->assertEquals('5.12 €', $serialized['price']);
        $this->assertEquals('https://www.1a.lt/telefonai_plansetiniai_kompiuteriai/priedai_mobiliems_telefonams/apsaugines_ekrano_pleveles/bluestar_tempered_glass_extra_shock_screen_protector_for_samsung_galaxy_s8', $serialized['url']);
    }
}
