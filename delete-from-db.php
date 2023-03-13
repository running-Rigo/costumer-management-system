<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}

include "structure.php";
echo giveHead("Kunde gelöscht.");
echo giveHeader("internal-menu.php",true);
include "functions.php";
?>

<main class="flex flex-col justify-evenly items-center w-screen">

<?php
$costumer_id = $_GET["id"];
$db = pdo_connect_mysql();
    if ($db) {
        $statement = $db->prepare("delete from clients where company_id = ?");
        $statement->execute(array($costumer_id));
        echo "<p class='text-red-500 border-2 border-red-500 p-2 mb-4'>User gelöscht.<p>
         <a href='internal-menu.php' class='underline hover:bg-yellow-200 p-2'>Zurück zum Hauptmenü</a>
         </main>";
        echo giveFooter();
    }
?>



