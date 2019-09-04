<?php

    $valid_extensions = array ( IMAGETYPE_JPEG, IMAGETYPE_PNG ); // valid image types
    $path = 'uploads/'; // upload directory

    if ($_FILES['imageUpload'])
    {
        $img = $_FILES['imageUpload']['name'];
        $tmp = $_FILES['imageUpload']['tmp_name'];
        $type = exif_imagetype($_FILES['imageUpload']['tmp_name']);

        if (in_array($type, $valid_extensions))
        {
            $ext = strtolower(image_type_to_extension($type));
            $preImageName = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
            $final_image = $preImageName . $img;

            $path = $path . strtolower($final_image);
            $croppedImageData = $_POST['croppedImageData']; // Hidden input field

            if (!preg_match("/^\d+\/\d+\/\d+\/\d+$/", $croppedImageData))
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

            list($w, $h) = getimagesize($tmp);

            if ($w < $cw)
            {
                $cw = $w;
            }

            if ($h < $ch)
            {
                $ch = $h;
            }

            $imageTrueColor = imagecreatetruecolor($cw, $ch);

            if (IMAGETYPE_JPEG == $type)
            {
                $resampled = imagecreatefromjpeg($tmp);
            }
            else if (IMAGETYPE_PNG == $type)
            {
                $resampled = imagecreatefrompng($tmp);
            }

            imagecopyresampled($imageTrueColor, $resampled, 0, 0, $cx1, $cy1, $cw, $ch, $cw, $ch);

            if (IMAGETYPE_JPEG == $type)
            {
                imagejpeg($imageTrueColor, $path, 100);
            }
            else if (IMAGETYPE_PNG == $type)
            {
                imagepng($imageTrueColor, $path, 9);
            }

            echo "Uploaded!";
        }
        else
        {
            echo 'invalid';
        }
    }

