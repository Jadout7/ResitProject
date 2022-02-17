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
                    </div>
                    <?php
                    $error = NULL;
                    if (isset($_POST['register'])) {
                        if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) { //check if all fields are filled
                            if ($_POST['password'] == $_POST['confirmPassword']) { //check if the entered passwords are the same
                                if (strlen(trim($_POST['password'])) > 6) { //check if the password is longer than 6 char.
                                    $email = $_POST["email"];
                                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //validate the email format
                                        $sql = "SELECT email FROM user WHERE email = ?"; //query command to search if email already exists
                                        $result = $conn->query("SELECT email FROM user WHERE email = ?");
                                        if($result->num_rows == 0) {

                                        }else {
                                            $error = "Email already exists.";
                                        }
                                    } else {
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
                    }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>