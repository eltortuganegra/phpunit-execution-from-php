<?php


namespace PhpunitExecutionFromPhp;


use Exception;
use PhpunitExecutionFromPhp\exceptions\KataSourceCodeFileHasNotCouldBeCreated;

class KataSourceCodeFile
{
    const PHP_EXTENSION = '.php';
    const PHP_OPENING_TAG = '<?php';

    protected $path;
    private $content;

    /**
     * @param string $temporaryFilesPath
     * @param string $className
     * @param string $sourceCode
     * @throws KataSourceCodeFileHasNotCouldBeCreated
     */
    public function save(string $temporaryFilesPath, string $className, string $sourceCode): void
    {
        $this->setPath($temporaryFilesPath, $className);
        $this->setContent($className, $sourceCode);
        $this->createFileInTemporaryFilesPath();
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
     * @throws KataSourceCodeFileHasNotCouldBeCreated
     */
    private function createFileInTemporaryFilesPath()
    {
        $result = file_put_contents($this->path, $this->content);
        if ($result === false) {
            throw new KataSourceCodeFileHasNotCouldBeCreated();
        }
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