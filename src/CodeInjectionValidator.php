<?php

namespace PhpunitExecutionFromPhp;


use PhpunitExecutionFromPhp\exceptions\PossibleCodeInjectionDetected;

class CodeInjectionValidator
{
    protected $programExecutionFunctions;
    private $sourceCode;
    private string $executionOperator;
    private array $fileSystemFunctions;

    public function __construct()
    {
        $this->programExecutionFunctions = [
            'escapeshellarg',
            'escapeshellcmd',
            'exec',
            'passthru',
            'proc_close',
            'proc_get_status',
            'proc_nice',
            'proc_open',
            'proc_terminate',
            'shell_exec',
            'system'
        ];
        $this->executionOperator = '`';
        $this->fileSystemFunctions = [
            'basename',
            'chgrp',
            'chmod',
            'chown',
            'clearstatcache',
            'copy',
            'delete',
            'dirname',
            'disk_free_space',
            'disk_total_space',
            'diskfreespace',
            'fclose',
            'feof',
            'fflush',
            'fgetc',
            'fgetcsv',
            'fgets',
            'fgetss',
            'file_exists',
            'file_get_contents',
            'file_put_contents',
            'file',
            'fileatime',
            'filectime',
            'filegroup',
            'fileinode',
            'filemtime',
            'fileowner',
            'fileperms',
            'filesize',
            'filetype',
            'flock',
            'fnmatch',
            'fopen',
            'fpassthru',
            'fputcsv',
            'fputs',
            'fread',
            'fscanf',
            'fseek',
            'fstat',
            'ftell',
            'ftruncate',
            'fwrite',
            'glob',
            'is_dir',
            'is_executable',
            'is_file',
            'is_link',
            'is_readable',
            'is_uploaded_file',
            'is_writable',
            'is_writeable',
            'lchgrp',
            'lchown',
            'link',
            'linkinfo',
            'lstat',
            'mkdir',
            'move_uploaded_file',
            'parse_ini_file',
            'parse_ini_string',
            'pathinfo',
            'pclose',
            'popen',
            'readfile',
            'readlink',
            'realpath_cache_get',
            'realpath_cache_size',
            'realpath',
            'rename',
            'rewind',
            'rmdir',
            'set_file_buffer',
            'stat',
            'symlink',
            'tempnam',
            'tmpfile',
            'touch',
            'umask',
            'unlink',
        ];
    }

    /**
     * @param string $sourceCode
     * @throws PossibleCodeInjectionDetected
     */
    public function validate(string $sourceCode): void
    {
        $this->setSourceCode($sourceCode);
        $this->checkIfProgramExecutionFunctionsAreFound();
        $this->checkIfAnExecutionOperatorIsFound();
        $this->checkIfFileSystemFunctionsAreFound();
    }

    private function setSourceCode(string $sourceCode)
    {
        $this->sourceCode = $sourceCode;
    }

    /**
     * @param string $sourceCode
     * @param string $programExecutionFunctionCall
     * @throws PossibleCodeInjectionDetected
     */
    public function checkIfTheProgramExecutionFunctionIsFound(string $programExecutionFunctionCall): void
    {
        if ($this->isProgramExecutionFunctionFound($programExecutionFunctionCall)) {
            throw new PossibleCodeInjectionDetected();
        }
    }

    /**
     * @param string $sourceCode
     * @param string $programExecutionFunctionCall
     * @return bool
     */
    public function isProgramExecutionFunctionFound(string $programExecutionFunctionCall): bool
    {
        return strpos($this->sourceCode, $programExecutionFunctionCall) !== false;
    }

    /**
     * @throws PossibleCodeInjectionDetected
     */
    public function checkIfProgramExecutionFunctionsAreFound(): void
    {
        foreach ($this->programExecutionFunctions as $programExecutionFunction) {
            $sourceCodeFunctionCall = $programExecutionFunction . '(';
            $this->checkIfTheProgramExecutionFunctionIsFound($sourceCodeFunctionCall);
            $sourceCodeFunctionCall = $programExecutionFunction . ' (';
            $this->checkIfTheProgramExecutionFunctionIsFound($sourceCodeFunctionCall);
        }
    }

    /**
     * @throws PossibleCodeInjectionDetected
     */
    public function checkIfAnExecutionOperatorIsFound(): void
    {
        if (strpos($this->sourceCode, $this->executionOperator) !== false) {
            throw new PossibleCodeInjectionDetected();
        }
    }

    /**
     * @param string $sourceCode
     * @throws PossibleCodeInjectionDetected
     */
    public function checkIfFileSystemFunctionsAreFound(): void
    {
        foreach ($this->fileSystemFunctions as $fileSystemFunction) {
            $fileSystemFunctionCall = $fileSystemFunction . '(';
            $this->checkIfFileSystemFunctionCallIsFound($fileSystemFunctionCall);
            $fileSystemFunctionCall = $fileSystemFunction . ' (';
            $this->checkIfFileSystemFunctionCallIsFound($fileSystemFunctionCall);
        }
    }

    /**
     * @param string $fileSystemFunctionCall
     * @throws PossibleCodeInjectionDetected
     */
    public function checkIfFileSystemFunctionCallIsFound(string $fileSystemFunctionCall): void
    {
        if (strpos($this->sourceCode, $fileSystemFunctionCall !== false)) {
            throw new PossibleCodeInjectionDetected();
        }
    }

}