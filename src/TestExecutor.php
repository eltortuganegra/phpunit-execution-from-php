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
    public function execute(string $testFilePath, string $sourceCode): bool
    {
        if ( ! is_file($testFilePath)) {
            throw new TestFileNotFound();
        }

        if (empty($sourceCode)) {
            throw new SourceCodeIsEmpty();
        }

        // Create a random name for the class
        $testFileBasename = pathinfo($testFilePath, PATHINFO_BASENAME);
        $sourceFileName = str_replace('Test', 'SourceCode', $testFileBasename);

        $testFilePath = new TestFile($this->temporaryfilesPath);
        $testFilePath->save($sourceFileName, $sourceCode);

        return true;
    }

}