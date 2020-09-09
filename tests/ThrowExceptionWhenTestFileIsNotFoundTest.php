<?php

namespace PhpunitExecutionFromPhpTest;

use PhpunitExecutionFromPhp\exceptions\TestFileNotFound;
use PhpunitExecutionFromPhp\TestExecutor;

use PHPUnit\Framework\TestCase;

class ThrowExceptionWhenTestFileIsNotFoundTest extends CustomizedTestCase
{
    public function testThrowExceptionWhenTestIsNotFound()
    {
        $testFilePath = '';
        $sourceCode = '';

        $testExecutor = new TestExecutor($this->temporaryFilesPath);

        $this->expectException(TestFileNotFound::class);
        $testExecutor->execute($testFilePath, $sourceCode);
    }
}
