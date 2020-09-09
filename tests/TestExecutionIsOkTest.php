<?php


namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\TestExecutor;

class TestExecutionIsOkTest extends CustomizedTestCase
{
    public function testExecutionTestIsOk()
    {
        $testFilePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixtures' .  DIRECTORY_SEPARATOR . 'AlwaysPassedTest.php';
        $sourceCode = 'class TestDefaultTest {}';

        $testExecutor = new TestExecutor($this->temporaryFilesPath);

        $testExecutor->execute($testFilePath, $sourceCode);

        $exceptionHasNotBeTrown = true;

        $this->assertTrue($exceptionHasNotBeTrown);
    }

}