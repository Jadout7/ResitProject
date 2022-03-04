<?php
session_start();
include 'Database.php';
if (isset($_COOKIE['user_id'])) {
    $sql = "SELECT user_id, firstname, lastname, user_type, email FROM user WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) { //database parses, compiles, and performs query optimization and stores w/o executing
        mysqli_stmt_bind_param($stmt, "s", $_COOKIE['user_id']); //need to bind values to parameters
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $id, $firstname, $lastname, $type, $email); //bind results
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) != 0) {
                while (mysqli_stmt_fetch($stmt)) {
                    $_SESSION['firstname'] = $firstname; //set session variables to use across pages
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['sessionID'] = $id;
                    $_SESSION['user_id'] = $userid;
                    $_SESSION['user_type'] = $type;
                    $_SESSION['email'] = $email;
                }
            } else {
                header('location:./Logout.php');
            }
        }
    }
}