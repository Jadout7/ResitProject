<!DOCTYPE html>
<html lang="en">
<head>
  <title>Webshop</title>
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
            echo "<br><p class='warning'>You do not have access to that page.</p>";
            }
            elseif($_GET['error'] == 'login') {
            echo "<br><p class='warning'>You are already logged in!</p>";
            }
            elseif($_GET['error'] == 'register') {
            echo "<br><p class='warning'>Please log out before registering another account.</p>";
            }
            elseif($_GET['error'] == 'formdata') {
            echo "<br><p class='warning'>Error occured, please try again!</p>";
            }
        }
        if(isset($_GET['success'])) {
            if($_GET['success'] == 'login') {
            echo "<br><p class='success'>You are now logged into the service!</p>";
            }
            elseif($_GET['success'] == 'logout') {
                echo "<p class='warning'>You are now logged out of the service.</p>";
              }
            elseif($_GET['success'] == 'ordered_item') {
            echo "<br><p class='success'>Item(s) ordered successfully!</p>";
            }
        }
        ?>
    </main>
</body>
</html>