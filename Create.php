<!DOCTYPE html>
<html lang="en" dir="ltr">
<link href="Main.css" rel="stylesheet" type="text/css">
<title>Admin Page</title>
</head>
<body>
    <?php
    include 'header.php'; 
    if(!isset($_SESSION['sessionID'])) {
      header("location:./errors&success.php?error=login");
    }
    if($_SESSION['user_type'] != 'administrator') {
      header("location:./errors&success.php?error=type");
    }
    ?>
    <?php
        include 'Database.php';
        if(isset($_POST['create'])){
            if(!empty($_POST['Ptitle']) && !empty($_POST['Pdesc']) && !empty($_POST['Pcat']) && !empty($_POST['Pprice']) && !empty($_POST['Pimage'])){
                $_title = $_POST['Ptitle'];
                $_desc = $_POST['Pdesc'];
                $_cat = $_POST['Pcat'];
                $_price = $_POST['Pprice'];
                $_img = $_POST['Pimage'];
                $sql = "INSERT INTO item (title, description, category, price, image) VALUES (?,?,?,?,?)";
                if($stmt = mysqli_prepare($conn, $sql)){ 
                    mysqli_stmt_bind_param($stmt, "sssss", $_title, $_desc, $_cat, $_price, $_img); 
                    if(!mysqli_stmt_execute($stmt)){
                        $error = "Error executing query" . mysqli_error($conn);
                        die($error); //die if we cant execute statement
                    }else{
                        header("location:./errors&success.php?success=create");
                    }
                }
            }else{
                echo"One or more inputs are missing!";
            }
        }
    ?>
        <main>
            <div class="center">
                <div class="formBox">
                    <div class="contentText">
                    <h1>Add a new product!</h1>
                    </div>
                    <div class="form" action=<?php echo $_SERVER['PHP_SELF'];?> enctype="multipart/form-data">
                        <form method="post">
                        <div>
                            <label for='Ptitle'>Product Title</label>
                            <input type="text" name="Ptitle" class="field">
                        </div>
                        <div>
                            <label for='Pdesc'>Product Description</label>
                            <input type="text" name="Pdesc" class="field">
                        </div>
                        <div>
                            <label for='Pcat'>Category</label>
                            <input type="text" name="Pcat" class="field">
                        </div>
                        <div>
                            <label for='Pprice'>Price</label>
                            <input type="text" name="Pprice" class="field">
                        </div>
                        <div>
                        <img src/>
                        <label for='Pimage'><span>Select Image</span><br>
                            <input type="file" name="Pimage" class="field">
                        </label>
                        </div>
                        <div class='log'>
                            <input type="submit" name="create" value="Create Product">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
