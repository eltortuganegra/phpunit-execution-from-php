<?php

namespace PhpunitExecutionFromPhpTemporary;


class SourceCodeWithPersistentConnectionFunctionsSourceCode
{
    public function functionToTest()
    {
        $persistentConnections = [
            'fbsql_pconnect(',
            'ibase_pconnect(',
            'ifx_pconnect(',
            'ingres_pconnect(',
            'msql_pconnect(',
            'mssql_pconnect(',
            'mysql_pconnect(',
            'ociplogon(',
            'odbc_pconnect(',
            'oci_pconnect(',
            'pfsockopen(',
            'pg_pconnect(',
        ];

        return true;
    }

}