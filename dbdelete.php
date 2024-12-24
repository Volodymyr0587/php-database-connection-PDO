<?php 

require_once __DIR__ . '/vendor/autoload.php';

$dbconfig = require_once __DIR__ . '/includes/dbconfig.php';

$dsn = "mysql:host={$dbconfig['host']};dbname={$dbconfig['dbname']};charset={$dbconfig['charset']}";

try {
    //% begin db connection
    $myPDO = new PDO(dsn: $dsn, username: $dbconfig['user'], password: $dbconfig['password']);
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // dd($myPDO);
   
    //% ID to be deleted
    $id = 23;

    //% SQL template to be compiled:
    $sql = "DELETE FROM notes WHERE id=:id";

    //% Placeholders and values to be deleted
    // $values = ['id' => $id];

    //% Create prepared template based on $sql:
    $sqlReference = $myPDO->prepare($sql);

    //% Bind values to placeholders and execute query
    $sqlReference->bindParam(':id', $id, PDO::PARAM_INT);
    // $sqlReference->execute($values);
    $sqlReference->execute();


    //% Feedback of affected row
    $myCount = $sqlReference->rowCount();
    echo "Number of records affected: $myCount <br>";
    echo "<hr/>";

} catch (PDOException $e) {
    echo 'MESSAGE: <br>' . $e->getMessage();
}