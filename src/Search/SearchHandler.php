<?php

namespace App\Search;

use App\Client\Client;
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
     * @var Client
     */
    private $client;

    /**
     * @param iterable $parsers
     * @param SearchHandlerValidator $validator
     * @param Client $client
     */
    public function __construct(iterable $parsers, SearchHandlerValidator $validator, Client $client)
    {
        $this->parsers = $parsers;
        $this->validator = $validator;
        $this->client = $client;
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
            $this->client->get($parser->getUrl($keyword))->then(
                function (ResponseInterface $response) use ($parser, &$products) {
                    $parsed = $parser->parse((string) $response->getBody());

                    $products = array_merge($products, $parsed);
                },
                function (\Exception $error) {
                    //var_dump('There was an error', $error->getMessage());
                }
            );
        }

        $this->client->run();

        return $products;
    }
}
