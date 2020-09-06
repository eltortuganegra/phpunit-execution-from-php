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
        $defaultTestNameFile = 'DefaultTest.php';
        $sourceCode = 'class TestDefaultTest {}';

        $testFile = new TestFile($temporaryFilesPath);
        $isFileCreate = $testFile->save($defaultTestNameFile, $sourceCode);

        $this->assertTrue($isFileCreate);

        $testFilePath = $temporaryFilesPath . $defaultTestNameFile;
        unlink($testFilePath);
    }

}