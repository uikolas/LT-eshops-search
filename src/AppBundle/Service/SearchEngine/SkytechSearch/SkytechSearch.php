<?php

namespace AppBundle\Service\SearchEngine\SkytechSearch;

use AppBundle\Service\SearchInterface;
use Goutte\Client;

class SkytechSearch implements SearchInterface
{
    const URL = 'http://www.skytech.lt/search.php?sand=0&pav=2&sort=5a&grp=0&page=1&pagesize=100&page=1&pagesize=100&keywords=';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var SkytechParser
     */
    private $parser;

    public function __construct(Client $client, SkytechParser $parser)
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
        $crawler = $this->client->request('GET', self::URL.$keyword);

        $parsedData = $this->parser->parse($crawler);

        return $parsedData;
    }
}
