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
    <?php
        include 'Database.php';
        if(isset($_POST['create'])){
            if(!empty($_POST['title']) && !empty($_POST['desc']) && !empty($_POST['cat']) && !empty($_POST['price']) && !empty($_FILES['image'])){
                if($_FILES['image']['size']<2500000 && strlen($_FILES['image']['name'])<=35){
                    $FT=["image/png","image/jpeg","image/jpg"];
                    $UFT=finfo_file(finfo_open(FILEINFO_MIME_TYPE),$_FILES['image']['tmp_name']);
                    if(in_array($UFT,$FT)){
                        if(!file_exists("./upload/" .$_FILES['image']['name'])){
                            if(move_uploaded_file($_FILES['image']['tmp_name'],"./upload/" .$_FILES['image']['name'])){
                                echo"Saved Successfully";
                            }else{
                                header("location:./errors&success.php?error=saving");
                                } 
                        }else{
                            echo "<br><p class='warning'>".$_FILES['image']['name']." already exists.</p>";
                        }
                    }
                }else{
                    echo"Max File Size: 3MB<br>";
                    echo"Max File Name: 50 Characters<br>";
                    echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
                }
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                $cat = $_POST['cat'];
                $price = $_POST['price'];
                $img = $_FILES['image']['name'];
                $sql = "INSERT INTO item (title, description, category, price, image) VALUES (?,?,?,?,?)";
                if($stmt = mysqli_prepare($conn, $sql)){ 
                    mysqli_stmt_bind_param($stmt, "sssss", $title, $desc, $cat, $price, $img); 
                    if(!mysqli_stmt_execute($stmt)){
                        $error = "Error executing query" . mysqli_error($conn);
                        die($error); //die if we cant execute statement
                    }else{
                        header("location:./errors&success.php?success=create");
                    }
                }        
            }   else{
                echo"<br><p class='warning'>One or more inputs are missing!</p>";
            }
        }
    ?>
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
                        <input type="text" name="title" class="field">
                    </div>
                    <div>
                        <label for='desc'>Product Description</label>
                        <input type="text" name="desc" class="field">
                    </div>
                    <div>
                        <label for='cat'>Category</label>
                        <input type="text" name="cat" class="field">
                    </div>
                    <div>
                        <label for='price'>Price</label>
                        <input type="text" name="price" class="field">
                    </div>
                    <div>
                        <img src/>
                        <label for='image'><span>Select Image</span><br>
                        <input type="file" name="image" class="field">
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
