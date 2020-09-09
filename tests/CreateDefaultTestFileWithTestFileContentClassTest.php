<?php

namespace PhpunitExecutionFromPhpTest;


use PhpunitExecutionFromPhp\TestFile;


class CreateDefaultTestFileWithTestFileContentClassTest extends CustomizedTestCase
{

    public function testExecutionTestIsOk()
    {
        // Arrange
        $defaultTestNameFile = 'DefaultTest';
        $sourceCode = 'public function defaultTestFunction() {}';
        $testFile = new TestFile($this->temporaryFilesPath);
        $testFile->save($defaultTestNameFile, $sourceCode);

        // Check if default test has the correct content
        $testFileContent = $this->getTestFileContent($defaultTestNameFile);
        $defaultTestFileFixtureContent = $this->getDefaultTestFileFixtureContent();
        $isTestFileContentCorrect = ($testFileContent === $defaultTestFileFixtureContent);

        // Assert
        $this->assertTrue($isTestFileContentCorrect, 'Files don\'t have the same content.');
        // Reset the default test file
        $defaultTestFilePath = $this->getTestFilePath($defaultTestNameFile);

        unlink($defaultTestFilePath);
    }

    private function getDefaultTestFileFixtureContent(): string
    {
        $defaultTestFilePath = $this->fixtureFilesPath . 'DefaultTest.php';
        $defaultTestFileContent = file_get_contents($defaultTestFilePath);

        return $defaultTestFileContent;
    }

    /**
     * @param $temporaryFilesPath
     * @param string $defaultTestNameFile
     * @return false|string
     */
    private function getTestFileContent(string $defaultTestNameFile)
    {
        $testFilePath = $this->getTestFilePath($defaultTestNameFile);
        $testFileContent = file_get_contents($testFilePath);

        return $testFileContent;
    }

    /**
     * @param string $defaultTestNameFile
     * @return string
     */
    private function getTestFilePath(string $defaultTestNameFile): string
    {
        $testFilePath = $this->temporaryFilesPath . $defaultTestNameFile . '.php';

        return $testFilePath;
    }

}