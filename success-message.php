<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
$choseMessage = "";
if(isset($_GET["action"])){
    $choseMessage = $_GET["action"];
}
$_POST = array();
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['name'];
include "structure.php";
echo giveHead("Kunden-Übersicht");
echo giveHeader("internal-menu.php",true);
include "functions.php";
?>
<main class="mb-8 flex flex-col justify-evenly items-center w-screen">
    <?php
    if($choseMessage === "new"){
        echo"
         <p>Der Kunde wurde in der Datenbank angelegt. Du kannst ihn nun in der Kundenübersicht einsehen:</p>
         <a href='all-costumers.php' class='underline hover:font-bold'>zur Kundenübersicht</a>
        ";
    }
    else if($choseMessage === "change"){
        echo"
         <p>Die Kundendaten wurden geändert.</p>
         <a href='all-costumers.php' class='underline hover:font-bold'>zur Kundenübersicht</a>
        ";
    }

    ?>
</main>
<?php
echo giveFooter();
?>


