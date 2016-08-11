<?php

namespace AppBundle\Service;

use Symfony\Component\DomCrawler\Crawler;

interface ParserInterface
{
    /**
     * @param Crawler $crawler
     * @return array
     */
    public function parseDomCrawler(Crawler $crawler);
}
