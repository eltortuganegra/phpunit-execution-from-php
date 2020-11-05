# Execute a user's kata

# Overview
When users execute a kata a test must be executed.

To execute this test you can create an instance of the TestExecutor and get the result.

# How can I execute a kata?
To execute a kata you need to create a new instance with following parameters:

* A folder with a writable permission to create a temporary file.
* The phpunit shell path, for example ".\vendor\bin\phpunit".
* The boostrap path, for example ".\vendor\autoload.php".
 
`
$testExecutor = new TestExecutor(
    $temporaryFilesPath,
    $phpunitShellPath,
    $phpunitBootstrapShellPath
);
`   
To execute a test you must define 

* The path of the test to execute.
* The source code sent from user.
 
`
$testResult = $testExecutor->execute($shouldReturnTrueKataTestPath, $sourceCode);
`
 
This method will return a test result which has the following methods to get the result of the test execution:

* getIsResultOk(): return true if test has passed and false otherwise.
* getIsResultFailed(): return true if test has not passed and false otherwise.
* getResultWithError(): return true if test has an error and false otherwise.



# Testing
To execute the test go to console and execute the following sentence:

```
 .\vendor\bin\phpunit tests\
```
