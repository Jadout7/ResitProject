<!DOCTYPE html>
<html lang="en">
<head>
  <title>Webshop</title>
  <link rel="stylesheet" href="Main.css" type="text/css">
</head>
<body>
    <?php
    include 'header.php';
    ?>
    <main>
        <div class="bigBox">
        <?php
        if(isset($_GET['error'])) {
            if($_GET['error'] == 'type') {
            echo "<br><p class='warning'>&nbsp;&nbsp;You do not have access to that page.</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
            elseif($_GET['error'] == 'login') {
            echo "<br><p class='warning'>&nbsp;&nbsp;You are already logged in!</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
            elseif($_GET['error'] == 'formdata') {
            echo "<br><p class='warning'>&nbsp;&nbsp;Error occured, please try again!</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
        }
        if(isset($_GET['success'])) {
            if($_GET['success'] == 'register') {
                echo "<br><p class='success'>&nbsp;&nbsp;Account has been successfully created!</p>";
                echo "<br><br><a href='./Login.php'><h3>&nbsp;&nbsp;Login</h3></a>";
                }
            elseif($_GET['success'] == 'login') {
            echo "<br><p class='success'>&nbsp;&nbsp;You are now logged in!</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
            elseif($_GET['success'] == 'logout') {
                echo "<br><p class='warning'>&nbsp;&nbsp;You are now logged out.</p>";
                echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
              }
            elseif($_GET['success'] == 'ordered_item') {
            echo "<br><p class='success'>&nbsp;&nbsp;Item(s) added to cart successfully!</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
            elseif($_GET['success'] == 'create') {
                echo "<br><p class='success'>&nbsp;&nbsp;Item created successfully!</p>";
                echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
                }
        }
        ?>
        </div>
    </main>
</body>
</html>