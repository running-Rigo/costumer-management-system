<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['name'];
include "structure.php";
echo giveHead("Kunden-Übersicht");
echo giveHeader("internal-menu.php");
include "functions.php";
?>

<main class="flex flex-col justify-center items-center w-screen h-full">

<?php
$db = pdo_connect_mysql();
if ($db) {
    $statement = $db->prepare("select * from clients");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $clientsCount = $statement->rowCount();
    echo "Es wurde(n) $clientsCount Kunde(n) gefunden:";
    foreach ($result as $clientRow){
        echo "<div class='flex flex-col md:flex-row justify-evenly items-center w-screen bg-white m-2'>";
        foreach ($clientRow as $item) {
            echo "<div>$item</div>";
        }
        echo "</div>";
    }
}
?>
</main>
<?php
echo giveFooter();
?>


