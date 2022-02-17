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
                            <div class="log">
                                <input type="submit" name="register" value="Create account" class="reg">
                                <a href='Login.php'>Login</a>
                            </div>
                        </form>
                    </div>
                    <?php
                    $error = NULL;
                    if (isset($_POST['register'])) {
                        if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) { //check if all fields have been filled
                            if ($_POST['password'] == $_POST['confirmPassword']) {

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