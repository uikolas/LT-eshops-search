<?php

namespace AppBundle\Service\SearchEngine\OneASearch;

use AppBundle\Service\ParserInterface;
use AppBundle\Service\SearchInterface;
use Goutte\Client;

class OneASearch implements SearchInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @param Client $client
     * @param ParserInterface $parser
     */
    public function __construct(Client $client, ParserInterface $parser)
    {
        $this->client = $client;
        $this->parser = $parser;
    }

    /**
     * @param string $keyword
     * @return array
     */
    public function search($keyword)
    {
        $domCrawler = $this->client->request('GET', $this->getSearchUrlWithKeyword($keyword));

        $parsedArray = $this->parser->parseDomCrawler($domCrawler);

        return $parsedArray;
    }

    /**
     * @param $keyword
     * @return string
     */
    public function getSearchUrlWithKeyword($keyword)
    {
        return 'http://www.1a.lt/search/'.$keyword;
    }
}
