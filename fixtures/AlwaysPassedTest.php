<?php

namespace PhpunitExecutionFromPhpFixtures;

use PHPUnit\Framework\TestCase;

class AlwaysPassedTest extends TestCase
{
    public function testAlwaysPassed()
    {
        $this->assertTrue(true);
    }
}