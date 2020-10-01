<?php

namespace PhpunitExecutionFromPhp;


use PhpunitExecutionFromPhp\exceptions\ShellOutputHasNotValidFormat;

class TestResult
{
    private $testExecutionStatusUuid;

    /**
     * TestResult constructor.
     * @param string $shellOutput
     * @throws ShellOutputHasNotValidFormat
     */
    public function __construct(string $shellOutput)
    {
        $testResultLine = $this->getTestResultLine($shellOutput);
        if ($testResultLine == 'OK (1 test, 1 assertion)') {
            $this->testExecutionStatusUuid = TestExecutionStatus::UUID_OK;
        } elseif ($testResultLine == 'Tests: 1, Assertions: 1, Failures: 1.') {
            $this->testExecutionStatusUuid = TestExecutionStatus::UUID_FAIL;
        } elseif ($testResultLine == 'Tests: 1, Assertions: 0, Errors: 1.') {
            $this->testExecutionStatusUuid = TestExecutionStatus::UUID_ERROR;
        } else {
            throw new ShellOutputHasNotValidFormat('Test result line has not a valid format. ' . $testResultLine);
        }
    }

    /**
     * @param $shellOutput
     * @return mixed|string
     */
    protected function getTestResultLine($shellOutput)
    {
        $shellOutputLines = explode("\n", $shellOutput);
        $totalLines = count($shellOutputLines);
        $testResultLineNumber = $totalLines - 2;
        $testResultLine = $shellOutputLines[$testResultLineNumber];

        return $testResultLine;
    }

    /**
     * @return string
     */
    public function getTestExecutionStatusUuid(): string
    {
        return $this->testExecutionStatusUuid;
    }

}