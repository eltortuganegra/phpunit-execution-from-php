<?php


namespace PhpExecutionFromPhp;


use PhpExecutionFromPhp\exceptions\SourceCodeIsEmpty;
use PhpExecutionFromPhp\exceptions\TestFileNotFound;

class TestExecutor
{
    /**
     * @param string $testFile
     * @param string $sourceCode
     * @throws TestFileNotFound
     */
    public function execute(string $testFile, string $sourceCode): bool
    {
        if ( ! is_file($testFile)) {
            throw new TestFileNotFound();
        }

        if (empty($sourceCode)) {
            throw new SourceCodeIsEmpty();
        }

        return true;
    }

}