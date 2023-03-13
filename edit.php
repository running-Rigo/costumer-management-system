<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: http://localhost/costumer-management-system/index.php");
}
?>

<?php
    $user_id = $_SESSION['userid'];
    $user_name = $_SESSION['name'];
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $costumer_id = $_GET['id'];
}
else{
    $costumer_id = $_POST['costumer_id'];
}
    $company_name = "";
    $contact_person = "";
    $phone = "";
    $address = "";

    include "structure.php";
    echo giveHead("Hauptmenü");
    echo giveHeader("internal-menu.php",true);
?>
    <main id="main" class="flex flex-col justify-evenly items-center w-screen">
<?php
$li1 = '<li class="hover:underline m-2"><a href="all-costumers.php">Kunden-Übersicht</a></li>';
$li2 = ' <li class="hover:underline m-2"><a href="add-costumer.php">Neuen Kunden hinzufügen</a></li>';
echo giveInternalListMenu($li1,$li2);
?>
<h1 id="form-header" class='m-5 font-bold italic'>Änderung der Kundendaten:</h1>
<?php
        include "functions.php";
        //get values from selected costumer from db:
        $costumer = pdo_give_costumer_by_id($costumer_id);
        if($costumer === null){
            header("Location: http://localhost/costumer-management-system/internal-menu.php");
        }
        $costumer_id = $costumer["company_id"];
        $company_name = $costumer['company_name'];
        $contact_person = $costumer['contact_person'];
        $phone = $costumer['phone'];
        $address = $costumer['address'];

//if($_SERVER["REQUEST_METHOD"] == "POST") aka changes were submitted:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = false;
    $company_name = $_POST['company_name'];
    $contact_person = $_POST['contact_person'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $change_date = date("Y-m-d");

    $db = pdo_connect_mysql();
    if(strlen($company_name) == 0) {
        echo '<p class="text-red-500 text-sm">* Bitte einen Firmen-Namen eingeben</p>';
        $error = true;
    }
    if(strlen($address) == 0) {
        echo '<p class="text-red-500 text-sm">* Bitte eine Firmen-Adresse eingeben</p>';
        $error = true;
    }
    //if no errors, update can be done in database:
    if(!$error) {
        $statement = $db->prepare("update clients set company_name = ?, contact_person = ?, phone = ?, address = ?, edited_at = ? where company_id = ? ");
        if($statement->execute(array($company_name,$contact_person,$phone,$address,$change_date,$costumer_id))){
            header("Location: http://localhost/costumer-management-system/success-message.php?action=change");
        }
        else{
            echo "Beim abspeichern ist ein Fehler aufgetreten.";
        }

    }
}

?>

<!---HTML-form--->
<form id="change-form" class=" flex flex-col p-10 w-full md:w-1/3 md:px-0" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <input type="hidden" name="costumer_id"  value=<?php echo $costumer_id;?>>
    <label for="company_name">Firma:<span class="text-red-500">*</span></label>
    <input class="mb-2 p-1" type="text" name="company_name" id="company_name" value="<?php echo $company_name;?>">

    <label for="contact_person">Kontaktperson:</label>
    <input class="mb-2 p-1" type="text" name="contact_person" id="contact_person" value="<?php echo $contact_person;?>">

    <label for="phone">Telefon-Nr:</label>
    <input class="mb-2 p-1" type="text" name="phone" id="phone" value="<?php echo $phone;?>">

    <label for="address">Adresse: <span class="text-red-500">*</span></label>
    <input class="mb-2 p-1" type="text" name="address" id="address" value="<?php echo $address;?>">

    <button class="mt-2 rounded border-2 border-black px-4 py-2 bg-yellow-600"type="submit" name="submit">Änderung speichern</button>
</form>
</main>

<?php
echo giveFooter();
?>


