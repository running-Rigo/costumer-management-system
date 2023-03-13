<?php
session_start();
session_destroy();
$_SESSION = array();
include "structure.php";
echo giveHead("Registration");
echo giveHeader("index.php",false);
$nameErr = $emailErr = $passwordErr = "";
$username = $email = $password = "";
$hasRegistered = false;
?>
<main class="flex flex-col justify-center items-center w-screen h-full">

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $error = false;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['confirmpassword'];
    include "functions.php";
    $db = pdo_connect_mysql();
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p class="text-red-500 text-sm">* Bitte eine gültige E-Mail-Adresse eingeben</p>';
        $error = true;
    }
    if(strlen($password) == 0) {
        echo '<p class="text-red-500 text-sm">* Bitte ein Passwort eingeben</p>';
        $error = true;
    }
    if($password != $password2) {
        echo '<p class="text-red-500 text-sm">! Die Passwörter müssen übereinstimmen</p>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $db->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        if($user !== false) {
            echo '<p class="text-red-500 text-sm">! Diese Email-Adresse ist bereits vergeben.</p>';
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        $passwort_hash = password_hash($password, PASSWORD_DEFAULT);
        $statement = $db->prepare("INSERT INTO users (email, password, name) VALUES (:email, :password, :username)");
        $result = $statement->execute(array('email' => $email, 'password' => $passwort_hash, 'username' => $username));
        if($result){
            $hasRegistered = true;
        }else{
            echo "Beim abspeichern ist ein Fehler aufgetreten.";
        }
    }


}
?>
    <form id="reg-form" class=" flex flex-col p-10 w-full md:w-1/3 md:px-0" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="username">User-Name:</label>
        <input class="mb-2 p-1" type="text" name="username" id="username" value="<?php echo $username;?>">
        <label for="email">Email-Adresse: <span class="text-red-500">*</span></label>
        <input class="mb-2 p-1" type="email" name="email" id="email" value="<?php echo $email;?>">
        <label for="password">Passwort: <span class="text-red-500">*</span></label>
        <input class="mb-2 p-1" type="password" name="password" id="password">
        <label for="confirmpassword">Bestätige das Passwort: <span class="text-red-500">*</span></label>
        <input class="mb-2 p-1" type="password" name="confirmpassword" id="confirmpassword">
        <button class="mt-2 rounded border-2 border-black px-4 py-2 bg-yellow-600"type="submit" name="submit">Registrieren</button>
    </form>
    <a id="login-btn" class="my-8 opacity-50 rounded border-2 border-black px-4 py-2 bg-yellow-400" href="login.php">zum Login</a>
</main>

<?php
echo giveFooter();

if($hasRegistered) {
    echo '<script>
alert("Du wurdest erfolgreich registriert.")
document.getElementById("reg-form").innerHTML = "<p>Danke für die Registrierung. Du kannst dich jetzt einloggen:</p>";
document.getElementById("login-btn").style.opacity = 1;
</script>';
}
?>





