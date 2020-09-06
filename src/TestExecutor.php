<?php


namespace PhpExecutionFromPhp;


use PhpExecutionFromPhp\exceptions\TestFileNotFound;

class TestExecutor
{
    /**
     * @param string $testFile
     * @param string $sourceCode
     * @throws TestFileNotFound
     */
    public function execute(string $testFile, string $sourceCode)
    {
        if ( ! is_file($testFile)) {
            throw new TestFileNotFound();
        }
    }

}