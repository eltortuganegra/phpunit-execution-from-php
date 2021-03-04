<?php

namespace PhpunitExecutionFromPhp;


use PhpunitExecutionFromPhp\exceptions\PossibleCodeInjectionDetected;

class CodeInjectionValidator
{
    protected $programExecutionFunctions;
    private $sourceCode;
    private string $executionOperator;
    private array $fileSystemFunctions;
    private array $persistentConnections;

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
        $this->persistentConnections = [
            'fbsql_pconnect',
            'ibase_pconnect',
            'ifx_pconnect',
            'ingres_pconnect',
            'msql_pconnect',
            'mssql_pconnect',
            'mysql_pconnect',
            'ociplogon',
            'odbc_pconnect',
            'oci_pconnect',
            'pfsockopen',
            'pg_pconnect',
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
        $this->checkIfPersistentConnectionsAreFound();
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

    /**
     * @throws PossibleCodeInjectionDetected
     */
    public function checkIfPersistentConnectionsAreFound(): void
    {
        foreach ($this->persistentConnections as $persistentConnectionFunction) {
            $persistentConnectionFunctionCall = $persistentConnectionFunction . '(';
            $this->checkIfPersistentConnectionFound($persistentConnectionFunctionCall);
            $persistentConnectionFunctionCall = $persistentConnectionFunction . ' (';
            $this->checkIfPersistentConnectionFound($persistentConnectionFunctionCall);
        }
    }

    /**
     * @param string $persistentConnectionFunctionCall
     * @return bool
     */
    public function isPersistentConnectionCallFound(string $persistentConnectionFunctionCall): bool
    {
        return strpos($this->sourceCode, $persistentConnectionFunctionCall) !== false;
    }

    /**
     * @param string $persistentConnectionFunctionCall
     * @throws PossibleCodeInjectionDetected
     */
    public function checkIfPersistentConnectionFound(string $persistentConnectionFunctionCall): void
    {
        if ($this->isPersistentConnectionCallFound($persistentConnectionFunctionCall)) {
            throw new PossibleCodeInjectionDetected();
        }
    }

}