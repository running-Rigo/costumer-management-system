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
        <body class='min-h-screen bg-indigo-100 flex justify-between flex-col'>
        ";
    return $headString;
}

function giveHeader($link){
    $headerString = "
        <header class='text-center shadow-inner border-8 border-gray-700 rounded-b-3xl cursor-text grid grid-cols-3 grid-rows-1 bg-yellow-500 h-24 lg:h-32 w-full font-mono'>
            <img class='h-full p-2' src='img/logo.png'>
            <a href=$link class='rounded py-2 lg:py-4 my-2 lg:my-4 text-gray-900 text-xl lg:text-3xl underline shadow-2xl'>Costumer-Hero</a>
        </header>";
    return $headerString;
}

function giveFooter(){
    $footer = "
        <footer class='w-full h-16 xl:h-24 bg-gray-700 rounded-t-3xl'>
        </footer>
        </body>
        </html>
    ";
    return $footer;
}





