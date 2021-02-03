<?php
include_once 'head.php';

if (isset($_GET['image'])) {
    $image = $_GET['image'];

    if (isset($_GET['w'])) {
        $w = $_GET['w'];
    }else {
        $w = 3;
    }
    if (isset($_GET['h'])) {
        $h = $_GET['h'];
    }else {
        $h = 2;
    }
}else{
    exit("パラメーターエラー");
}

if (isset($_POST['id'])) {
    print_r($_FILES);
    print_r($_POST);
    if (isset($_FILES['imagefile']['error'])) {
        
        $image_name = explode("?", $_FILES['imagefile']['name']);
        $tmp_name = $_FILES['imagefile']['tmp_name'];
        move_uploaded_file($tmp_name, $_POST['path'] . $image_name[0]);
        print "save " . $_POST['path'] . $image_name[0];
        return;
    }else {
        print "no file";
        return;
    }


    // if (isset($_FILES['imagefile']['error'])) {
    //     # code...
    // }
}

?>

<?php print makeHeader("ページタイトル"); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    crossorigin="anonymous">
<link rel="stylesheet" href="cropper/docs/css/cropper.css">
<link rel="stylesheet" href="cropper/docs/css/main.css">
<script src="cropper/docs/js/cropper.js"></script>
<script src="cropper/docs/js/main.js"></script>

</head>

<body>
    <!-- Content -->
    <div class="container">
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h3 class="text-center">画像トリミング</h3>
                    <p class="text-center"><button id="return_btn" class="btn btn-secondary ">戻る</button></p>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <!-- <h3>Demo:</h3> -->
                <div class="img-container">
                    <img id="image" src="<?php print $master_image; ?>" alt="Picture">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 docs-buttons">
                <!-- <h3>Toolbar:</h3> -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move"
                        title="Move">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                            <span class="fa fa-arrows-alt"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop"
                        title="Crop">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                            <span class="fa fa-crop-alt"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;zoom&quot;, 0.1)">
                            <span class="fa fa-search-plus"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                        title="Zoom Out">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;zoom&quot;, -0.1)">
                            <span class="fa fa-search-minus"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="move" data-option="-10"
                        data-second-option="0" title="Move Left">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;move&quot;, -10, 0)">
                            <span class="fa fa-arrow-left"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="10"
                        data-second-option="0" title="Move Right">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;move&quot;, 10, 0)">
                            <span class="fa fa-arrow-right"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                        data-second-option="-10" title="Move Up">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;move&quot;, 0, -10)">
                            <span class="fa fa-arrow-up"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                        data-second-option="10" title="Move Down">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;move&quot;, 0, 10)">
                            <span class="fa fa-arrow-down"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45"
                        title="Rotate Left">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;rotate&quot;, -45)">
                            <span class="fa fa-undo-alt"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="45"
                        title="Rotate Right">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;rotate&quot;, 45)">
                            <span class="fa fa-redo-alt"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1"
                        title="Flip Horizontal">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;scaleX&quot;, -1)">
                            <span class="fa fa-arrows-alt-h"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1"
                        title="Flip Vertical">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;scaleY&quot;, -1)">
                            <span class="fa fa-arrows-alt-v"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;crop&quot;)">
                            <span class="fa fa-check"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;clear&quot;)">
                            <span class="fa fa-times"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;disable&quot;)">
                            <span class="fa fa-lock"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;enable&quot;)">
                            <span class="fa fa-unlock"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;reset&quot;)">
                            <span class="fa fa-sync-alt"></span>
                        </span>
                    </button>
                    <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage" name="file"
                            accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="Import image with Blob URLs">
                            <span class="fa fa-upload"></span>
                        </span>
                    </label>
                    <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;destroy&quot;)">
                            <span class="fa fa-power-off"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group btn-group-crop">
                    <button type="button" class="btn btn-success" data-method="getCroppedCanvas"
                        data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                            title="$().cropper(&quot;getCroppedCanvas&quot;, { maxWidth: 4096, maxHeight: 4096 })">トリミング
                        </span>
                    </button>
                </div>


                <!-- Show the cropped image in modal -->
                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true"
                    aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="getCroppedCanvasTitle">トリミング</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                <a class="btn btn-primary" id="save-image" href="javascript:void(0);"
                                    download="cropped.jpg" data-dismiss="modal">保存</a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->
            </div><!-- /.docs-buttons -->
        </div>
    </div>
    </div <?php print makeFooter("NPO-PC");?> <script>
    var w = <?php print $w; ?>;
    var h = <?php print $h; ?>;
    $('#image').cropper({
    aspectRatio: w / h
    });
    $('#return_btn').on('click', function(e) {
    location.replace("image_list.php")
    })

    function saveImage(dataURI){
    console.log("save");
    // console.log(dataURI);
    var src_file = $('#image').attr('src');
    console.log(src_file);
    // console.log(pathinfo(src_file));
    var dir_path = src_file.split("/").reverse().slice(2).reverse().join("/") + "/";
    var src_array = src_file.split("/")
    var file_array = src_array[src_array.length - 1] . split("?");

    console.log(src_array);
    console.log(dir_path);
    console.log(file_array);

    // Formdata オブジェクトを用意
    var fd = new FormData();
    fd.append("path", dir_path);
    fd.append("id", 1);
    fd.append("imagefile", dataURIConverter(dataURI, file_array[0]));

    $.ajax({
    // url: "",
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
    console.log(res);
    location.replace("image_list.php");
    });


    }

    function dataURIConverter(dataURI, fname){
    var byteString=atob(dataURI.split(',')[1]);


    var mimeType = dataURI.split(',')[0].split(':')[1].split(';')[0];

    var buffer = new Uint8Array(byteString.length);
    for (let i = 0; i
    < byteString.length; i++) { buffer[i]=byteString.charCodeAt(i); } return new File([buffer], fname, {type:mimeType});
        } </script>
</body>

</html>