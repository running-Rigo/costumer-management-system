<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
?>

<?php
    $user_id = $_SESSION['userid'];
    $user_name = $_SESSION['name'];
    include "structure.php";
    echo giveHead("Hauptmenü");
    echo giveHeader("internal-menu.php",true);
?>

<main class="flex flex-col justify-center items-center w-screen h-full">
    <div class="flex-col items-center flex w-full md:w-1/3 w-fit bg-white py-20 rounded-lg my-5">
        <h3 class="m-5 font-bold italic">Herzlich Willkommen <?php echo $user_name;?>!</h3>
        <p class="mt-5 px-20 mb-2 bg-gray-400">Was möchtest du tun?</p>
        <ul role="list" class="flex flex-col list-disc list-inside underline">
            <li class="m-2"><a href="all-costumers.php">Kunden-Übersicht</a></li>
            <li class="m-2"><a href="change-costumer.php">Bearbeiten bestehender Kunden</a></li>
            <li class="m-2"><a href="add-costumer.php">Kunde neu anlegen</a></li>
        </ul>
    </div>
</main>

<?php
    echo giveFooter();
?>



 

