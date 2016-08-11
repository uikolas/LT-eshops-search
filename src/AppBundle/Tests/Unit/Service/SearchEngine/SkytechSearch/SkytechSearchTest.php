<?php

namespace AppBundle\Tests\Unit\Service\SearchEngine\SkytechSearch;

use AppBundle\Service\SearchEngine\SkytechSearch\SkytechSearch;
use AppBundle\Tests\KernelAwareTest;

class SkytechSearchTest extends KernelAwareTest
{
    /**
     * @var SkytechSearch
     */
    private $searchEngine;

    public function setUp()
    {
        parent::setUp();

        $this->searchEngine = $this->container->get('app.service.search_engine.skytech.search');
    }

    public function testSearchWithResults()
    {
        $keyword = 'samsung s5';

        $search = $this->searchEngine->search($keyword);

        $this->assertTrue(count($search) > 0);
    }

    public function testSearchWithNoResults()
    {
        $keyword = 'asdadadasd';

        $search = $this->searchEngine->search($keyword);

        $this->assertTrue(count($search) === 0);
    }
}
