<?php

namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\KataSourceCodeFile;


class CreateADefaultKataSourceCodeFileWithSourceCodeTest extends CustomizedTestCase
{
    public function testExecutionTestIsOk()
    {
        $defaultKataSourceCodeFilename = 'DefaultKataSourceCode';
        $phpFileExtension = '.php';
        $sourceCode = 'class KataSourceCode {}';

        // Check if save method return true
        $kataSourceCodeFile = new KataSourceCodeFile();
        $kataSourceCodeFile->save($this->temporaryFilesPath, $defaultKataSourceCodeFilename, $sourceCode);

        $this->assertTrue(true);

        // Check if kata source code file file exists
        $kataSourceCodePath = $this->temporaryFilesPath . $defaultKataSourceCodeFilename . $phpFileExtension;
        $hasKataSourceCodeFileBeenCreate = is_file($kataSourceCodePath);

        $this->assertTrue($hasKataSourceCodeFileBeenCreate, 'File has not been created.');

        // Reset the default test file
        unlink($kataSourceCodePath);
    }

}