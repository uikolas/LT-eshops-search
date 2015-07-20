<?php

namespace AppBundle\Service\SearchEngine\OneASearch;

use AppBundle\Service\SearchInterface;
use Goutte\Client;

class OneASearch implements SearchInterface
{
    const URL = 'http://www.1a.lt/search/';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var OneAParser
     */
    private $parser;

    /**
     * @param Client $client
     * @param OneAParser $parser
     */
    public function __construct(Client $client, OneAParser $parser)
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
