<?php

namespace AppBundle\Service\SearchEngine\KilobaitasSearch;

use AppBundle\Service\SearchInterface;
use Goutte\Client;

class KilobaitasSearch implements SearchInterface
{
    const URL = 'http://www.kilobaitas.lt/Ieskoti/CatalogStore.aspx?criteria=';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var KilobaitasParser
     */
    private $parser;

    /**
     * @param Client $client
     * @param KilobaitasParser $parser
     */
    public function __construct(Client $client, KilobaitasParser $parser)
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
        $crawler = $this->client->request('GET', self::URL.$keyword);

        $parsedData = $this->parser->parse($crawler);

        return $parsedData;
    }
}
