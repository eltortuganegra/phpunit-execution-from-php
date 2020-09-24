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
        $sourceCode = 'public function shouldReturnTrue(): bool { return false; }';
        $shouldReturnTrueKataTestPath = $this->fixtureFilesPath . $shouldReturnTrueKataTestFileName . $phpFileExtension;


        // Create TestExecutor
        $testExecutor = new TestExecutor($this->temporaryFilesPath);
        $testExecutor->execute($shouldReturnTrueKataTestPath, $sourceCode);

        $isTestPassed = true;

        $this->assertTrue($isTestPassed);

        // Reset the default test file
//        unlink($kataSourceCodePath);
    }

}