<?php


namespace PhpunitExecutionFromPhp;


use PhpunitExecutionFromPhp\exceptions\SourceCodeIsEmpty;
use PhpunitExecutionFromPhp\exceptions\TestFileNotFound;

class TestExecutor
{
    private $temporaryFilesPath;
    private $phpunitShellPath;
    private $phpunitBootstrapShellPath;
    private $executeTestShellCommand;
    private $shellOutput;

    public function __construct(
        string $temporaryFilesPath,
        string $phpunitShellPath,
        string $phpunitBootstrapShellPath
    ) {
        $this->temporaryFilesPath = $temporaryFilesPath;
        $this->phpunitShellPath = $phpunitShellPath;
        $this->phpunitBootstrapShellPath = $phpunitBootstrapShellPath;
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

        // Build kata source code filename from kata
        $kataSourceCodeFilename = $this->createKataSourceCodeFilename($kataTestPath);

        // Create kata source code file
        $kataSourceCodeFile = new KataSourceCodeFile();
        $kataSourceCodeFile->save($this->temporaryFilesPath, $kataSourceCodeFilename, $sourceCode);

        // Execute test
        $this->createExecuteTestShellCommand($kataTestPath);
        $this->executeShellCommand();

        // Remove file
        $kataSourceCodeFile->remove();

        // Create test result
        $testResult = $this->createTestResult();

        return $testResult;
    }

    /**
     * @param string $kataTestPath
     * @return string
     */
    protected function createExecuteTestShellCommand(string $kataTestPath): void
    {
        $this->executeTestShellCommand =  $this->phpunitShellPath . ' --bootstrap ' . $this->phpunitBootstrapShellPath . ' ' . $kataTestPath;
    }

    protected function executeShellCommand()
    {
        $this->shellOutput = shell_exec($this->executeTestShellCommand);
    }

    /**
     * @return TestResult
     * @throws exceptions\ShellOutputHasNotValidFormat
     */
    protected function createTestResult(): TestResult
    {
        $testResult = new TestResult($this->shellOutput);
        return $testResult;
    }

    /**
     * @param string $kataTestPath
     * @return string|string[]
     */
    protected function createKataSourceCodeFilename(string $kataTestPath)
    {
        $kataTestFilename = pathinfo($kataTestPath, PATHINFO_FILENAME);
        $kataSourceCodeFilename = str_replace('Test', 'SourceCode', $kataTestFilename);
        return $kataSourceCodeFilename;
    }

}