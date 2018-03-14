<?php


namespace App\SearchHandler;

use App\Client\ClientInterface;
use App\Parser\OneAParser;
use App\Search\SearchResult;
use Psr\Http\Message\ResponseInterface;

class OneASearchHandler implements SearchHandlerInterface
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

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl(string $keyword)
    {
        return self::URL . '/search/' . $keyword . '/opened/1';
    }
}
