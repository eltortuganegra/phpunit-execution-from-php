<?php


namespace PhpunitExecutionFromPhp;


class KataSourceCodeFile
{
    const PHP_EXTENSION = '.php';
    const PHP_OPENING_TAG = '<?php';

    public function save(string $temporaryFilesPath, string $testFileName, string $sourceCode): bool
    {
        $testFileNamePath = $temporaryFilesPath . $testFileName . self::PHP_EXTENSION;

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