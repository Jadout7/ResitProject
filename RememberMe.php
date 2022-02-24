<?php
include 'Database.php';

if(isset($_COOKIE['user_id']) && isset($_COOKIE['token'])){
  $sql = "SELECT user_id, token, firstname, lastname, user_type, email FROM user WHERE user_id = ?";
  if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
    mysqli_stmt_bind_param($stmt, "s", $_COOKIE['user_id']); //need to bind values to parameters
    if(mysqli_stmt_execute($stmt)){
      mysqli_stmt_bind_result($stmt, $user_id, $token, $firstname, $lastname, $type, $email); //bind results
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) != 0){
        while(mysqli_stmt_fetch($stmt)){
          if(password_verify($token, $_COOKIE['token'])){
            $_SESSION['firstname'] = $firstname; //set session variables to use across pages
            $_SESSION['lastname'] = $lastname;
            $_SESSION['sessionID'] = $id;
            $_SESSION['type'] = $type;
            $_SESSION['email'] = $email;
          }else {
            header("location:./logout.php");
          }
        }
      }
    }
  }
}

?>