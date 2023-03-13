<?php
session_start();
session_destroy();
$_SESSION = array();
include "structure.php";
echo giveHead("Willkommen");
echo giveHeader("index.php",false);
?>
<main class="flex flex-col justify-center items-center w-screen h-full">
    <div class="flex-col items-center flex w-full md:w-1/3 w-fit bg-white py-20 rounded-lg my-5">
        <h3 class="m-5 font-bold italic">Herzlich Willkommen!</h3>
        <p class="mb-2">Was möchtest du tun?</p>
        <div class="flex flex-col lg:flex-row">
            <a href="registration.php" class="hover:font-bold rounded border-2 border-black m-2 px-4 py-2 bg-yellow-600">Neu registrieren</a>
            <a href="login.php" class="hover:font-bold rounded border-2 border-black m-2 px-4 py-2 bg-yellow-400">Anmeldung</a>
        </div>
    </div>
</main>

<?php
echo giveFooter();
?>








