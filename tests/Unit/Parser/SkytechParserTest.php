<?php

namespace App\Tests\Unit\Parser;

use App\Parser\SkytechParser;
use App\Tests\Unit\UnitTestCase;

class SkytechParserTest extends UnitTestCase
{
    public function testParse()
    {
        $content = $this->loadData('skytech.txt');

        $parser = new SkytechParser();

        $result = $parser->parse($content);

        $this->assertCount(138, $result);

        $firstItem = $result[0];
    }
}
