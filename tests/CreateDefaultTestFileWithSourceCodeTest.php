<?php

namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\TestFile;


class CreateDefaultTestFileWithSourceCodeTest extends CustomizedTestCase
{
    public function testExecutionTestIsOk()
    {
//        $temporaryFilesPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'temporary_files' . DIRECTORY_SEPARATOR ;
        $defaultTestNameFile = 'DefaultTest';
        $phpFileExtension = '.php';
        $sourceCode = 'class TestDefaultTest {}';

        // Check if save method return true
        $testFile = new TestFile($this->temporaryFilesPath);
        $isFileCreate = $testFile->save($defaultTestNameFile, $sourceCode);

        $this->assertTrue($isFileCreate, 'Save method should return true.');

        // Check if default test file exists
        $testFilePath = $this->temporaryFilesPath . $defaultTestNameFile . $phpFileExtension;
        $hasTestFileBeenCreate = is_file($testFilePath);

        $this->assertTrue($hasTestFileBeenCreate, 'File has not been created.');

        // Reset the default test file
        unlink($testFilePath);
    }

}