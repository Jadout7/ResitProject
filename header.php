<link rel="stylesheet" href="Main.css" type="text/css">
<header>
    <?php
        session_start();
        require_once 'RememberMe.php'
    ?>
    <div class="head">
        <nav>
            <div class="head_left">
                <ul>
                <li><a href="Main.php"><h3><b>NHL WEBSHOP</b></h3></a></li>
                </ul>
            </div>
            <div class="head_center">
                <ul>
                <li><textarea name="textarea" id="textarea" placeholder="Zoeken"></textarea></li>
                </ul>
            </div>
            <div class="head_right1">
                <ul>
                    <?php 
                    if($_GET['error'] == 'login'){
                        echo "<li><a href='./Cart.php'><h3>Your Cart</h3></a></li>";
                        if ($_SERVER['PHP_SELF'] != "/Cart.php") {
                            header("location: ./Cart.php");
                        }
                        echo "<li><a href='History.php'><h3>Order History</h3></a></li>";
                        if ($_SERVER['PHP_SELF'] != "/History.php") {
                            header("location: ./History.php");
                        }
                    }
                    ?>
                <li><a href="Login.php"><h3>Login</h3></a></li>
                <li><a href="Register.php"><h3>Register</h3></a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
