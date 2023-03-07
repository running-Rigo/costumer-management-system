<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
else{
    $user_id = $_SESSION['userid'];
    include "structure.php";
    echo giveHead("Hauptmenü");
    echo giveHeader();
    echo giveFooter();
}
?>


 

