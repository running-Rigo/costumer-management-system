<?php
session_start();
session_destroy();
$_SESSION = array();
include "structure.php";
echo giveHead("Willkommen");
echo giveHeader();
?>

<div class="flex-col items-center flex w-1/3 w-fit bg-white py-20 rounded-lg ">
    <h3 class="m-5 font-bold italic">Herzlich Willkommen!</h3>
    <p class="mb-2">Was möchtest du tun?</p>
    <div>
        <a href="registration.php" class="rounded border-2 border-black px-4 py-2 bg-yellow-600">Neu registrieren</a>
        <a href="login.php" class="rounded border-2 border-black px-4 py-2 bg-yellow-400">Anmeldung</a>
    </div>
</div>

<?php
echo giveFooter();
?>








