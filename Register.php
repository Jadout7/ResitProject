<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Main.css" type="text/css">
    </head>
    <body>
        <?php
        include 'header.php';
        include 'Database.php';
        ?>
        <main>
            <div class="register">
                <div class="registerCenter">
                    <div class="registerForm">
                        <h1>Register</h1>
                        <form method="post" autocomplete="off">
                            <div>
                                <label for='firstName'>First name</label>
                                <input type="text" name="firstName">
                            </div>
                            <div>
                                <label for='lastName'>Last name</label>
                                <input type="text" name="lastName">
                            </div>
                            <div>
                                <label for='email'>Email</label>
                                <input type="text" name="email">
                            </div>
                            <div>
                                <label for='password'>Password</label>
                                <input type="password" name="password">
                            </div>
                            <div>
                                <label for='confirmPassword'>Confirm Password</label>
                                <input type="password" name="confirmPassword">
                            </div>
                            <div>
                                <label for="age">Are you over 18 years old?</label><br>
                                <input type="radio" name="age" value="ofAge">&nbsp;Yes, I'm over 18.<br/>
                                <input type="radio" name="age" value="notOfAge">&nbsp;No, I'm under 18.<br/>
                            </div>
                            <div class="log">
                                <input type="submit" name="register" value="Create account" class="reg">
                                <a href='Login.php'>Login</a>
                            </div>
                        </form>
                        <div>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "webshop");
                            $error = NULL;
                            if (isset($_POST['register'])) {
                                if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) { //check if all fields are filled
                                    if ($_POST['password'] == $_POST['confirmPassword']) { //check if the entered passwords are the same
                                        if (strlen(trim($_POST['password'])) > 6) { //check if the password is longer than 6 char.
                                            $email = $_POST["email"];
                                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //validate the email format
                                                $sql = "SELECT email FROM user WHERE email = ?"; //query command to search if email already exists
                                                if($stmt = mysqli_prepare($conn, $sql)) {
                                                    mysqli_stmt_bind_param($stmt, "s", $_POST['email']);
                                                    if (mysqli_stmt_execute($stmt)) {
                                                        mysqli_stmt_store_result($stmt);
                                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                                            $emailHandle = substr(($email), strpos(($email), "@") + 1); //get the email handle
                                                            if (str_contains($emailHandle, 'administrator')) {
                                                                $type = "administrator";
                                                            } elseif (str_contains($emailHandle, 'orderpicker')) {
                                                                $type = "orderpicker";
                                                            } else {
                                                                $type = "customer";
                                                            }
                                                            if (($_POST['age']) == 'ofAge') {
                                                                $ofage = "1";
                                                            } else {
                                                                $ofage = "0";
                                                            }
                                                            $firstName = $_POST['firstName'];
                                                            $lastName = $_POST['lastName'];
                                                            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //hash password
                                                            $token = hash('sha256', time() . $email);
                                                            $sql = "INSERT INTO user (firstname, lastname, email, password, user_type, ofage) VALUES (?,?,?,?,?,?)"; //the query for inserting into the database
                                                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                                                mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $email, $password, $type, $ofage); //bind values to parameters
                                                                if (mysqli_stmt_execute($stmt)) {
                                                                    header("location:./errors&success.php?success=register");
                                                                    mysqli_stmt_close($stmt); //close statement
                                                                    mysqli_close($conn); //close connection
                                                                } else {
                                                                    $error = "Error: " . mysqli_error($conn);
                                                                    die(); //die if we cant execute statement
                                                                }
                                                            } else {
                                                                $error = "Error: " . mysqli_error($conn);
                                                                die(); //die if statement can't be prepared
                                                            }
                                                        } else {
                                                            $error = "Email already exists.";
                                                        }
                                                    } else {
                                                        $error = "Error executing query" . mysqli_error($conn);
                                                        die();
                                                    }
                                                }else {
                                                    $error = "Error executing query" . mysqli_error($conn);
                                                    die();
                                                }
                                            }else {
                                                $error = "Invalid email.";
                                            }
                                        }else {
                                            $error = "Password must be longer than 6 characters!";
                                        }
                                    }else{
                                        $error = "Passwords don't match!";
                                    }
                                }else{
                                    $error = "Please fill in all fields!";
                                }
                                if($error != NULL){ //echo error if the variable has been set
                                    echo $error;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>