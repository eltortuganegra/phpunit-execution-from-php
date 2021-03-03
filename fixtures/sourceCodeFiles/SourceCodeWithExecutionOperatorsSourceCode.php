<?php

namespace PhpunitExecutionFromPhpTemporary;


class SourceCodeWithExecutionOperatorsSourceCode
{
    public function functionToTest()
    {
        $output = `ls -al`;

        return true;
    }

}