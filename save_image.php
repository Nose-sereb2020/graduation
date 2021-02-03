<?php 
include_once "db/db_operation.php";
// print_r($_POST);
// print_r($_FILES);
$dir_name = "temp";
$dir_path = $dir_name . "/";

if(!file_exists($dir_name)){
    mkdir($dir_name);
}

if (isset($_FILES["images"]["error"])) {
    for ($i=0; $i < count($_FILES['images']['name']); $i++) { 
        $tmp_name = $_FILES["images"]["tmp_name"][$i];
        $name = $_FILES["images"]["name"][$i];
        // 拡張しチェック 
        $path_parts = pathinfo($name);
        if ($path_parts['extension'] == "jpg" ||
            $path_parts['extension'] == "JPG" ||
            $path_parts['extension'] == "png" ||
            $path_parts['extension'] == "PNG") {
            $time_text =  time() . "_" . rand(1000, 9999);
            $new_name = "img_" . $time_text . "." . $path_parts["extension"];

            // 添付画像を保存
            move_uploaded_file( $tmp_name, $dir_path . $new_name);            
        }

    // 画像ファイル読込
        $fp = fopen($dir_path . $new_name, "rb");
        $img_file = fread($fp, filesize($dir_path . $new_name));
        fclose($fp);


        $type = "";
        $mime_type_img = "";
        if ($path_parts['extension'] == "jpg" || $path_parts['extension'] == "JPG" || $path_parts['extension'] == "jpeg" || $path_parts['extension'] == "JEPG") {
            $type = "jpg";
            $mime_type_img = "data:images/jpeg;base64";
        }elseif ($path_parts['extension'] == "png" || $path_parts['extension'] == "PNG") {
            $type = "png";
            $mime_type_img = "data:images/png;base64";
        }
        

        $img_name = $name;
        $img_data = base64_encode($img_file);

        // // データ保存
        // $save_id = addPicture( $img_name,  $mime_type_img,  $img_data,  $mime_type_thumb,  $img_thumb,  $user_id,  $content_id,  $use_flag,  $kanri_flag);
        // print $save_id;

        // // 一時ファイル削除
        // unlink($dir_path . $new_name);
        // unlink($thumb_name);
    }
}
?>