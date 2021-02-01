<?php


namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\TestExecutor;

class TestExecutionIsOkTest extends CustomizedTestCase
{
    public function testExecutionTestIsOk()
    {
        $testFilePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixtures' .  DIRECTORY_SEPARATOR . 'AlwaysPassedTest.php';
        $testFileCopiedPath = $this->temporaryFilesPath . 'AlwaysPassedTest.php';
        copy($testFilePath, $testFileCopiedPath);

        $sourceCode = 'public function testAlwaysPassed {}';

        $testExecutor = new TestExecutor($this->temporaryFilesPath, $this->phpunitShellPath, $this->phpunitBootstrapShellPath);

        $testExecutor->execute($testFilePath, $sourceCode);

        $exceptionHasNotBeThrown = true;

        $this->assertTrue($exceptionHasNotBeThrown);
        unlink($testFileCopiedPath);
    }

}