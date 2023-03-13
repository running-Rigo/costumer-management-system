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
        echo giveClientsHeader();
        echo "</div>";
        foreach ($result as $clientRow){
            echo "<div class='w-full py-4 px-8 flex flex-col md:grid grid-cols-12 place-items-start auto-rows-auto gap-4 items-center overflow-auto bg-white m-2'>";
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
            echo "<div class='col-start-5 col-span-3 place-self-center py-5'>
              <a class='hover:font-bold bg-yellow-500 p-2 rounded ' href='edit.php?id=".$clientRow['company_id']."'>Bearbeiten</a>
              <a class='hover:font-bold bg-yellow-700 p-2 rounded' href='delete.php?id=".$clientRow['company_id']."'>Löschen</a>
             </div>";

            echo "</div>";
            echo "<hr class='w-full md:hidden'>";
        }
        echo "</div>";
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