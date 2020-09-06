<?php

namespace phpunitExecutionFromPhp;

use PhpExecutionFromPhp\exceptions\TestFileNotFound;
use PhpExecutionFromPhp\TestExecutor;

use PHPUnit\Framework\TestCase;

class ThrowExceptionWhenTestFileIsNotFoundTest extends TestCase
{
    public function testThrowExceptionWhenTestIsNotFound()
    {
        $testFilePath = '';
        $sourceCode = '';

        $testExecutor = new TestExecutor();

        $this->expectException(TestFileNotFound::class);
        $testExecutor->execute($testFilePath, $sourceCode);
    }
}
