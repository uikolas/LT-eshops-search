<?php

namespace AppBundle\Service\SearchEngine\KilobaitasSearch;

use AppBundle\Service\ParserInterface;
use AppBundle\Service\SearchInterface;
use AppBundle\Service\SearchUrlInterface;
use Goutte\Client;

class KilobaitasSearch implements SearchInterface, SearchUrlInterface
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
        $crawler = $this->client->request('GET', $this->getSearchUrl().$keyword);

        $parsedData = $this->parser->parse($crawler);

        return $parsedData;
    }

    /**
     * @return string
     */
    public function getSearchUrl()
    {
        return 'http://www.kilobaitas.lt/Ieskoti/CatalogStore.aspx?criteria=';
    }
}
