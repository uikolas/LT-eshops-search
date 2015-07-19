<?php

namespace AppBundle\Service;

use Symfony\Component\DomCrawler\Crawler;

interface ParserInterface
{
    /**
     * @param Crawler $crawler
     * @return mixed
     */
    public function parse(Crawler $crawler);
}
