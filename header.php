<link rel="stylesheet" href="Main.css" type="text/css">
<header>
    <?php
    require_once 'Remember.php'
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
                    if(isset($_SESSION['user_type'])) {
                        if($_SESSION['user_type'] == 'administrator') {
                            echo "<li><a href='./Create.php'><h3>Add Product</h3></a></li>";
                            echo "<li><a href='./Discount.php'><h3>Create Discount</h3></a></li>";
                            echo "<li><a href='./Products.php'><h3>Products</h3></a></li>";
                        }
                        elseif($_SESSION['user_type'] == 'orderpicker') {
                            echo "<li><a href='./Orders.php'><h3>Orders</h3></a></li>";
                        }
                        elseif($_SESSION['user_type'] == 'customer'){
                            echo "<li><a href='./Products.php'><h3>Products</h3></a></li>";
                            echo "<li><a href='./Cart.php'><h3>Cart</h3></a></li>";
                            echo "<li><a href='./History.php'><h3>Order History</h3></a></li>";
                        }
                        echo "<li><a href='./Logout.php'><h3>Logout</h3></a></li>";
                    }
                    else{
                        echo "<li><a href='Login.php'><h3>Login</h3></a></li>";
                        echo "<li><a href='Register.php'><h3>Register</h3></a></li>";
                    }
                    
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
