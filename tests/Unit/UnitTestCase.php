<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    protected function loadData($file)
    {
        return $content = file_get_contents(__DIR__ . '/../Data/'.$file);
    }
}
