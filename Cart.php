<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Main.css" type="text/css">
    </head>
    <body>
        <?php
            include 'header.php';
            include 'Database.php';
            $sum=0;
            $sql = "SELECT oi.id, oi.item_id, oi.title, oi.quantity, i.price, i.image;
                FROM ordereditem oi
                JOIN user u ON oi.id = u.user_id
                JOIN item i ON oi.item_id = i.item_id
                WHERE u.user_id=?;";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "i", $_SESSION['sessionID']);
                    if(mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $id, $item_id, $title, $quantity, $price, $image);
                        mysqli_stmt_store_result($stmt);
                        $pri=$quantity*$price;
                    }
                }  
        ?>
        <main>
            <div class="mainTitle">
                <h1>Your cart</h1>
            </div>
            <article>
                <div class="productBox">
                    <img src="./resources/<?php $image ?>" alt="Product Image"/>
                    <h2><?php $title ?></h2>
                    <label for="amount"><b>Amount</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="amount" id="amount">
                    <h3><?php $pri ?></h3>
                </div>
            </article>
            <article>
                <div class="productBox">
                    <img src="./resources/<?php $image ?>" alt="Product Image"/>
                    <h2><?php $title ?></h2>
                    <label for="amount"><b>Amount</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="amount" id="amount">
                    <h3><?php $pri ?></h3>
                </div>
            </article>
            <article>
                <div class="productBox">
                    <img src="./resources/<?php $image ?>" alt="Product Image"/>
                    <h2><?php $title ?></h2>
                    <label for="amount"><b>Amount</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="amount" id="amount">
                    <h3><?php $pri ?></h3>
                </div>
            </article>
            <div class="total">
                <?php
                echo"<h2>Total:" .sum($pri). "</h2>";
                ?>
            </div>
            <div class="UandC">
                <input type="submit" name="update" value="Update">
                <input type="submit" name="check" value="Checkout">
            </div>
        </main>
    </body>
</html>
