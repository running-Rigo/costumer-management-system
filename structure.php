<?php
function giveHead($title){
    $headString = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>$title</title>
            <link href='https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css' rel='stylesheet'>
        </head>
        <body class='text-gray-900 min-h-screen bg-indigo-100 flex justify-between flex-col'>
        ";
    return $headString;
}

function giveHeader($link,$hasLogout){
    $headerString1 = "
        <header class='text-center shadow-inner border-8 border-gray-700 rounded-b-3xl cursor-text grid grid-cols-3 grid-rows-1 bg-yellow-500 h-24 lg:h-32 w-full font-mono'>
            <img class='h-full p-2' src='img/logo.png'>
            <a href=$link class='rounded py-2 lg:py-4 my-2 lg:my-4 text-xl lg:text-3xl underline shadow-2xl'>Costumer-Hero</a>";
    if($hasLogout){
        $headerString2 = "
        <a class='self-center justify-self-end opacity-50 mr-5 hover:underline hover:opacity-100' href='index.php'><img src='img/logout.png' class='h-8'>Logout</a>
        ";
    }
    else{
        $headerString2="";
    }
    $headerString3 = "</header>";
    return $headerString1.$headerString2.$headerString3;
}

function giveFooter(){
    $footer = "
        <footer class='w-full h-16 xl:h-24 bg-gray-700 rounded-t-3xl'>
        <nav class='flex h-full justify-evenly items-center text-yellow-400'>
             <a class='underline hover:font-bold'>DSGVO</a>
             <a class='underline hover:font-bold'>Impressium</a>
             <a class='underline hover:font-bold'>FAQs / Hilfe</a>
        </nav>
        </footer>
        </body>
        </html>
    ";
    return $footer;
}

function giveInternalListMenu($li1,$li2){
    return '
    <div class="opacity-75 hover:opacity-100 flex-col items-center flex w-full md:w-1/3 w-fit bg-white rounded-lg mb-16 mt-4">
        <p class="mt-5 px-20 mb-2 bg-gray-400">Wechsle zu:</p>
        <ul role="list" class="no-underline mb-10 flex flex-col list-disc list-inside underline">
           '.$li1.$li2.'
        </ul>
    </div>
    ';
}

function giveClientsHeader(){
    return "
    <div class='gap-y-4 w-full py-4 px-8 flex flex-col md:grid grid-cols-12 auto-rows-auto gap-4 items-center overflow-auto bg-white m-2'>
        <div class='hidden md:inline font-semibold'>Kundennr.</div>
        <div class='hidden md:inline col-span-2 font-semibold'>Name</div>
        <div class='hidden md:inline col-span-2 font-semibold'>Ansprechperson</div>
        <div class='hidden md:inline col-span-2 font-semibold'>Telefonnr.</div>
        <div class='hidden md:inline col-span-2 font-semibold'>Adresse</div>
        <div class='hidden md:inline font-semibold'>Erstellt von:</div>
        <div class='hidden md:inline font-semibold'>Erstellt am:</div>
        <div class='hidden md:inline font-semibold'>Bearbeitet am:</div>
    ";
}
?>






