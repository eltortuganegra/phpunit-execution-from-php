<?php

namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\KataSourceCodeFile;
use PhpunitExecutionFromPhp\TestExecutionStatus;
use PhpunitExecutionFromPhp\TestExecutor;


class ExecuteShouldReturnTrueKataTestWithShouldReturnTrueSourceCodeTest extends CustomizedTestCase
{
    public function testExecuteShouldReturnTrueKataTestWithShouldReturnTrueSourceCodeTest()
    {
        $shouldReturnTrueKataTestFileName = 'ShouldReturnTrueKataTest';
        $phpFileExtension = '.php';
        $sourceCode = 'public function shouldReturnTrue(): bool { return true; }';
        $shouldReturnTrueKataTestPath = $this->fixtureFilesPath . $shouldReturnTrueKataTestFileName . $phpFileExtension;

        // Create TestExecutor
        $testExecutor = new TestExecutor($this->temporaryFilesPath, $this->phpunitShellPath, $this->phpunitBootstrapShellPath);
        $testResult = $testExecutor->execute($shouldReturnTrueKataTestPath, $sourceCode);

        $testExecutionStatus = $testResult->getTestExecutionStatusUuid();

        $this->assertEquals(TestExecutionStatus::UUID_OK, $testExecutionStatus);
    }

}