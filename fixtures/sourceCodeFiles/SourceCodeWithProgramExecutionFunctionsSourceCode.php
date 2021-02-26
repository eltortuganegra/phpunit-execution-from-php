<?php

namespace PhpunitExecutionFromPhpTemporary;


class SourceCodeWithProgramExecutionFunctionsSourceCode
{
    public function functionToTest()
    {
        $programaExecutionFunctions = [
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

        return true;
    }

}