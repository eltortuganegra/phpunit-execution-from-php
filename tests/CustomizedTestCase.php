<?php

namespace PhpunitExecutionFromPhpTest;


use PHPUnit\Framework\TestCase;

class CustomizedTestCase extends TestCase
{
    protected $temporaryFilesPath;
    protected $fixtureFilesPath;
    protected $phpunitShellPath;
    protected $phpunitBootstrapShellPath;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $rootPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $this->temporaryFilesPath = $rootPath . 'temporary_files' . DIRECTORY_SEPARATOR ;
        $this->fixtureFilesPath = $rootPath . 'fixtures' . DIRECTORY_SEPARATOR;
        $this->phpunitShellPath = $rootPath . 'vendor' . DIRECTORY_SEPARATOR  . 'bin' . DIRECTORY_SEPARATOR . 'phpunit';
        $this->phpunitBootstrapShellPath = $rootPath . 'vendor' . DIRECTORY_SEPARATOR  . 'autoload.php';
    }
}