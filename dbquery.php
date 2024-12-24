<?php 

require_once __DIR__ . '/vendor/autoload.php';

$dbconfig = require_once __DIR__ . '/includes/dbconfig.php';

$dsn = "mysql:host={$dbconfig['host']};dbname={$dbconfig['dbname']};charset={$dbconfig['charset']}";

try {
    $myPDO = new PDO(dsn: $dsn, username: $dbconfig['user'], password: $dbconfig['password']);
    // $myPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // $id = 2; //? Coming from an external source
    // $sqlReference = $myPDO->prepare("SELECT * FROM notes WHERE id=:id");
    // $sqlReference->execute([':id' => $id]);
    
    $limit = 2;

    $sqlReference = $myPDO->prepare("SELECT * FROM notes LIMIT :limit");
    $sqlReference->bindValue(':limit', $limit, PDO::PARAM_INT);
    $sqlReference->execute();

    if ($sqlReference->rowCount()) {
        while ($myRow = $sqlReference->fetch()) {
            echo "<h3>" . htmlspecialchars($myRow['title']) . "</h3>";
            echo htmlspecialchars($myRow['content']) . "<br>";
        }    
    } else {
        echo "No record found";
    }
} catch (PDOException $e) {
    echo 'MESSAGE: <br>' . $e->getMessage();
}
 
