<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Croper</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="croppie.css"/>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="croppie.min.js"></script>
    <script src="crop_handler.js"></script>

</head>
<body>

<div class="container " style="margin-top: 50px;">
    <div class="row">
        <div class="col-6">
            <h3>Example form</h3>
            <hr>
            <form id="form">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter full name">
                </div>
                <div class="form-group">
                    <label for="imageUpload">Example file input</label>
                    <input type="file" class="form-control-file" id="imageUpload" name="imageUpload">
                </div>
                <input type="hidden" class="form-control-file" id="croppedImageData" name="croppedImageData">
                <hr>
                <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                <button type="button" class="btn btn-light">Cancel</button>
            </form>
        </div>
        <div class="col-6">
            <?php
                $dir = 'uploads';
                $files = scandir($dir, 1);

                foreach ($files as $f)
                {
                    if ($f[0] != '.') // OS files ignore them
                    {
                        echo '<img style="width: 300px; padding-bottom: 10px;" src="uploads/' . $f . '" />';
                    }
                } ?>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="imagePreviewModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Photo</h4>
            </div>
            <div class="modal-body">
                <h6>Pick Photo and frame it: :</h6>

                <img class="crop_image_preview" src=""/>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-success" data-dismiss="modal">Confirm crop</a>
            </div>
        </div>
    </div>
</div>
<div id="preview" class="container"></div>

<script>
    $(function () {
        initImageCrop(
            $('#imagePreviewModal'),
            $('#imageUpload'),
            $('#croppedImageData'),
            {width: 400, height: 400},
            {width: 480, height: 480}
        )
    });
    $(document).ready(function (e) {
        $("#form").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "FormTypeCroppie.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data === 'invalid') {
                        console.log(data);
                    } else {
                        $("#form")[0].reset();
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }));
    });


</script>

</body>
</html>