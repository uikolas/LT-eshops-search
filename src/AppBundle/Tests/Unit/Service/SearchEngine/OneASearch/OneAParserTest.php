<?php
/**
 * Created by PhpStorm.
 * User: Arvydas
 * Date: 2015-07-20
 * Time: 21:09
 */

namespace AppBundle\Tests\Unit\Service\SearchEngine\OneASearch;


use AppBundle\Service\SearchEngine\OneASearch\OneAParser;
use AppBundle\Tests\KernelAwareTest;
use Goutte\Client;

class OneAParserTest extends KernelAwareTest
{
    /**
     * @var OneAParser
     */
    private $parser;

    public function setUp()
    {
        parent::setUp();

        $this->parser = $this->container->get('app.service.search_engine.one_a.parser');
    }

    public function testNotNullNodes()
    {
        $keyword = 'GTX 970';

        $client = new Client();

        $searchEngine = $this->container->get('app.service.search_engine.one_a.search');

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
