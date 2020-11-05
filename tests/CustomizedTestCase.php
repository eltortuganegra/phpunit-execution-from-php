<?php

namespace PhpunitExecutionFromPhpTest;


use PHPUnit\Framework\TestCase;

class CustomizedTestCase extends TestCase
{
    protected $temporaryFilesPath;
    protected $fixtureFilesPath;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->temporaryFilesPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'temporary_files' . DIRECTORY_SEPARATOR ;
        $this->fixtureFilesPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR ;
    }
}