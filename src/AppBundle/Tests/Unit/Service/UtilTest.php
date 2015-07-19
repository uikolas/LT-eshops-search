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
}
