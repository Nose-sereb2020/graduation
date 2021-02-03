<?php
$db_name = "photo_db";
$username = "photo_db";
$passwd = "P@ssw0rd#2020";
$options = null;
$dsn = "mysql:host=localhost;dbname=$db_name;charset=utf8";

try{
    $pdo = new PDO($dsn, $username, $passwd , $options);
    $pdo->query("SET NAMES utf8");

    // print "データベース接続完了";
}catch(Exception $e){
    exit('データベース接続失敗' .$e->getMessage());
}

?>