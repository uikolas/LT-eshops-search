<?php

namespace App\SearchHandler;

use App\Client\ClientInterface;
use App\Parser\ParserInterface;
use App\Parser\SkytechParser;
use App\Search\SearchResult;
use Psr\Http\Message\ResponseInterface;

class SkytechSearchHandler extends AbstractSearchHandler
{
    const URL = 'http://www.skytech.lt/';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var SkytechParser
     */
    private $parser;

    public function __construct(ClientInterface $client, SkytechParser $parser)
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
        return self::URL . 'search.php?sand=0&pav=2&sort=5a&grp=0&page=1&pagesize=100&page=1&pagesize=100&keywords=' . $keyword . '&x=0&y=0&search_in_description=0&';
    }
}
