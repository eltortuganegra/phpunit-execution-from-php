<?php

namespace PhpunitExecutionFromPhp;


use PhpunitExecutionFromPhp\exceptions\PossibleCodeInjectionDetected;

class CodeInjectionValidator
{
    protected $programExecutionFunctions;
    private $sourceCode;

    public function __construct()
    {
        $this->programExecutionFunctions = [
            'escapeshellarg',
            'escapeshellcmd',
            'exec',
            'passthru',
            'proc_close',
            'proc_get_status',
            'proc_nice',
            'proc_open',
            'proc_terminate',
            'shell_exec',
            'system'
        ];
    }

    /**
     * @param string $sourceCode
     * @throws PossibleCodeInjectionDetected
     */
    public function validate(string $sourceCode): void
    {
        $this->setSourceCode($sourceCode);

        foreach ($this->programExecutionFunctions as $programExecutionFunction) {
            $this->checkIfTheProgramExecutionFunctionIsFound($programExecutionFunction);
        }
    }

    private function setSourceCode(string $sourceCode)
    {
        $this->sourceCode = $sourceCode;
    }

    /**
     * @param string $sourceCode
     * @param string $programExecutionFunction
     * @throws PossibleCodeInjectionDetected
     */
    public function checkIfTheProgramExecutionFunctionIsFound(string $programExecutionFunction): void
    {
        if ($this->isProgramExecutionFunctionFound($programExecutionFunction)) {
            throw new PossibleCodeInjectionDetected();
        }
    }

    /**
     * @param string $sourceCode
     * @param string $programExecutionFunction
     * @return bool
     */
    public function isProgramExecutionFunctionFound(string $programExecutionFunction): bool
    {
        return strpos($this->sourceCode, $programExecutionFunction) !== false;
    }

}