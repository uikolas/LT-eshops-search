<?php

namespace AppBundle\Tests\Unit\Service\SearchEngine\KilobaitasSearch;

use AppBundle\Service\SearchEngine\KilobaitasSearch\KilobaitasSearch;
use AppBundle\Tests\KernelAwareTest;

class KilobaitasSearchTest extends KernelAwareTest
{
    /**
     * @var KilobaitasSearch
     */
    private $searchEngine;

    public function setUp()
    {
        parent::setUp();

        $this->searchEngine = $this->container->get('app.service.search_engine.kilobaitas.search');
    }

    public function testSearchWithResults()
    {
        $keyword = 'samsung sync master';

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
