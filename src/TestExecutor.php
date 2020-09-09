<?php


namespace PhpunitExecutionFromPhp;


use PhpunitExecutionFromPhp\exceptions\SourceCodeIsEmpty;
use PhpunitExecutionFromPhp\exceptions\TestFileNotFound;

class TestExecutor
{
    /**
     * @var string
     */
    private $temporaryfilesPath;

    public function __construct(string $temporaryfilesPath)
    {
        $this->temporaryfilesPath = $temporaryfilesPath;
    }

    /**
     * @param string $testFilePath
     * @param string $sourceCode
     * @throws TestFileNotFound
     */
    public function execute(string $testFilePath, string $sourceCode): void
    {
        if ( ! is_file($testFilePath)) {
            throw new TestFileNotFound();
        }

        if (empty($sourceCode)) {
            throw new SourceCodeIsEmpty();
        }

        // Create a random name for the class
        $testFileBasename = pathinfo($testFilePath, PATHINFO_FILENAME);
        $sourceFileName = str_replace('Test', 'SourceCode', $testFileBasename);

        // Create kata source code file
        $testFilePath = new KataSourceCodeFile();
        $testFilePath->save($this->temporaryfilesPath, $sourceFileName, $sourceCode);
    }

}