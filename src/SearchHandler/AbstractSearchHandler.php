<?php

namespace App\SearchHandler;

use App\Client\ClientInterface;
use App\Parser\ParserInterface;
use App\Search\SearchResult;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractSearchHandler implements SearchHandlerInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var ParserInterface
     */
    private $parser;

    public function __construct(ClientInterface $client, ParserInterface $parser)
    {
        $this->client = $client;
        $this->parser = $parser;
    }

    /**
     * @param string $keyword
     * @param SearchResult $searchResult
     * @return void
     */
    public function search(string $keyword, SearchResult $searchResult)
    {
        $this->client->get(
            $this->getUrl($keyword),
            function (ResponseInterface $response) use ($searchResult) {
                $parsed = $this->parser->parse((string) $response->getBody());

                $searchResult->appendProducts($parsed);
            }
        );
    }
}
