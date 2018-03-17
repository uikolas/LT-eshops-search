<?php


namespace App\SearchHandler;

use App\Client\ClientInterface;
use App\Parser\OneAParser;

class OneASearchHandler extends AbstractSearchHandler
{
    const URL = 'https://www.1a.lt';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var OneAParser
     */
    private $parser;

    public function __construct(ClientInterface $client, OneAParser $parser)
    {
        $this->client = $client;
        $this->parser = $parser;

        parent::__construct($client, $parser);
    }
    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl(string $keyword)
    {
        return self::URL . '/search/' . $keyword . '/opened/1';
    }
}
