<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'costumer_management';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}

function pdo_give_costumer_by_id($id){
    $db = pdo_connect_mysql();
    if ($db) {
        $statement = $db->prepare("select * from clients where company_id = ?");
        $statement->execute(array($id));
        $costumer = $statement->fetch(PDO::FETCH_ASSOC);
        if(isset($costumer["created_by"]) && $costumer["created_by"] === $_SESSION['userid']){
            return $costumer;
        }
        else{
            return null;
        }

    }

}

function renderCostumers($result,$hasButtons){
    $htmlString = giveClientsHeader();
    $htmlString .="</div>";
    foreach ($result as $clientRow){
        $htmlString .= "<div class='w-full py-4 px-8 flex flex-col md:grid grid-cols-12 place-items-start auto-rows-auto gap-4 items-center overflow-auto bg-white m-2'>";
        $i = 0;
        foreach ($clientRow as $item) {
            $i++;
            if($i == 2 || $i == 3 || $i == 5 || $i == 4 ){
                $htmlString.= "<div class='col-span-2'><p>$item</p></div>";
            }
            else{
                $htmlString.= "<div><p>$item</p></div>";
            }
        }
        if($hasButtons){
            $htmlString .= "<div class='col-start-5 col-span-3 place-self-center py-5'>
              <a class='hover:font-bold bg-yellow-500 p-2 rounded ' href='edit.php?id=".$clientRow['company_id']."'>Bearbeiten</a>
              <a class='hover:font-bold bg-yellow-700 p-2 rounded' href='delete.php?id=".$clientRow['company_id']."'>Löschen</a>
             </div>";
        }
        $htmlString .= "</div>";
    }
    $htmlString .= "</div>";
    return $htmlString;
}
?>
