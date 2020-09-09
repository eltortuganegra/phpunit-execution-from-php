<?php

namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\KataSourceCodeFile;


class CreateDefaultKataSourceCodeFileWithDefaultKataSourceContentClassTest extends CustomizedTestCase
{

    public function testExecutionTestIsOk()
    {
        // Arrange
        $defaultKataSourceCodeFilename = 'DefaultKataSourceCode';
        $sourceCode = 'public function functionToTest() {}';
        $kataSourceCodeFile = new KataSourceCodeFile();
        $kataSourceCodeFile->save($this->temporaryFilesPath, $defaultKataSourceCodeFilename, $sourceCode);

        // Check if default test has the correct content
        $kataSourceCodeFileContent = $this->getKataSourceCodeContent($defaultKataSourceCodeFilename);
        $defaultKataSourceCodeFixtureContent = $this->getDefaultKataSourceCodeFixtureContent();
        $isContentCorrect = ($kataSourceCodeFileContent === $defaultKataSourceCodeFixtureContent);

        // Assert
        $this->assertTrue($isContentCorrect, 'Files don\'t have the same content.');

        // Reset the default test file
        $defaultKataSourceCodePath = $this->getDefaultKataSourceCodePath($defaultKataSourceCodeFilename);

        unlink($defaultKataSourceCodePath);
    }

    private function getDefaultKataSourceCodeFixtureContent(): string
    {
        $defaultKataSourceCodePath = $this->fixtureFilesPath . 'DefaultKataSourceCode.php';
        $defaultKataSourceCodeContent = file_get_contents($defaultKataSourceCodePath);

        return $defaultKataSourceCodeContent;
    }

    /**
     * @param $temporaryFilesPath
     * @param string $defaultKataSourceCodeFilename
     * @return false|string
     */
    private function getKataSourceCodeContent(string $defaultKataSourceCodeFilename)
    {
        $defaultKataSourceCodePath = $this->getDefaultKataSourceCodePath($defaultKataSourceCodeFilename);
        $defaultKataSourceCodeContent = file_get_contents($defaultKataSourceCodePath);

        return $defaultKataSourceCodeContent;
    }

    /**
     * @param string $defaultTestNameFile
     * @return string
     */
    private function getDefaultKataSourceCodePath(string $defaultTestNameFile): string
    {
        $testFilePath = $this->temporaryFilesPath . $defaultTestNameFile . '.php';

        return $testFilePath;
    }

}