<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    protected function loadTestData($file)
    {
        return $content = file_get_contents(__DIR__ . '/../TestData/'.$file);
    }
}
