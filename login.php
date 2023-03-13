<?php
session_start([
        'use_strict_mode'  => true,
]);
include "structure.php";
echo giveHead("Login");
echo giveHeader("index.php",false);
?>
<main class="flex flex-col justify-center items-center w-screen h-full">
    <form class="flex flex-col" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <label for="email">Email-Adresse:</label>
        <input class="mb-2 p-1" type="email" name="email" id="email">
        <label for="password">Passwort:</label>
        <input class="mb-2 p-1" type="password" name="password" id="password">
        <button class="rounded border-2 border-black m-2 px-4 py-2 bg-yellow-400" type="submit">Login</button>
    </form>

<!--PHP-Script for submitting form data:-->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $email = $_POST["email"];
    $password = $_POST["password"];
    include "functions.php";
    $db = pdo_connect_mysql();
    if ($db) {
        $statement = $db->prepare("select * from users where email = ?");
        $statement->execute(array($email));
        $user = $statement->fetch();
        //Überprüfung des Passworts mit Hash in der DB
        if ($user !== false && password_verify($password, $user['password'])) {
            $_SESSION['userid'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            header("Location: http://localhost/costumer-management-system/internal-menu.php");
            //exit('Login erfolgreich. Weiter zu <a href="internal-menu.php">internen Bereich</a>');
        } else {
            $errorMessage = "E-Mail oder Passwort war ungültig<br>";
            echo "<p class='px-4 py-2 text-red-600 border border-red-600'>$errorMessage</p>";
        }
    }
}
?>
    <a class="mt-8 opacity-50 rounded border-2 border-black px-4 py-2 bg-yellow-600" href="registration.php">Neu registrieren</a>
</main>
<?php
echo giveFooter();
?>
