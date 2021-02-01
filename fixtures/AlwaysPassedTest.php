<?php

namespace PhpunitExecutionFromPhpTemporary;

use PHPUnit\Framework\TestCase;

class AlwaysPassedTest extends TestCase
{
    public function testAlwaysPassed()
    {
        $this->assertTrue(true);
    }
}