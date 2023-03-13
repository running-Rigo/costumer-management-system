<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
?>

<?php
    $user_id = $_SESSION['userid'];
    $user_name = $_SESSION['name'];
    $costumer_id = $_GET['id'];
    include "structure.php";
    echo giveHead("Hauptmenü");
    echo giveHeader("internal-menu.php",true);
?>
<main class="flex flex-col justify-evenly items-center w-screen">
        <?php
        include "functions.php";
        $costumer = pdo_give_costumer_by_id($_GET["id"]);
        if($costumer != null){
            echo "
            <div>
                 <h1>Möchtest du den ausgewählten Kunden wirklich löschen?</h1>
             </div>
             <div class='w-full p-4 flex flex-col md:grid grid-cols-12 place-items-start auto-rows-auto gap-4 items-center overflow-auto bg-white m-2'>";
            $i = 0;
            foreach ($costumer as $item) {
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
              <a class='hover:font-bold hover:bg-red-400 bg-yellow-500 p-2 rounded border-2 border-red-600' href='delete-from-db.php?id=$costumer_id'>Löschen bestätigen</a>
             </div>";
            echo "</div>";
        }
        else{
            header("Location: http://localhost/costumer-management-system/internal-menu.php");
        }
        ?>


</main>

<?php
echo giveFooter();
?>


