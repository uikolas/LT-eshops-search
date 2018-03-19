<?php

namespace App\SearchHandler;

use App\Client\ClientInterface;
use App\Parser\KilobyteParser;

class KilobyteSearchHandler extends AbstractSearchHandler
{
    const URL = 'https://www.kilobaitas.lt';

    /**
     * KilobyteSearchHandler constructor.
     * @param ClientInterface $client
     * @param KilobyteParser $parser
     */
    public function __construct(ClientInterface $client, KilobyteParser $parser)
    {
        parent::__construct($client, $parser);
    }

    /**
     * @param string $keyword
     * @return string
     */
    public function getUrl(string $keyword)
    {
        return self::URL . '/Ieskoti/CatalogStore.aspx?criteria=' . $keyword;
    }
}
