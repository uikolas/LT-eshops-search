<?php

namespace App\Tests\Unit\Parser;

use App\Parser\OneAParser;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\TestCase;

class OneAParserTest extends UnitTestCase
{
    public function testParse()
    {
        $content = $this->loadData('1a.txt');

        $parser = new OneAParser();

        $results = $parser->parse($content);

        $this->assertCount(72, $results);
    }
}
