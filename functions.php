<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'costumer_management';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}

function pdo_give_costumer_by_id($id){
    $db = pdo_connect_mysql();
    if ($db) {
        $statement = $db->prepare("select * from clients where company_id = ?");
        $statement->execute(array($id));
        $costumer = $statement->fetch(PDO::FETCH_ASSOC);
        if($costumer["created_by"] === $_SESSION['userid']){
            return $costumer;
        }
        else{
            return null;
        }

    }

}

?>
