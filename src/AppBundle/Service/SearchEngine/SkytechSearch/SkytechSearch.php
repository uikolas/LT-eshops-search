<?php

namespace AppBundle\Service\SearchEngine\SkytechSearch;

use AppBundle\Service\ParserInterface;
use AppBundle\Service\SearchInterface;
use AppBundle\Service\SearchUrlInterface;
use Goutte\Client;

class SkytechSearch implements SearchInterface, SearchUrlInterface
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
     * @return mixed
     */
    public function search($keyword)
    {
        $crawler = $this->client->request('GET', $this->getSearchUrl().$keyword);

        $parsedData = $this->parser->parse($crawler);

        return $parsedData;
    }

    /**
     * @return string
     */
    public function getSearchUrl()
    {
        return 'http://www.skytech.lt/search.php?sand=0&pav=2&sort=5a&grp=0&page=1&pagesize=100&page=1&pagesize=100&keywords=';
    }
}
