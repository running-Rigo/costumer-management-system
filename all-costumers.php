<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['name'];
include "structure.php";
echo giveHead("Kunden-Übersicht");
echo giveHeader("internal-menu.php",true);
include "functions.php";
?>

<main class="mb-8 flex flex-col justify-evenly items-center w-screen">

<?php
    $li1 = '<li class="hover:underline m-2"><a href="change-costumer.php">Bearbeiten bestehender Kunden</a></li>';
    $li2 = ' <li class="hover:underline m-2"><a href="add-costumer.php">Kunde neu anlegen</a></li>';
    echo giveInternalListMenu($li1,$li2);

$db = pdo_connect_mysql();
if ($db) {
    $statement = $db->prepare("select * from clients");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $clientsCount = $statement->rowCount();
    echo "
    <h1 class='m-5 font-bold italic'>Kundenübersicht</h1>
    <p>Es wurde(n) $clientsCount Kunde(n) gefunden:</p>";
    echo giveClientsHeader();
    foreach ($result as $clientRow){
        $i = 0;
        foreach ($clientRow as $item) {
            $i++;
            if($i == 3 || $i == 5){
                echo "<div class='col-span-2'><p>$item</p></div>";
            }
            else if($i == 4 ){
                echo "<div class='col-span-3'><p>$item</p></div>";
            }
            else{
                echo "<div><p>$item</p></div>";
            }
        }
        echo "<hr class='w-full md:hidden'>";
    }
    echo "</div>";
}
?>
</main>
<?php
echo giveFooter();
?>


