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
                    <div class='log'>
                        <input type="submit" name="login" value="Login">
                        <a href='Register.php'>Register</a>
                    </div>
                  </form>
                    <?php
                    $error = NULL;
                    if(isset($_POST['login'])){
                        if(!empty($_POST['email']) && !empty($_POST['password'])){
                            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ //filters variable w email and validates it
                                $email = $_POST['email'];
                                $sql = "SELECT 'user_id', firstname, lastname, password, user_type FROM user WHERE email = ?";
                                if($stmt = mysqli_prepare($conn, $sql)){ //database compiles and performs query optimization and stores w/o executing
                                    mysqli_stmt_bind_param($stmt, "s", $email); //need to bind $email to parameters/? in the sql statement
                                    if(mysqli_stmt_execute($stmt)){
                                        mysqli_stmt_bind_result($stmt, $id, $firstname, $lastname, $password, $type);
                                        mysqli_stmt_store_result($stmt);
                                        if(mysqli_stmt_num_rows($stmt) != 0){
                                            while(mysqli_stmt_fetch($stmt)){
                                                if(password_verify($_POST['password'], $password)) { //verify password
                                                    $_SESSION['firstname'] = $firstname; //setting session variables
                                                    $_SESSION['lastname'] = $lastname;
                                                    $_SESSION['sessionID'] = $id;
                                                    $_SESSION['email'] = $email;
                                                    $_SESSION['user_type'] = $type;
                                                    header("location:./errors&success.php?success=login");
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
                </div>
            </div>
          </div>
        </main>
    </body>
</html>
