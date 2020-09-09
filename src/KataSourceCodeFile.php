<?php


namespace PhpunitExecutionFromPhp;


class KataSourceCodeFile
{
    const PHP_EXTENSION = '.php';
    const PHP_OPENING_TAG = '<?php';

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
        $testFileNamePath = $this->temporaryFilesPath . $testFileName . self::PHP_EXTENSION;

        $testFileContent = self::PHP_OPENING_TAG
            . "\n"
            . "\n"
            . 'class ' . $testFileName
            . "\n" . '{'
            . "\n"
            . "    " . $sourceCode
            . "\n"
            . "}";

        $result = file_put_contents($testFileNamePath, $testFileContent);

        return ($result !== false);
    }

}