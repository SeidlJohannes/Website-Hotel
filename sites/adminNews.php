<?php
if(!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
//ini_set('display_errors','On'); //Zusatzeinstellung: Error wird ausgegeben

?>
<!DOCTYPE html>
<html lang="de">

<body class="centered-text">
    <!-- _____________________________FILE UPLOAD FORM_____________________________ -->
    <div>
        <h1>Erstelle einen Newsbeitrag!</h1>

        <form method="post" action="index.php?menu=adminNews" ; enctype="multipart/form-data">
            Wähle ein Thumbnail für deinen Beitrag:
            <input type="file" name="fileToUpload" required id="fileToUpload">
            <div class="topSpace">
                <h2>Schreibe hier deinen Newsbeitrag:</h2><br>
                <textarea maxlength="1000" placeholder="Schreibe hier deinen Newsbeitrag (max. 1000 Zeichen)" id="newsText" name="newsText" required rows="5" cols="60"></textarea>
            </div>
            <div class="topSpace">
                <input type="submit" value="Beitrag erstellen" name="submitFile">
            </div>
        </form>

    </div>

    <!-- _____________________________HANDLE FILE UPLOAD_____________________________ -->
    <div class="centered-text">
        <?php
        if(!empty($_POST["submitFile"])) {
            $imageName = $_FILES["fileToUpload"]["name"];
            $target_dir = dirname(__FILE__)."/../uploads/";
            $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - ".$check["mime"].". ";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image. ";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            /* Kinda useless because the original image is deleted so it cant check if it exists
            if(file_exists($target_file)) {
              echo "Sorry, file already exists. ";
              $uploadOk = 0;
            }*/

            // Check file size (not bigger than 1MB)
            if($_FILES["fileToUpload"]["size"] > 1000000) {
                echo "Sorry, your file is too large. ";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if(
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if($uploadOk == 0) {
                echo "Sorry, your file was not uploaded. ";
                // if everything is ok, try to upload file
            } else {
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { ?>

                    <div class=topSpace>
                        Dein Beitrag wurde soeben veröffentlicht! </div>
                    <?php
                    echo "Das Bild ".htmlspecialchars(basename($_FILES["fileToUpload"]["name"]))." wurde hochgeladen.";
                    //Picture Resizing
                    function fn_resize($image_resource_id, $width, $height) {
                        $target_width = 528;
                        $target_height = 264;
                        $target_layer = imagecreatetruecolor($target_width, $target_height);
                        imagecopyresampled($target_layer, $image_resource_id, 0, 0, 0, 0, $target_width, $target_height, $width, $height);
                        return $target_layer;
                    }

                    if(is_array($_FILES)) {
                        //echo $target_dir.$imageName;
                        $source_properties = getimagesize($target_dir.$imageName);
                        $image_type = $source_properties[2];
                        if($image_type == IMAGETYPE_JPEG) {
                            $original_image = imagecreatefromjpeg($target_dir.$imageName);
                            $target_layer = fn_resize($original_image, $source_properties[0], $source_properties[1]);
                            imagejpeg($target_layer, $target_dir."news_".$_FILES["fileToUpload"]["name"]);
                        } elseif($image_type == IMAGETYPE_GIF) {
                            $original_image = imagecreatefromgif($target_dir.$imageName);
                            $target_layer = fn_resize($original_image, $source_properties[0], $source_properties[1]);
                            imagegif($target_layer, $target_dir."news_".$_FILES["fileToUpload"]["name"]);
                        } elseif($image_type == IMAGETYPE_PNG) {
                            $original_image = imagecreatefrompng($target_dir.$imageName);
                            $target_layer = fn_resize($original_image, $source_properties[0], $source_properties[1]);
                            imagepng($target_layer, $target_dir."news_".$_FILES["fileToUpload"]["name"]);
                        }
                        unlink($target_dir.$imageName);
                    }

                } else {
                    echo "Sorry, there was an error uploading your file. ";
                }
            }
            /*<!-- _____________________________PUT EVERYTHING IN THE DATABASE_____________________________ -->*/

            $newsText = $_POST["newsText"];
            $news_imageName = "news_".$imageName;

            include __DIR__.'/../includes/dbaccess.php';
            $news_currentDateTime = date('Y-m-d');
            mysqli_query($con, "INSERT INTO `tbl_news` (`news_id`, `news_image`, `news_text`, `news_date`) 
            VALUES (NULL, '$news_imageName', '$newsText', '$news_currentDateTime')");

        }
        ?>

</body>

</html>