<?php

namespace AppBundle\Tests\Unit\Service\SearchEngine\KilobaitasSearch;

use AppBundle\Service\SearchEngine\KilobaitasSearch\KilobaitasParser;
use AppBundle\Tests\KernelAwareTest;
use Goutte\Client;

class KilobaitasParserTest extends KernelAwareTest
{
    /**
     * @var KilobaitasParser
     */
    private $parser;

    public function setUp()
    {
        parent::setUp();

        $this->parser = $this->container->get('app.service.search_engine.kilobaitas.parser');
    }

    public function testNotNullNodes()
    {
        $keyword = 'samsung sync master';

        $client = new Client();

        $searchEngine = $this->container->get('app.service.search_engine.kilobaitas.search');

        $crawler = $client->request('GET', $searchEngine::URL.$keyword);

        $parsedData = $this->parser->parseDomCrawler($crawler);

        foreach ($parsedData as $data) {
            $this->assertNotNull($data['image'], 'Got null response, on image parse');
            $this->assertNotNull($data['name'], 'Got null response, on name parse');
            $this->assertNotNull($data['price'], 'Got null response, on price parse');
            $this->assertNotNull($data['link'], 'Got null response, on link parse');
        }
    }
}
