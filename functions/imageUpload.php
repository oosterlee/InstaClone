<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Check if image file is a actual image or fake image
if(isset($_POST["submitImageUpload"])) {
    $target_dir = "users/".$_SESSION["usr"]."/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $_FILES["fileToUpload"]["name"] = preg_replace('/.*\.(.*)/', generateRandomString(10)."_".generateRandomString(12).'.$1', $_FILES["fileToUpload"]["name"]);
    $filename = $_FILES["fileToUpload"]["name"];
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // var_dump($_FILES);
    // echo "uploading file....";
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > (15 * 1024 * 1024)) {
        // echo "Sorry, your file is too large. Maximum is: 15 MB";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $conn = SQL('instaclone');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = 'INSERT INTO `imagedata` (`date`, `imageName`, `username`, `description`) VALUES (CURRENT_TIMESTAMP(), (?), (?), (?))';

            // $stmt = createPrepare($conn, $query, 'sss', [$target_dir.$filename, $_SESSION["usr"], $_POST["imageDescription"]]);
            $imgName = $target_dir.$filename;
            $usr = $_SESSION["usr"];
            $desc = $_POST["imageDescription"];
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sss', $imgName, $usr, $desc);

            $stmt->execute();

            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            // echo "Sorry, there was an error uploading your file.";
        }
    }

}
?>
