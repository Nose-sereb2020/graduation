<?php 
include_once 'head.php';
include_once "db/db_operation.php";

$dir_name = "temp";
$dir_path = $dir_name . "/";
if(!file_exists($dir_name)){
    mkdir($dir_name);
}

$image_card = "";

$rst = getAll();

while ($row = $rst->fetch(PDO::FETCH_ASSOC)) { 
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

?>

<?php print makeHeader('photo_gallery'); ?>
<link href='custom.css' rel='stylesheet' />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h3>Photo Gallery</h3>
            </div>
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header" id="mode">
                        Edit mode
                    </div>
                    <div class="card-body">
                        <div class="row flex-row flex-nowrap overflow-auto" id="sortable" style="">
                            <?php print $image_card; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="d-flex col-md-5 mx-auto justify-content-around">
                                <button class="btn btn-info edit_mode" id="upload_btn">UPLOAD</button>
                                <input type="file" multiple id="upload_images" name="images" style="display: none">
                                <button class="btn btn-secondary edit_mode" id="save_btn">SAVE</button>
                                <button class="btn btn-danger edit_mode" id="delete_mode_btn">DELETE MODE</button>
                                <button class="delete_mode btn btn-danger" id="delete_btn"
                                    style="display:none">DELETE</button>
                                <button class="delete_mode btn btn-secondary" id="return_btn"
                                    style="display:none">RETURN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php print makeFooter('NOSE.Co.Ltd'); ?>
        <script>
        var delete_id_list = [];

        $('#sortable').sortable({
            // update: function(ev, ui) {
            //     var updateArray = $(this).sortable("toArray").join(",");
            //     console.log(updateArray);

            //     document.body.style.cursor = "wait";

            //     // Formdata オブジェクトを用意
            //     var fd = new FormData();


            //     fd.append("change_num", updateArray);

            //     $.ajax({
            //         url: "",
            //         type: "POST",
            //         data: fd,
            //         mode: "multiple",
            //         processData: false,
            //         contentType: false,
            //         timeout: 10000,
            //         error: function(XMLHttpRequest, textStatus, errorThrown) {
            //             err =
            //                 XMLHttpRequest.status +
            //                 "\n" +
            //                 XMLHttpRequest.statusText;
            //             alert(err);
            //             document.body.style.cursor = "auto";
            //         },
            //         beforeSend: function(xhr) {},
            //     }).done(function(res) {
            //         document.body.style.cursor = "auto";
            //         console.log(res);
            //     });
            // }
        });

        $('#sortable').disableSelection();

        $('#upload_btn').on('click', function(e) {
            $('#upload_images').trigger('click');
        })

        $('#upload_images').on("change", function(e) {
            up_images = e.originalEvent.target.files;

            document.body.style.cursor = "wait";

            // Formdata オブジェクトを用意
            var fd = new FormData();
            // console.log(up_images)
            for (i = 0; i < up_images.length; i++) {
                fd.append('images[]', up_images[i]);
            }

            $(document).ready($('label').each(function() {
                // console.log($(this).attr("for"));
                fd.append('id_list[]', $(this).attr("for"));
                if($(this).attr("is_url") == "true"){

                    fd.append('is_url[]', "true");
                }else(
                    fd.append('is_url[]', "false")
                )
            }));

            console.log(fd);


            $.ajax({
                url: "upload_image.php",
                type: "POST",
                data: fd,
                mode: "multiple",
                processData: false,
                contentType: false,
                timeout: 10000,
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    err =
                        XMLHttpRequest.status +
                        "\n" +
                        XMLHttpRequest.statusText;
                    alert(err);
                    document.body.style.cursor = "auto";
                },
                beforeSend: function(xhr) {},
            }).done(function(res) {
                document.body.style.cursor = "auto";
                $('#sortable').html(res);
                console.log(res);
            });
        });

        // up_images = e.originalEvent.target.files;

        // document.body.style.cursor = "wait";

        // // Formdata オブジェクトを用意
        // var fd = new FormData();
        // console.log(up_images)
        // for (i = 0; i < up_images.length; i++) {
        //     fd.append('images[]', up_images[i]);
        // }

        // $.ajax({
        //     url: "save_image.php",
        //     type: "POST",
        //     data: fd,
        //     mode: "multiple",
        //     processData: false,
        //     contentType: false,
        //     timeout: 10000,
        //     error: function(XMLHttpRequest, textStatus, errorThrown) {
        //         err =
        //             XMLHttpRequest.status +
        //             "\n" +
        //             XMLHttpRequest.statusText;
        //         alert(err);
        //         document.body.style.cursor = "auto";
        //     },
        //     beforeSend: function(xhr) {},
        // }).done(function(res) {
        //     document.body.style.cursor = "auto";
        //     console.log(res);
        // });

        $('#delete_mode_btn').on('click', function(e) {
            delete_id_list = [];
            $('input[name="images"]').prop("checked", false);
            $('#mode').html("Delete mode");
            $('.edit_mode').css("display", "none");
            $('.delete_mode').css("display", "");
            $('img').css("filter", "brightness(40%)");
            $('img').on('click', function(e) {
                if ($(this).hasClass("rounded")) {
                    $(this).removeClass("rounded");
                    $(this).addClass("rounded-circle");
                } else {
                    $(this).removeClass("rounded-circle");
                    $(this).addClass("rounded");
                }
            });
        })

        $('#delete_btn').on('click', function(e) {
            $('img').off();
            $('img').removeClass("rounded-circle");
            $('img').addClass("rounded");
            $('#mode').html("Edit mode");
            $('img').css("filter", "");
            $('.edit_mode').css("display", "");
            $('.delete_mode').css("display", "none");


            $('input[name="images"]:checked').each(function() {
                delete_id_list.push($(this).attr("id"));
            });

            console.log(delete_id_list);
            for (i = 0; i < delete_id_list.length; i++) {
                $('#' + delete_id_list[i]).parent().remove();
                console.log(delete_id_list[i]);
            }
        });

        $('#return_btn').on('click', function(e) {
            $('img').off();
            $('img').addClass("rounded");
            $('img').removeClass("rounded-circle");
            $('#mode').html("Edit mode");
            $('img').css("filter", "");
            $('.edit_mode').css("display", "");
            $('.delete_mode').css("display", "none");
        });
        </script>
</body>

</html>