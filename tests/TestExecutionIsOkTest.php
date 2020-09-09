<?php


namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\TestExecutor;
use PHPUnit\Framework\TestCase;

class TestExecutionIsOkTest extends CustomizedTestCase
{
    public function testExecutionTestIsOk()
    {
        $testFilePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixtures' .  DIRECTORY_SEPARATOR . 'AlwaysPassedTest.php';
        $sourceCode = 'class TestDefaultTest {}';

        $testExecutor = new TestExecutor($this->temporaryFilesPath);

        $hasTestPassed = $testExecutor->execute($testFilePath, $sourceCode);

        $this->assertTrue($hasTestPassed);
    }

}