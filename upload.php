<?php
    include 'Database.php';
    include 'header.php';

    $uploadedFileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES["uploadedFile"]["tmp_name"]);
    $acceptedFileTypes = ["image/jpg", "image/jpeg", "image/png"];
    $fileinfo = getimagesize($_FILES["uploadedFile"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];

    if(in_array($uploadedFileType, $acceptedFileTypes)) {
        if ($_FILES["uploadedFile"]["error"] > 0) {
            echo "Something went wrong, try again";
        }elseif ($width > 600 && $height > 600) {
            echo "Image dimensions can't be larger than 600x600.";
        }elseif ($_FILES["uploadedFile"]["size"] > 20000000) {
            echo "Image size must not exceed 20MB.";
        }elseif (strlen($_FILES["uploadedFile"]["name"]) >= 35) {
            echo "File name must not be longer than 35 characters.";
        }elseif (file_exists("./resoruces/profileImages/" . $_FILES["uploadedFile"]["name"])){
            echo "File already exists.";
        }if(move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], "./resoruces/profileImages/". $_FILES["uploadedFile"]["name"])){
            $sql = "UPDATE `user` SET `profile_pic` = ? WHERE `user_id` = ?;";
            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "ss", $_FILES["uploadedFile"]["name"], $_SESSION['sessionID']);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_close($stmt); //close statement
                    mysqli_close($conn); //close connection
                    header("location:./Profile.php");
                }else{
                    echo "Error executing query: " . mysqli_error($conn);
                }
            }else{
                    echo "Error executing query: " . mysqli_error($conn);
                }
        }else{
            echo "Something went wrong, try again.";
        }
    }else{
        echo "Image type invalid.";
    }
?>
