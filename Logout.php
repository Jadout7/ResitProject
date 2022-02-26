<?php
session_start();
session_destroy();
if(isset($_COOKIE['user_id']) && isset($_COOKIE['token'])) {
    $hour = time() - 5;
    setcookie('user_id', "", $hour);
    setcookie('token', "", $hour);
}
header("location:./errors&success.php?success=logout");
?>