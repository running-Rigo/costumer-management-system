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
        <body class='min-h-screen bg-indigo-100 flex flex-col justify-evenly items-center'>
        ";
    return $headString;
}

function giveHeader(){
    static $headerString = "
        <header class='absolute top-0 shadow-inner border-8 border-gray-700 rounded-b-3xl cursor-text flex flex-row justify-start items-center bg-yellow-500 h-20 lg:h-32 w-full font-mono'>
            <img class='h-full' src='img/logo.png'>
            <a href='index.php' class='mb-4 text-3xl underline shadow-2xl opacity-25'>Costumer-Hero</a>
          
        </header>";
    return $headerString;
}

function giveFooter(){
    $footer = "
        <footer class='absolute bottom-0 w-full h-20 bg-gray-700 rounded-t-3xl'>
        </footer>
        </body>
        </html>
    ";
    return $footer;
}





