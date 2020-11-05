<?php

namespace PhpunitExecutionFromPhpTest;

use PhpunitExecutionFromPhp\exceptions\SourceCodeIsEmpty;

use PhpunitExecutionFromPhp\TestExecutor;

use PHPUnit\Framework\TestCase;

class ThrowExceptionWhenSourceCodeIsEmptyTest extends CustomizedTestCase
{
    public function testThrowExceptionWhenSourceCodeIsEmptyTest()
    {
        $testFilePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixtures' .  DIRECTORY_SEPARATOR . 'AlwaysPassedTest.php';
        $sourceCode = '';

        $testExecutor = new TestExecutor($this->temporaryFilesPath);

        $this->expectException(SourceCodeIsEmpty::class);
        $testExecutor->execute($testFilePath, $sourceCode);
    }
}
