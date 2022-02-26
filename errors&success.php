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
            elseif($_GET['error'] == 'register') {
            echo "<br><p class='warning'>&nbsp;&nbsp;Please log out before registering another account.</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
            elseif($_GET['error'] == 'formdata') {
            echo "<br><p class='warning'>&nbsp;&nbsp;Error occured, please try again!</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
        }
        if(isset($_GET['success'])) {
            if($_GET['success'] == 'login') {
            echo "<br><p class='success'>&nbsp;&nbsp;You are now logged into the service!</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
            elseif($_GET['success'] == 'logout') {
                echo "<br><p class='warning'>&nbsp;&nbsp;You are now logged out of the service.</p>";
                echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
              }
            elseif($_GET['success'] == 'ordered_item') {
            echo "<br><p class='success'>&nbsp;&nbsp;Item(s) ordered successfully!</p>";
            echo "<br><br><a href='./Main.php'><h3>&nbsp;&nbsp;Home</h3></a>";
            }
        }
        ?>
    </main>
</body>
</html>