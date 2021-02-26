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
        $this->temporaryFilesPath = self::getRootPath() . 'temporary_files' . DIRECTORY_SEPARATOR ;
        $this->fixtureFilesPath = self::getRootPath() . 'fixtures' . DIRECTORY_SEPARATOR;
        $this->phpunitShellPath = self::getRootPath() . 'vendor' . DIRECTORY_SEPARATOR  . 'bin' . DIRECTORY_SEPARATOR . 'phpunit';
        $this->phpunitBootstrapShellPath = self::getRootPath() . 'vendor' . DIRECTORY_SEPARATOR  . 'autoload.php';
    }

    public function getFixtureFilesPath(): string
    {
        return $this->fixtureFilesPath;
    }

    public static function getRootPath():string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
    }
}