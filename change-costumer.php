<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['name'];
include "structure.php";
echo giveHead("Kunden ändern");
echo giveHeader("internal-menu.php",true);
include "functions.php";
?>

<main class="flex flex-col justify-evenly items-center w-screen">

<?php
$li1 = '<li class="hover:underline m-2"><a href="all-costumers.php">Kunden-Übersicht</a></li>';
$li2 = ' <li class="hover:underline m-2"><a href="add-costumer.php">Kunde neu anlegen</a></li>';
echo giveInternalListMenu($li1,$li2);


$db = pdo_connect_mysql();
if ($db) {
    $statement = $db->prepare("select * from clients where created_by = ?");
    $statement->execute(array($user_id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $clientsCount = $statement->rowCount();
    echo "
    <h1 class='m-5 font-bold italic'>Kunden bearbeiten</h1>
    <p class='mb-5'>Wähle einen Kunden, den du bearbeiten oder löschen möchtest:</p>";
    if($clientsCount > 0){
        echo renderCostumers($result, true);
    }
    else{
        echo "<p class='text-red-500 mb-10'>Es gibt derzeit keine Kunden, die du selbst bearbeiten kannst.</p>";
    }
}
?>
</main>

<?php
echo giveFooter();
?>