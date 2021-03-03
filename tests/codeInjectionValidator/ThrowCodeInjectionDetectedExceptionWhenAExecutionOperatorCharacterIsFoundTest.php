<?php

namespace PhpunitExecutionFromPhpTest\codeInjectionValidator;

use CodeInjectorValidator;
use PhpunitExecutionFromPhp\exceptions\PossibleCodeInjectionDetected;
use PhpunitExecutionFromPhp\TestExecutor;
use PhpunitExecutionFromPhpTest\CustomizedTestCase;

class ThrowCodeInjectionDetectedExceptionWhenAExecutionOperatorCharacterIsFoundTest extends CustomizedTestCase
{
    public function testThrowExceptionWhenTestIsNotFound()
    {
        $testFilePath = $this->getPathToAlwaysPassedTest();
        $sourceCode = $this->getSourceCode();

        $testExecutor = new TestExecutor($this->temporaryFilesPath, $this->phpunitShellPath, $this->phpunitBootstrapShellPath);

        $this->expectException(PossibleCodeInjectionDetected::class);
        $testExecutor->execute($testFilePath, $sourceCode);
    }

    /**
     * @return false|string
     */
    public function getSourceCode()
    {
        $sourceCodeFile = $this->getFixtureFilesPath() . 'sourceCodeFiles' . DIRECTORY_SEPARATOR . 'SourceCodeWithExecutionOperatorsSourceCode.php';
        $sourceCode = file_get_contents($sourceCodeFile);

        return $sourceCode;
    }

}
