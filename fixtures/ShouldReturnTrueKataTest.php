<?php
namespace PhpunitExecutionFromPhpFixtures;

use PHPUnit\Framework\TestCase;
use PhpunitExecutionFromPhpTemporary\ShouldReturnTrueKataSourceCode;


class ShouldReturnTrueKataTest extends TestCase
{
    public function testShouldReturnTrue()
    {
        // Create source code file
        $sourceCode = new ShouldReturnTrueKataSourceCode();
        $isTrue = $sourceCode->shouldReturnTrue();

        $this->assertTrue($isTrue);
    }
}