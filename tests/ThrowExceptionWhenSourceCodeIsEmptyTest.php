<?php

namespace phpunitExecutionFromPhp;

use PhpExecutionFromPhp\exceptions\SourceCodeIsEmpty;

use PhpExecutionFromPhp\TestExecutor;

use PHPUnit\Framework\TestCase;

class ThrowExceptionWhenSourceCodeIsEmptyTest extends TestCase
{
    public function testThrowExceptionWhenSourceCodeIsEmptyTest()
    {
        $testFilePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixtures' .  DIRECTORY_SEPARATOR . 'AlwaysPassedTest.php';
        $sourceCode = '';

        $testExecutor = new TestExecutor();

        $this->expectException(SourceCodeIsEmpty::class);
        $testExecutor->execute($testFilePath, $sourceCode);
    }
}
