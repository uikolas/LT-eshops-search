<?php

namespace App\Tests\Unit\Search;

use App\Client\ClientInterface;
use App\Search\SearchHandler;
use App\Search\SearchHandlerValidator;
use App\Tests\TestData\TestParser;
use PHPUnit\Framework\TestCase;

class SearchHandlerTest extends TestCase
{
    public function testSearch()
    {
        $keyword = 'Testing';

        $parsers = [
            new TestParser()
        ];

        $validator = $this->getMockBuilder(SearchHandlerValidator::class)->getMock();
        $client    = $this->getMockBuilder(ClientInterface::class)->getMock();

        $validator->expects($this->once())->method('validate')->with($keyword);
        $client->expects($this->once())->method('get');
        $client->expects($this->once())->method('run');

        $search = new SearchHandler($parsers, $validator, $client);

        $results = $search->search($keyword);

    }
}
