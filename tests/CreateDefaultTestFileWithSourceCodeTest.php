<?php


namespace phpunitExecutionFromPhp;


use PhpExecutionFromPhp\TestExecutor;
use PhpExecutionFromPhp\TestFile;
use PHPUnit\Framework\TestCase;

class CreateDefaultTestFileWithSourceCodeTest extends TestCase
{
    public function testExecutionTestIsOk()
    {
        $temporaryFilesPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'temporary_files' . DIRECTORY_SEPARATOR ;
        $defaultTestNameFile = 'DefaultTest';
        $phpFileExtension = '.php';
        $sourceCode = 'class TestDefaultTest {}';

        // Check if save method return true
        $testFile = new TestFile($temporaryFilesPath);
        $isFileCreate = $testFile->save($defaultTestNameFile, $sourceCode);

        $this->assertTrue($isFileCreate, 'Save method should return true.');

        // Check if default test file exists
        $testFilePath = $temporaryFilesPath . $defaultTestNameFile . $phpFileExtension;
        $hasTestFileBeenCreate = is_file($testFilePath);

        $this->assertTrue($hasTestFileBeenCreate, 'File has not been created.');

        // Reset the default test file
        unlink($testFilePath);
    }

}