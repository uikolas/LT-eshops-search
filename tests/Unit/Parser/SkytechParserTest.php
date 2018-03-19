<?php

namespace App\Tests\Unit\Parser;

use App\Parser\SkytechParser;
use App\Product;
use App\Tests\Unit\UnitTestCase;

class SkytechParserTest extends UnitTestCase
{
    public function testParse()
    {
        $content = $this->loadTestData('skytech.txt');

        $parser = new SkytechParser();

        $result = $parser->parse($content);

        $this->assertCount(138, $result);
        $this->productTest($result[0]);
    }

    /**
     * @param Product $product
     */
    private function productTest(Product $product)
    {
        $serialized = $product->jsonSerialize();

        $this->assertEquals('KSIX Armor B8595FTA01 Flexible, Samsung, Galaxy S8, TPU, Translucent/Black', $serialized['name']);
        $this->assertEquals('http://www.skytech.lt/images/small/79/1603179.png', $serialized['image']);
        $this->assertEquals('0.19 €', $serialized['price']);
        $this->assertEquals('http://www.skytech.lt/b8595fta01-ksix-armor-b8595fta01-flexible-samsung-galaxy-tpu-translucentblack-p-362042.html', $serialized['url']);
    }
}
