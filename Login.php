<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Main.css" type="text/css">
        <?php
        include 'Database.php';
        ?>
    </head>
    <body>
      <?php
      include 'header.php';
      if(isset($_SESSION['sessionID'])) {
        header('location:./errors&success.php?error=login'); 
      }
      ?>
        <main>
          <div class="center">
            <div class="formBox">
                <div class="contentText">
                  <h1>Login</h1>
                </div>
                <div class="form">
                  <form method="post" action="">
                    <div>
                        <label for='email'>email</label>
                        <input type="text" name="email" class="field">
                    </div>
                    <div>
                        <label for='password'>Password</label>
                        <input type="password" name="password" class="field">
                    </div>
                    <div>
                        <input type="checkbox" name="RemMe" value="RemMe"> Remember Me
                    </div>
                    <div class='log'>
                        <input type="submit" name="login" value="Login">
                        <a href='Register.php'>Register</a>
                    </div>    
                  </form>
                </div>
            </div>
          </div>
        </main>
        <?php
          $error = NULL;
          if(isset($_POST['login'])){
            if(!empty($_POST['email']) && !empty($_POST['password'])){
              if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ //validate email
                $email = $_POST['email'];
                $sql = "SELECT 'user_id', firstname, lastname, password, user_type FROM user WHERE email = ?"; //query to insert into database
                if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
                  mysqli_stmt_bind_param($stmt, "s", $email); //need to bind values to parameters
                  if(mysqli_stmt_execute($stmt)){ //execute the statement
                    mysqli_stmt_bind_result($stmt, $id, $firstname, $lastname, $password, $type); //bind results
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) != 0){
                      header("location:./errors&success.php?success=login");
                        while(mysqli_stmt_fetch($stmt)){
                          if(password_verify($_POST['password'], $password)) { //verify password
                              $_SESSION['firstname'] = $firstname; //set session variables to use across pages
                              $_SESSION['lastname'] = $lastname;
                              $_SESSION['sessionID'] = $id;
                              $_SESSION['email'] = $email;
                              $_SESSION['user_type'] = $type;
                              if(isset($_POST['rememberLogin'])){
                                $sql = "UPDATE user set token = ? WHERE 'user_id' = ?";
                                if($stmt = mysqli_prepare($conn, $sql)){
                                  $token = time().$id;
                                  mysqli_stmt_bind_param($stmt, "ss", $token, $id);
                                    if(!mysqli_stmt_execute($stmt)){ //execute the statement
                                      $error = "Error executing query" . mysqli_error($conn);
                                      die();
                                    }else{
                                      $token = password_hash($token, PASSWORD_DEFAULT);
                                      $hour = time() + 3600 * 24 * 30;
                                      setcookie('user_id', $id, $hour);
                                      setcookie('token', $token, $hour);
                                    }
                                }
                              }
                          }else {
                              $error = "<br>&nbsp;&nbsp;Incorrect password!";
                          }
                        }
                    }else {
                      $error = "<br>&nbsp;&nbsp;Unregistered email!";
                    }
                  }else {
                      echo "<br>&nbsp;&nbsp;Error executing query";
                      die(mysqli_error($conn));
                  }
                }else{
                    die(mysqli_error($conn));
                }
              }else {
                  $error = "<br>&nbsp;&nbsp;Invalid email!";
              }
            }else {
                $error = "<br>&nbsp;&nbsp;Please fill in all the fields!";
            }
            if($error != NULL){ //echo error if the variable has been set
                 echo "<div class='warning'>".$error."</div>";
            }
          }
        ?>
    </body>
</html>
