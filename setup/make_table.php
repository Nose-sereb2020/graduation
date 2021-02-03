<?php 
include_once "../db/db_connect.php";

// イメージテーブル作成
$table_name = "img_table";
// 元のテーブルの削除
$spl = "DROP TABLE $table_name;";
$set = $pdo->query($spl);

// 結果をチェック
if ($set) {
    print "$table_name テーブルを削除しました。<br>";
}else {
    print "$table_name テーブルを削除できませんでした。<br>";
}

// テーブル作成
$spl = "CREATE TABLE $table_name(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    img_name TEXT,
    mime_type TEXT,
    img_data MEDIUMBLOB
);";

$set = $pdo->query($spl);

if ($set) {
    print "$table_name テーブルを作成しました。<br>";
}else {
    print "$table_name テーブルを作成できませんでした。<br>";
}
////////////////////////////////////////////////////////////////////////////////////

// img_name作成
$table_name2 = "img_temp_table";
// 元のテーブルの削除
$spl = "DROP TABLE $table_name2;";
$set = $pdo->query($spl);

// 結果をチェック
if ($set) {
    print "$table_name2 テーブルを削除しました。<br>";
}else {
    print "$table_name2 テーブルを削除できませんでした。<br>";
}

// テーブル作成
$spl = "CREATE TABLE $table_name2(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    temp_img TEXT,
    order_id TEXT
);";

$set = $pdo->query($spl);

if ($set) {
    print "$table_name2 テーブルを作成しました。<br>";
}else {
    print "$table_name2 テーブルを作成できませんでした。<br>";
}

?>