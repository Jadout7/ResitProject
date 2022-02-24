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
            <div class="userInfo">
            <?php
            if($_SESSION['type'] == "admin"){
                echo "<p><a href='./additem.php'>Maintenance</a></p>";
            }else{
            echo "<p><a href='./login.php'>Login</a></p>";
            echo "<p><a href='./register.php'>Register</a></p>";
            }
            ?>
            </div>
        </nav>
    </div>
    
</header>