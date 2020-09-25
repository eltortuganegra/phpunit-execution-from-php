<?php


namespace PhpunitExecutionFromPhp;


use Exception;

class TestResult
{
    private $isResultOk = false;
    private $isResultFailed = false;
    private $isResultWithError = false;

    public function __construct(string $shellOutput)
    {
        $testResultLine = $this->getTestResultLine($shellOutput);
        if ($testResultLine == 'OK (1 test, 1 assertion)') {
            $this->isResultOk = true;
        } elseif ($testResultLine == 'Tests: 1, Assertions: 1, Failures: 1.') {
            $this->isResultFailed = true;
        } elseif ($testResultLine == 'Tests: 1, Assertions: 0, Errors: 1.') {
            $this->isResultWithError = true;
        } else {
            throw new Exception('Test result line has not a valid format. ' . $testResultLine);
        }
    }

    /**
     * @return bool
     */
    public function getIsResultWithError(): bool
    {
        return $this->isResultWithError;
    }

    /**
     * @return bool
     */
    public function getIsResultOk(): bool
    {
        return $this->isResultOk;
    }

    /**
     * @return bool
     */
    public function getIsResultFailed(): bool
    {
        return $this->isResultFailed;
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

}