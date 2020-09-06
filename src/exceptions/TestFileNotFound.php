<?php


namespace PhpExecutionFromPhp\exceptions;


use Exception;

class TestFileNotFound extends Exception
{
    protected $message = 'Test file not found.';
}