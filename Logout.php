<?php
session_start();
session_destroy();
header("location:./errors&success.php?success=logout");
?>