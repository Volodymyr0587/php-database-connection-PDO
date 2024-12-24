<?php 

require_once __DIR__ . '/vendor/autoload.php';

$dbconfig = require_once __DIR__ . '/includes/dbconfig.php';

$dsn = "mysql:host={$dbconfig['host']};dbname={$dbconfig['dbname']};charset={$dbconfig['charset']}";

try {
    //% begin db connection
    $myPDO = new PDO(dsn: $dsn, username: $dbconfig['user'], password: $dbconfig['password']);

    //% data to insert
    $title = "How hard is programming?";
    $content = "Programming is no hard; it's just time intense. Keep practicing and you will do well";

    //% insert statement
    $sql = "INSERT INTO notes(title, content) VALUES(:title, :content)";

    //% extract values to variable
    $values = [':title' => $title, ':content' => $content];

    //% prepare statement for execution
    $sqlReference = $myPDO->prepare($sql);

    //% submit SQL instructions to database
    $sqlReference->execute($values);

    $myCount = $sqlReference->rowCount();
    echo "Number of records affected: $myCount <br>";
    echo "<hr/>";

    $lastID = $myPDO->lastInsertId();
    echo "Last id: $lastID <br>";

    $lastRecord = $myPDO->query("SELECT * FROM notes WHERE id=$lastID");

    while ($row = $lastRecord->fetch()) {
        echo "<strong>" . $row['title'] . "</strong>" . " has been added";
    }

} catch (PDOException $e) {
    echo 'MESSAGE: <br>' . $e->getMessage();
}