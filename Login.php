<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Main.css" type="text/css">
    </head>
    <body>
        <?php
        include 'header.php';
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
                        <label id='Username'>Username</label>
                        <input type="text" name="Username" class="field">
                    </div>
                    <div>
                        <label id='password'>Password</label>
                        <input type="password" name="password" class="field">
                    </div>
                    <div class='log'>
                        <input type="submit" name="login" value="Login">
                        <a href='Register.php'>Register</a>
                    </div>    
                  </form>
                </div>
            </div>
          </div>
    </body>
</html>
