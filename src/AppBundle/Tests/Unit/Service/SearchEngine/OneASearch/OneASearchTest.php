<?php

namespace AppBundle\Tests\Unit\Service\SearchEngine\OneASearch;

use AppBundle\Service\SearchEngine\OneASearch\OneASearch;
use AppBundle\Tests\KernelAwareTest;

class OneASearchTest extends KernelAwareTest
{
    /**
     * @var OneASearch
     */
    private $searchEngine;

    public function setUp()
    {
        parent::setUp();

        $this->searchEngine = $this->container->get('app.service.search_engine.one_a.search');
    }

    public function testSearchWithResults()
    {
        $keyword = 'GTX 970';

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
