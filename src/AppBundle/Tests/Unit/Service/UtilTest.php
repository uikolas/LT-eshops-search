<?php

namespace AppBundle\Tests\Unit\Service;

use AppBundle\Service\Util;
use AppBundle\Tests\KernelAwareTest;

class UtilTest extends KernelAwareTest
{
    public function testHasNotHttp()
    {
        $string = '/image.jpg';

        $this->assertFalse(Util::hasHttp($string));
    }

    public function testHasHttp()
    {
        $string = 'http://google.lt';

        $this->assertTrue(Util::hasHttp($string));
    }

    public function testAddLink()
    {
        $url  = 'http://google.lt/';
        $link = '/some-link.html';

        $this->assertEquals('http://google.lt/some-link.html', Util::addLink($url, $link));
    }
}
