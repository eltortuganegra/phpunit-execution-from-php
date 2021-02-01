<?php


namespace PhpunitExecutionFromPhp;


use Exception;

class KataSourceCodeFile
{
    const PHP_EXTENSION = '.php';
    const PHP_OPENING_TAG = '<?php';

    protected $path;
    private $content;

    public function save(string $temporaryFilesPath, string $className, string $sourceCode): bool
    {
        $this->setPath($temporaryFilesPath, $className);
        $this->setContent($className, $sourceCode);
        $result = $this->createFileInTemporaryFilesPath();

        return ($result !== false);
    }

    /**
     * @param string $temporaryFilesPath
     * @param string $className
     */
    private function setPath(string $temporaryFilesPath, string $className)
    {
        $this->path = $temporaryFilesPath . $className . self::PHP_EXTENSION;
    }

    /**
     * @param string $className
     * @param string $sourceCode
     * @return string
     */
    private function setContent(string $className, string $sourceCode): void
    {
        $this->content = self::PHP_OPENING_TAG
            . "\n"
            . "namespace PhpunitExecutionFromPhpTemporary;"
            . "\n"
            . "\n"
            . 'class ' . $className
            . "\n" . '{'
            . "\n"
            . "    " . $sourceCode
            . "\n"
            . "}";
    }

    /**
     * @return false|int
     */
    private function createFileInTemporaryFilesPath()
    {
        $result = file_put_contents($this->path, $this->content);

        return $result;
    }

    /**
     * @throws Exception
     */
    public function remove()
    {
        $isDeleted = unlink($this->path);

        if ( ! $isDeleted) {
            throw new Exception('Kata source code file has not could be deleted.');
        }
    }

}