<?php

namespace App\Tests\Unit\Parser;

use App\Parser\KilobyteParser;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\TestCase;

class KilobyteParserTest extends UnitTestCase
{
    public function testParse()
    {
        $content = $this->loadData('kilobyte.txt');

        $parser = new KilobyteParser();

        $result = $parser->parse($content);

        $this->assertCount(29, $result);
    }
}
