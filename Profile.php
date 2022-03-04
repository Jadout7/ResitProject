<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Main.css" type="text/css">
        <title>Profile</title>
    </head>
    <body>
        <?php
        include 'header.php';
        include 'Database.php';
        if(!isset($_SESSION['sessionID'])) {
            header("location:./errors&success.php?error=login");
        }

        $query = "SELECT profile_pic FROM user WHERE user_id = ? AND profile_pic IS NOT NULL";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['sessionID']);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $profilePicture);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    while ($stmt->fetch()) {}
                }else {
                    $profilePicture = "profile-default.jpg";
                }
            }else {
                echo "Error executing query: " . mysqli_error($conn);
            }
        }
        ?>
        <h1>Hello <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "!"; ?></h1>
        <img src="./resoruces/profileImages/<?=$profilePicture?>" alt="Profile picture">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="uploadedFile" id="file" class="profileButton">
            <div><button type="submit" name="submit" value="submit" class="profileButton">Upload Profile Picture</button></div>
        </form>

    </body>
</html>