<?php
    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = 'uploads/'; // upload directory
    if($_FILES['imageUpload'])
    {
        $img = $_FILES['imageUpload']['name'];
        $tmp = $_FILES['imageUpload']['tmp_name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $preImageName =  sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        $final_image = $preImageName.$img;

        if(in_array($ext, $valid_extensions))
        {
            $path = $path.strtolower($final_image);
            $croppedImageData = $_POST['croppedImageData']; // Hidden input field

            if (!preg_match("/\d+\/\d+\/\d+\/\d+/", $croppedImageData))
            {
                echo 'Crop box is not valid!';
                return;
            }

            list($cx1, $cy1, $cx2, $cy2) = explode('/', $croppedImageData);

            $cw = (int)$cx2 - (int)$cx1;
            $ch = (int)$cy2 - (int)$cy1;

            if ($cw <= 0 || $ch <= 0)
            {
                echo 'Dimensions of crop are not valid!';
                return;
            }

            $image_p = imagecreatetruecolor($cw, $ch);
            $image = imagecreatefromjpeg($tmp);

            imagecopyresampled($image_p, $image, 0, 0, $cx1, $cy1, $cw, $ch, $cw, $ch);
            imagejpeg($image_p, $path, 100);

            echo "Uploaded!";
        }
        else
        {
            echo 'invalid';
        }
    }

