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
                        <form method="post" action="">
                            <div>
                                <label id='Username'>Username</label>
                                <input type="text" name="Username">
                            </div>
                            <div>
                                <label id='password'>Password</label>
                                <input type="password" name="password">
                            </div>
                            <div class="log">
                                <input type="submit" name="register" value="Register" class="reg">
                                <a href='Login.php'>Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>