<?php


namespace phpunitExecutionFromPhp;


use PhpExecutionFromPhp\TestExecutor;
use PHPUnit\Framework\TestCase;

class TestExecutionIsOkTest extends TestCase
{
    public function testExecutionTestIsOk()
    {
        $testFilePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixtures' .  DIRECTORY_SEPARATOR . 'AlwaysPassedTest.php';
        $sourceCode = 'class TestDefaultTest {}';

        $testExecutor = new TestExecutor();

        $hasTestPassed = $testExecutor->execute($testFilePath, $sourceCode);

        $this->assertTrue($hasTestPassed);
    }

}