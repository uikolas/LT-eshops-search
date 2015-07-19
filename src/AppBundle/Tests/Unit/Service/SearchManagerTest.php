<?php

namespace AppBundle\Tests\Unit\Service;

use AppBundle\Service\SearchManager;
use AppBundle\Tests\KernelAwareTest;

class SearchManagerTest extends KernelAwareTest
{
    /**
     * @var SearchManager
     */
    private $searchManager;

    public function setUp()
    {
        parent::setUp();

        $this->searchManager = $this->container->get('app.service.search_manager');
    }

    public function testEmptySearchManager()
    {
        $keyword = 'keyword';

        $search = $this->searchManager->search($keyword);

        $this->assertTrue(count($search) === 0);
    }

    public function testSearchManager()
    {
        $keyword = 'samsung sync master';

        $this->searchManager->setSearchEngine($this->container->get('app.service.search_engine.skytech.search'));

        $search = $this->searchManager->search($keyword);

        $this->assertTrue(count($search) > 0);
    }
}
