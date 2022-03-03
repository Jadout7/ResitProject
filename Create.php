<!DOCTYPE html>
<html lang="en" dir="ltr">
<link href="Main.css" rel="stylesheet" type="text/css">
<title>Admin Page</title>
<?php
    include 'header.php'; 
    if(!isset($_SESSION['sessionID'])) {
      header("location:./errors&success.php?error=login");
    }
    if($_SESSION['user_type'] != 'administrator') {
      header("location:./errors&success.php?error=type");
    }
?>
</head>
<body>
    <main>
        <div class="center">
            <div class="formBox">
                <div class="contentText">
                    <h1>Add a new product!</h1>
                </div>
                <div class="form">
                    <form method="post" action=<?php echo $_SERVER['PHP_SELF'];?> enctype="multipart/form-data">
                    <div>
                        <label for='title'>Product Title</label>
                        <input type="text" name="title">
                    </div>
                    <div>
                        <label for='desc'>Product Description</label>
                        <input type="text" name="desc">
                    </div>
                    <div>
                        <label for='cat'>Category</label>
                        <input type="text" name="cat">
                    </div>
                    <div>
                        <label for='price'>Price</label>
                        <input type="text" name="price">
                    </div>
                    <div>
                        <img src/>
                        <label for='image'><span>Select Image</span><br>
                        <input type="file" name="image">
                        </label>
                    </div>
                    <div>
                        <label for="ageplus">Is this item 18+?</label>
                        <input type="radio" name="ageplus" value="Yes">&nbsp;Yes<br/>
                        <input type="radio" name="ageplus" value="No">&nbsp;Yes<br/>
                    </div>
                    <div class='log'>
                        <input type="submit" name="create" value="Create Product">
                    </div>
                    </form>
                    <?php
                        include 'Database.php';
                        if (isset($_POST['create'])){
                            if (!empty($_POST['title']) && !empty($_POST['desc']) && !empty($_POST['cat']) && !empty($_POST['price']) && !empty($_FILES['image'])){
                                if (strlen($price) > 4) {
                                    if ($_FILES['image']['size']<2500000) {
                                        if (strlen($_FILES['image']['name']) <= 35) {
                                            $FT = ["image/png", "image/jpeg", "image/jpg"];
                                            $UFT = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['image']['tmp_name']);
                                            if (in_array($UFT, $FT)) {
                                                $fileinfo = getimagesize($_FILES["image"]["tmp_name"]);
                                                $width = $fileinfo[0];
                                                $height = $fileinfo[1];
                                                if ($width < 500 && $height < 500) {
                                                    if (!file_exists("./upload/" . $_FILES['image']['name'])) {
                                                        if (move_uploaded_file($_FILES['image']['tmp_name'], "./upload/" . $_FILES['image']['name'])) {
                                                            $title = $_POST['title'];
                                                            $desc = $_POST['desc'];
                                                            $cat = $_POST['cat'];
                                                            $price = $_POST['price'];
                                                            $img = $_FILES['image']['name'];
                                                            $sql = "INSERT INTO item (title, description, category, price, image) VALUES (?,?,?,?,?)";
                                                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                                                mysqli_stmt_bind_param($stmt, "sssss", $title, $desc, $cat, $price, $img);
                                                                if (!mysqli_stmt_execute($stmt)) {
                                                                    echo "Error executing query" . mysqli_error($conn);
                                                                    die(); //die if we cant execute statement
                                                                }else {
                                                                    header("location:./errors&success.php?success=create");
                                                                }
                                                            }
                                                        }else {
                                                            header("location:./errors&success.php?error=formdata");
                                                        }
                                                    }else {
                                                        echo "<br><p class='warning'>" . $_FILES['image']['name'] . " already exists.</p>";
                                                    }
                                                }else {
                                                    header("location:./errors&success.php?error=dimensions");
                                                }
                                            }else {
                                                header("location:./errors&success.php?error=imagetype");
                                            }
                                        }else {
                                            header("location:./errors&success.php?error=filename");
                                        }
                                    }else {
                                        header("location:./errors&success.php?error=size");
                                    }
                                }else {
                                    header("location:./errors&success.php?error=price");
                                }
                                }
                            }else {
                                header("location:./errors&success.php?error=missingdata");
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
