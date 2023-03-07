<?php
session_start();
session_destroy();
$_SESSION = array();
include "structure.php";
echo giveHead("Registration");
echo giveHeader();

$nameErr = $emailErr = $passwordErr = "";
$name = $email = $password = "";
?>
<form class="flex flex-col" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label for="username">User-Name:</label>
    <input type="text" name="username" id="username">
    <label for="email">Email-Adresse: <span class="text-blue-900">* <?php echo $nameErr;?></span></label>
    <input type="email" name="email" id="email">
    <label for="password">Passwort:</label>
    <input type="password" name="password" id="password">
    <label for="confirmpassword">Bestätige das Passwort:</label>
    <input type="password" name="confirmpassword" id="confirmpassword">
    <button class="rounded border-2 border-black px-4 py-2 bg-yellow-600"type="submit" name="submit">Registrieren</button>
</form>

<a class="rounded border-2 border-black px-4 py-2 bg-yellow-400" href="login.php">Login</a>

<?php
echo giveFooter();
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $error = false;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['confirmpassword'];
    include "functions.php";
    $db = pdo_connect_mysql();
    if ($db) {

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
            $error = true;
        }
        if(strlen($password) == 0) {
            echo 'Bitte ein Passwort angeben<br>';
            $error = true;
        }
        if($password != $password2) {
            echo 'Die Passwörter müssen übereinstimmen<br>';
            $error = true;
        }

        //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
        if(!$error) {
            $statement = $db->prepare("SELECT * FROM users WHERE email = :email");
            $result = $statement->execute(array('email' => $email));
            $user = $statement->fetch();
            if($user !== false) {
                echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
                $error = true;
            }
        }

        //Keine Fehler, wir können den Nutzer registrieren
        if(!$error) {
            $passwort_hash = password_hash($password, PASSWORD_DEFAULT);

            $statement = $db->prepare("INSERT INTO users (email, password, name) VALUES (:email, :password, :username)");
            $result = $statement->execute(array('email' => $email, 'password' => $passwort_hash, 'username' => $username));
            if($result) {
                echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            } else {
                echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
            }
        }
    }
    else{
        echo "Leider ist derzeit keine Verbindung zur Datenbank möglich. Versuchen Sie es später erneut!";
        echo "<a href='index.php'>Zurück zur Startseite</a>>";
    }
}
?>

