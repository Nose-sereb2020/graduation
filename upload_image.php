<?php 
include_once "db/db_operation.php";
$dir_name = "temp";
$dir_path = $dir_name . "/";
if(!file_exists($dir_name)){
    mkdir($dir_name);
}
$sql ="SELECT id FROM img_table WHERE id = (SELECT MAX(id) FROM img_table);";
$rst = $pdo->query($sql);
$last_id = 0;
if($row = $rst->fetch(PDO::FETCH_ASSOC)){
    $last_id = $row['id'];
}

$sql ="SELECT order_id FROM img_temp_table WHERE order_id = (SELECT MAX(order_id) FROM img_temp_table);";
$rst = $pdo->query($sql);
if($row = $rst->fetch(PDO::FETCH_ASSOC)){
    $last_order_id = $row['order_id'];
    if($last_order_id > $last_id){
        $last_id = $last_order_id;
    }
}
print "last_id  :  " . $last_id;
// print_r($_FILES['images']['error']);
if (isset($_FILES["images"]["error"])) {
    $image_card = "";
    for ($i=0; $i < count($_FILES['images']['name']); $i++) { 
        $last_id++;
        $tmp_name = $_FILES["images"]["tmp_name"][$i];
        $name = $_FILES["images"]["name"][$i];
        $path_parts = pathinfo($name);
        if ($path_parts['extension'] == "jpg" ||
            $path_parts['extension'] == "JPG" ||
            $path_parts['extension'] == "png" ||
            $path_parts['extension'] == "PNG") {
            $time_text =  time() . "_" . rand(1000, 9999);
            $new_name = "img_" . $time_text . "." . $path_parts["extension"];

            // 添付画像を保存
            move_uploaded_file( $tmp_name, $dir_path . $new_name);            
        }else{
            return;
        }
        
        addOrderData($dir_path . $new_name, $last_id);
        $image_card .="<div class='col-8 col-md-4 col-lg-3 mb-5 mt-4'>";
        $image_card .="<input type='checkbox' id='{$last_id}' name='images' style='display: none'>";
        $image_card .="<div class='card card-block' style='border:none'>";
        $image_card .="<label for='{$last_id}' is_url='true'>";
        $image_card .="<img src='{$dir_path}{$new_name}' alt='{$name}'";
        $image_card .="class='w-100 rounded'>";
        $image_card .="</label>";
        $image_card .="</div>";
        $image_card .="</div>";
    }

    $rst = getAll();

    // while ($row = $rst->fetch(PDO::FETCH_ASSOC)) { 
    //     $id = $row['id'];
    //     $img_data = $row['img_data'];
    //     $mime_type = $row['img_data'];
    //     $img_src = $mime_type . "," . $img_data;
    //     $image_card .="<div class='col-8 col-md-4 col-lg-3 mb-5 mt-4'>";
    //     $image_card .="<input type='checkbox' id='{$id}' name='images' style='display: none'>";
    //     $image_card .="<div class='card card-block' style='border:none'>";
    //     $image_card .="<label for='{$id}'>";
    //     $image_card .="<img src='{$img_src}'";
    //     $image_card .="class='w-100 rounded'>";
    //     $image_card .="</label>";
    //     $image_card .="</div>";
    //     $image_card .="</div>";
    // }
    // print_r($_POST);
    if (isset($_POST["id_list"]) && isset($_POST["is_url"])) {
        print_r($_POST["is_url"]);
        print_r($_POST["id_list"]);
        print "isset url id_list passed";
        for($i = 0; $i < count($_POST["is_url"]); $i++) { 
            print $i;
            if($_POST["is_url"][$i] == "true"){
                if($row = getTempDataById($_POST["id_list"][$i])->fetch(PDO::FETCH_ASSOC)){
                    print $row['temp_img'];
                    $image_card .="<div class='col-8 col-md-4 col-lg-3 mb-5 mt-4'>";
                    $image_card .="<input type='checkbox' id='{$row['order_id']}' name='images' style='display: none'>";
                    $image_card .="<div class='card card-block' style='border:none'>";
                    $image_card .="<label for='{$row['order_id']}' is_url='true'>";
                    $image_card .="<img src='{$row['temp_img']}' alt='{$row['temp_img']}'";
                    $image_card .="class='w-100 rounded'>";
                    $image_card .="</label>";
                    $image_card .="</div>";
                    $image_card .="</div>";
                }
            }else{
                if($row = getDataById($_POST["id_list"][$i])->fetch(PDO::FETCH_ASSOC)){
                    print "false";
                    $id = $row['id'];
                    $img_data = $row['img_data'];
                    $mime_type = $row['img_data'];
                    $img_src = $mime_type . "," . $img_data;
                    $image_card .="<div class='col-8 col-md-4 col-lg-3 mb-5 mt-4'>";
                    $image_card .="<input type='checkbox' id='{$id}' name='images' style='display: none'>";
                    $image_card .="<div class='card card-block' style='border:none'>";
                    $image_card .="<label for='{$id}'>";
                    $image_card .="<img src='{$img_src}'";
                    $image_card .="class='w-100 rounded'>";
                    $image_card .="</label>";
                    $image_card .="</div>";
                    $image_card .="</div>";
                }
            }
        }
    }

    print $image_card;
    return; 
}


?>