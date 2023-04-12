<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $target_dir = "../upload_temps/";
    $target_file = $target_dir . basename($_FILES["file_des"]["name"]);
    $target_file_upload = "../uploads/" . basename($_FILES["file_des"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    if (file_exists($target_file_upload)) {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "ERORR";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["file_des"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file_des"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }
}
?>