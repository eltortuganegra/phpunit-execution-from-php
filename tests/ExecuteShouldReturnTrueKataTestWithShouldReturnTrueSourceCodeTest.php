<?php

namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\KataSourceCodeFile;
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
        $testExecutor = new TestExecutor($this->temporaryFilesPath);
        $testResult = $testExecutor->execute($shouldReturnTrueKataTestPath, $sourceCode);

        $isTestPassed = $testResult->getIsResultOk();

        $this->assertTrue($isTestPassed);
    }

}