<?php


namespace PhpExecutionFromPhp;


class TestFile
{
    /**
     * @var string
     */
    private $temporaryFilesPath;

    public function __construct(string $temporaryFilesPath)
    {
        $this->temporaryFilesPath = $temporaryFilesPath;
    }

    public function save($testFileName, $sourceCode): bool
    {
        $testFileNamePath = $this->temporaryFilesPath . $testFileName;

        $result = file_put_contents($testFileNamePath, $sourceCode);

        return ($result !== false);
    }

}