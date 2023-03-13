<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
$user_id = $_SESSION['userid'];
$user_name = $_SESSION['name'];
$company_name = "";
$contact_person = "";
$phone = "";
$address = "";
$hasRegistered = false;
include "structure.php";
echo giveHead("Kunde anlegen");
echo giveHeader("internal-menu.php",true);
?>
    <main class="flex flex-col justify-evenly items-center w-screen">
<?php
$li1 = '<li class="hover:underline m-2"><a href="all-costumers.php">Kunden-Übersicht</a></li>';
$li2 = ' <li class="hover:underline m-2"><a href="delete.php">Bestehende Kunden ändern/löschen</a></li>';
echo giveInternalListMenu($li1,$li2);
?>
<h1 id="form-header" class='m-5 font-bold italic'>Eingabe von Kundendaten:</h1>

<?php
//if form is submitted:
if(isset($_POST['create']) && $_POST['create'] == 1) {
//if($_SERVER["REQUEST_METHOD"] == "POST"){
    $error = false;
    $company_name = $_POST['company_name'];
    $contact_person = $_POST['contact_person'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    include "functions.php";
    $db = pdo_connect_mysql();
    if(strlen($company_name) == 0) {
        echo '<p class="text-red-500 text-sm">* Bitte einen Firmen-Namen eingeben</p>';
        $error = true;
    }
    if(strlen($address) == 0) {
        echo '<p class="text-red-500 text-sm">* Bitte eine Firmen-Adresse eingeben</p>';
        $error = true;
    }
    //if no errors, costumer can be registered in database
    if(!$error) {
        $statement = $db->prepare("INSERT INTO clients VALUES (?,?,?,?,?,?,?,?)");
        $result = $statement->execute(array("default",$company_name,$contact_person,$phone,$address,$user_id,"(select curdate())","default"));
        $_POST = [];
        var_dump($_POST);
        if($result!=0){
            $hasRegistered = true;
        }else{
            echo "Beim abspeichern ist ein Fehler aufgetreten.";
        }
    }
}
?>

<!---HTML-form--->
        <form id="costumer-form" class=" flex flex-col p-10 w-full md:w-1/3 md:px-0" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="hidden" name="create"  value="1">
            <label for="company_name">Firma:<span class="text-red-500">*</span></label>
            <input class="mb-2 p-1" type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>">

            <label for="contact_person">Kontaktperson:</label>
            <input class="mb-2 p-1" type="text" name="contact_person" id="contact_person" value="<?php echo $contact_person;?>">

            <label for="phone">Telefon-Nr:</label>
            <input class="mb-2 p-1" type="text" name="phone" id="phone" value="<?php echo $phone;?>">

            <label for="address">Adresse: <span class="text-red-500">*</span></label>
            <input class="mb-2 p-1" type="text" name="address" id="address" value="<?php echo $address;?>">

            <button class="mt-2 rounded border-2 border-black px-4 py-2 bg-yellow-600"type="submit" name="submit">Kunde speichern</button>
        </form>
</main>
<?php
echo giveFooter();
if($hasRegistered) {
echo '<script>
    alert("Der Kunde wurde angelegt.")
    document.getElementById("form-header").style.display = "none";
    document.getElementById("costumer-form").innerHTML = "<p>Der Kunde ist nun in der Kunden-Übersicht einsehbar.</p>";
</script>';
}
?>