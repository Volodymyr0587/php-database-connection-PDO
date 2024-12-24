<?php 

require_once __DIR__ . '/vendor/autoload.php';

$dbconfig = require_once __DIR__ . '/includes/dbconfig.php';

$dsn = "mysql:host={$dbconfig['host']};dbname={$dbconfig['dbname']};charset={$dbconfig['charset']}";

try {
    //% begin db connection
    $myPDO = new PDO(dsn: $dsn, username: $dbconfig['user'], password: $dbconfig['password']);
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // dd($myPDO);
    //% data for update
    $newTitle = 'Very interesting post';
    $id = 2;

    //% update statement
    $sql = "UPDATE notes SET title=:newTitle WHERE id=:id";
    
    //% extract values to variable
    $values = ['newTitle' => $newTitle, 'id' => $id];

    //% prepare statement for execution
    $sqlReference = $myPDO->prepare($sql);

    //% submit SQL instructions to database
    $sqlReference->execute($values);

    $myCount = $sqlReference->rowCount();
    echo "Number of records affected: $myCount <br>";
    echo "<hr/>";

} catch (PDOException $e) {
    echo 'MESSAGE: <br>' . $e->getMessage();
}