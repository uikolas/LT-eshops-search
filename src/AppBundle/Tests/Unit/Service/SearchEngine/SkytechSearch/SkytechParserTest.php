<?php
/**
 * Created by PhpStorm.
 * User: Arvydas
 * Date: 2015-07-19
 * Time: 11:40
 */

namespace AppBundle\Tests\Unit\Service\SearchEngine\SkytechSearch;


use AppBundle\Service\SearchEngine\SkytechSearch\SkytechParser;
use AppBundle\Tests\KernelAwareTest;
use Goutte\Client;

class SkytechParserTest extends KernelAwareTest
{
    /**
     * @var SkytechParser
     */
    private $parser;

    public function setUp()
    {
        parent::setUp();

        $this->parser = $this->container->get('app.service.search_engine.skytech.parser');
    }

    public function testNotNullNodes()
    {
        $keyword = 'samsung s5';

        $client = new Client();

        $searchEngine = $this->container->get('app.service.search_engine.skytech.search');

        $crawler = $client->request('GET', $searchEngine->getSearchUrlWithKeyword().$keyword);

        $parsedData = $this->parser->parseDomCrawler($crawler);

        $this->assertTrue(count($parsedData) > 0);

        foreach ($parsedData as $data) {
            $this->assertNotNull($data['image'], 'Got null response, on image parse');
            $this->assertNotNull($data['name'], 'Got null response, on name parse');
            $this->assertNotNull($data['price'], 'Got null response, on price parse');
            $this->assertNotNull($data['link'], 'Got null response, on link parse');
        }
    }
}
