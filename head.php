<?php

$BR = "<br>";
$BR2 = "<br><br>";

function makeHeader($title){

    $header ="
<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='utf-8' />
        <meta
            name='viewport'
            content='width=device-width, initial-scale=1, shrink-to-fit=no'/>
            <link href='bootstrap/css/bootstrap.css' rel='stylesheet' />
            <link rel='stylesheet' href='jquery-ui/jquery-ui.css' />
            <script src='jquery-ui/external/jquery/jquery.js'></script>
            <script src='bootstrap/js/bootstrap.bundle.js'></script>
            <script src='bootstrap/js/yubinbango.js'></script>
            <script src='jquery-ui/jquery-ui.js'></script>
            <script src='jquery-ui/datepicker-ja.js'></script>
            <title>$title</title>";
    return $header;
        
}

function makeFooter($company){
    $footer = "<footer>
    <div class='container-fluid mt-5'>
    <div class='row border-top'>
    <div class='col-12 mt-3'>
    <p class='text-center text-secondary'>Copyright &copy;$company</p>
    </div>
    </div>
    </div>
    </footer>";
    return $footer;
}

?>