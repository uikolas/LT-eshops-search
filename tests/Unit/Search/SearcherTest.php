<?php

namespace App\Tests\Unit\Search;

use App\Search\Searcher;
use App\Search\SearcherValidator;
use App\Tests\TestData\TestHandler;
use App\Tests\TestData\TestParser;
use PHPUnit\Framework\TestCase;
use React\EventLoop\LoopInterface;

class SearcherTest extends TestCase
{
    public function testSearch()
    {
        $keyword = 'Testing';

        $parsers = [
            new TestHandler()
        ];

        $validator = $this->getMockBuilder(SearcherValidator::class)->getMock();
        $loop    = $this->getMockBuilder(LoopInterface::class)->getMock();

        $searcher = new Searcher($parsers, $validator, $loop);

        $result = $searcher->search($keyword);

        $this->assertCount(1, $result);
    }
}
