<?php

namespace AppBundle\Tests\Functional\Controller;

use AppBundle\Tests\KernelAwareTest;
use Symfony\Bundle\FrameworkBundle\Client;

class DefaultControllerTest extends KernelAwareTest
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = $this->container->get('test.client');
    }

    public function testIndex()
    {
        $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testSearchPage()
    {
        $this->client->request('GET', '/search?keyword=samsung sync master');

        $response = $this->client->getResponse();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }
}
