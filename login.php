<?php
session_start();
include "structure.php";
echo giveHead("Login");
echo giveHeader();
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <label for="email">Email-Adresse:</label>
    <input type="email" name="email" id="email">
    <label for="password">Passwort:</label>
    <input type="password" name="password" id="password">
<button class="bg-blue" type="submit">Login</button>
</form>

<?php
echo giveFooter();
?>

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
            header("Location: http://localhost/costumer-management-system/internal-menu.php");
            //exit('Login erfolgreich. Weiter zu <a href="internal-menu.php">internen Bereich</a>');
        } else {
            $errorMessage = "E-Mail oder Passwort war ungültig<br>";
            echo $errorMessage;
        }
    }
}
?>
