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
            $subtotal=0;
            $total=0;
            $user_id=1;
            $sql = "select i.image, i.title, oi.quantity, i.price
                FROM item i
                JOIN ordereditem oi ON oi.order_item_id = i.item_id
                JOIN orders o ON oi.order_id = o.order_id
                WHERE o.user_id=?;";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    if(mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $image, $title, $quantity, $price);
                        mysqli_stmt_store_result($stmt);
                        while($attr=mysqli_stmt_fetch($stmt)) {
                        $subtotal=$quantity*$price;
        ?>
        <main>
            <div class="mainTitle">
                <h1>Your cart</h1>
            </div>
            <article>
                <div class="productBox">
                    <img src="<?php $attr['image'] ?>" alt="Product Image"/>
                    <p><?php $attr['title'] ?></p>
                    <p><?php $attr['quantity'] ?></p>
                    <p><?php $subtotal ?></p>
                </div>
            </article>
            <div class="total">
                <?php
                $total+=$subtotal;
                echo "<h2>Total:" .$total. "</h2>";
                ?>
            </div>
            <?php
                        }
                    }
                }
	        ?>
            <div class="UandC">
                <input type="submit" name="update" value="Update">
                <input type="submit" name="check" value="Checkout">
            </div>
        </main>
    </body>
</html>
