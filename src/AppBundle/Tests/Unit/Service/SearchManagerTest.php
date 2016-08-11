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

    public function testSearchManager()
    {
        $keyword = 'Samsung galaxy S4';

        $search = $this->searchManager->search($keyword);

        foreach ($search as $value) {
            $this->assertTrue(count($value) > 0);
        }
    }

    public function testEmptySearchManager()
    {
        $keyword = 'keyword';

        $search = $this->searchManager->search($keyword);

        foreach ($search as $value) {
            $this->assertEmpty($value);
        }
    }
}
