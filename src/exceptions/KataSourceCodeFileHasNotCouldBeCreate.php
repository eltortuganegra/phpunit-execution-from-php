<?php

namespace PhpunitExecutionFromPhp\exceptions;


use Exception;

class KataSourceCodeFileHasNotCouldBeCreated extends Exception
{
    protected $message = 'Kata Source Code File has nor could be created';
}