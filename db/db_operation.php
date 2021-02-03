<?php 
include_once "db_connect.php";
mb_language("Japanese");
mb_internal_encoding('UTF-8');
date_default_timezone_set('Asia/Tokyo');

$tempStr1 = "dsfadffdsa";
$tempStr2 = "dsfadff";

// 暗号化パスワード生成
function makePassword($passwd){
    global $tempStr1, $tempStr2;
    $pass = hash("sha256", $passwd);
    $passw = $tempStr1 . $pass . $tempStr2;
    return hash("sha256", $passw);
}

// ハッシュコード生成
function makeHash($base){
    global $tempStr1, $tempStr2;
    $pass = $base .time();
    $password = hash("sha256", $pass);
    $passw = $tempStr2 . $password . $tempStr1;
    return hash("sha256", $passw);
}


//プロファイルマスタ（データ追加）
function addData( $name, $furigana, $sex, $birth_day, $postal_code, $address, $tel, $mail_address, $description, $img_data, $mime_content_type){
    global $pdo;
    $sql = "INSERT INTO profile_table(name, furigana, sex, birth_day, postal_code, address, tel, mail_address, description, img_data, mime_content_type)
        VALUES('$name', '$furigana', '$sex', '$birth_day', '$postal_code', '$address', '$tel', '$mail_address', '$description', '$img_data', '$mime_content_type');";
    $pdo->query($sql);
    // return $pdo->lastINsertId('id');
    return $sql;

}

function addOrderData( $temp_img, $order_id){
    global $pdo;
    $sql = "INSERT INTO img_temp_table(temp_img, order_id)
        VALUES('$temp_img', '$order_id');";
    $pdo->query($sql);
    // return $pdo->lastINsertId('id');
    return $sql;

}

function getAll(){
    global $pdo;
    $sql = "SELECT  id,  img_name, mime_type, img_data FROM img_table;";
    return $pdo->query($sql);
}

function getDataById($u_id){
    global $pdo;
    $sql = "SELECT id,  img_name, mime_type, img_data FROM img_table WHERE id=$u_id;";
    return $pdo->query($sql);
}

function getTempDataById($u_id){
    global $pdo;
    $sql = "SELECT temp_img, order_id FROM img_temp_table WHERE id=$u_id;";
    return $pdo->query($sql);
}

function changeData($id, $name, $furigana, $sex, $birth_day, $postal_code, $address, $tel, $mail_address, $description, $img_data, $mime_content_type){
    global $pdo;
    $sql = "UPDATE profile_table SET
    name = '$name',
    furigana = '$furigana',
    sex = '$sex',
    birth_day = '$birth_day',
    postal_code = '$postal_code',
    address = '$address',
    tel = '$tel',
    mail_address = '$mail_address',
    description = '$description',
    img_data = '$img_data',
    mime_content_type = '$mime_content_type' WHERE id = $id;";
    $pdo->query($sql);
    return $sql;
}

// ディレクトリごと削除するファンクション 引数 パス+ディレクトリ名
function remove_dir($dir){
    if (!is_dir($dir)) {
        return;
    }
    if ($handle = opendir("$dir")) {
        while(false !== ($item = readdir($handle))){
            if ($item != "." && $item != "..") {
                if(is_dir("$dir/$item")){
                    remove_dir("$dir/$item");
                }else {
                    unlink("$dir/$item");
                    // echo " removing $dir/$item<br>\n";
                }
            }
        }
        closedir($handle);
        rmdir($dir);
        // echo " removing $dir<br>\n";
    }
}

// 日付けから曜日を取得するファンクション 引数は日付け、（2019-1-1 または 2019/01/01、date("Y-m-d")等)
function getWeek($day){
    $week_str_list = array("日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日",);
    $date = new DateTime($day);
    $week = $week_str_list[$date->format('w')];
    return $week;
}

function getWeek2($day){
    $week_str_list = array("(日)", "(月)", "(火)", "(水)", "(木)", "(金)", "(土)",);
    $date = new DateTime($day);
    $week = $week_str_list[$date->format('w')];
    return $week;
}
?>