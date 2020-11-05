<?php


namespace PhpunitExecutionFromPhp\exceptions;


use Exception;

class ShellOutputHasNotValidFormat extends Exception
{
    protected $message = 'Shell output has not a valid format';

}