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
     * @param string $kataTestPath
     * @param string $sourceCode
     * @throws TestFileNotFound
     */
    public function execute(string $kataTestPath, string $sourceCode): TestResult
    {
        if ( ! is_file($kataTestPath)) {
            throw new TestFileNotFound();
        }

        if (empty($sourceCode)) {
            throw new SourceCodeIsEmpty();
        }


        // Copy test kata to the temporary folder
        $kataTestBasename = pathinfo($kataTestPath, PATHINFO_BASENAME);
        //copy($kataTestPath, $this->temporaryfilesPath . $kataTestBasename);

        // build kata source code filename from kata
        $kataTestFilename = pathinfo($kataTestPath, PATHINFO_FILENAME);
        $kataSourceCodeFilename = str_replace('Test', 'SourceCode', $kataTestFilename);

        // Create kata source code file
        $kataSourceCodeFile = new KataSourceCodeFile();
        $kataSourceCodeFile->save($this->temporaryfilesPath, $kataSourceCodeFilename, $sourceCode);

        // Execute test
        $phpunitShellPath = 'C:\Users\jorge.sanchez\Projects\phpunit-execution-from-php\vendor\bin\phpunit';
        $phpunitBootstrapShellPath = 'C:\Users\jorge.sanchez\Projects\phpunit-execution-from-php\vendor\autoload.php';
        $kataTestPath = 'C:\Users\jorge.sanchez\Projects\phpunit-execution-from-php\fixtures\ShouldReturnTrueKataTest.php';

        $shellOutput = shell_exec($phpunitShellPath . ' --bootstrap ' . $phpunitBootstrapShellPath . ' ' . $kataTestPath);
        $testResult = new TestResult($shellOutput);

        return $testResult;
    }

}