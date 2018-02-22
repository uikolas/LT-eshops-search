<?php

namespace App\Search;

use App\Client\ClientInterface;
use App\Parser\Parser;
use Psr\Http\Message\ResponseInterface;

class SearchHandler
{
    /**
     * @var Parser[]
     */
    private $parsers = [];

    /**
     * @var SearchHandlerValidator
     */
    private $validator;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param iterable $parsers
     * @param SearchHandlerValidator $validator
     * @param ClientInterface $client
     */
    public function __construct(iterable $parsers, SearchHandlerValidator $validator, ClientInterface $client)
    {
        $this->parsers   = $parsers;
        $this->validator = $validator;
        $this->client    = $client;
    }

    /**
     * @param string $keyword
     * @return array
     */
    public function search($keyword)
    {
        $this->validator->validate($keyword);

        $products = [];

        foreach ($this->parsers as $parser) {
            $this->client->get(
                $parser->getUrl($keyword),
                function (ResponseInterface $response) use ($parser, &$products) {
                    $parsed = $parser->parse((string) $response->getBody());

                    $products = array_merge($products, $parsed);
                }
            );
        }

        $this->client->run();

        return $products;
    }
}
