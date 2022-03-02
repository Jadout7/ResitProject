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
    ?>
    <main>
        <div class="mainTitle">
            <h1>Your cart</h1>
        </div>
        <?php
            include 'Database.php';
            $user_id=3;
            $subtotal=0;
            $total=0;
            $sql = "select i.image, i.title, oi.quantity, i.price
                FROM item i
                JOIN ordereditem oi ON oi.order_item_id = i.item_id
                JOIN orders o ON oi.order_id = o.order_id
                WHERE o.user_id=?;";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        while($attr=mysqli_fetch_assoc($result)) {
                            $subtotal=$attr['quantity']*$attr['price'];
                            $total+=$subtotal;
        ?>
        <article>
            <div class="productBox">
                <img src="<?php echo $attr['image'] ?>" alt="Product Image">
                <h2><?php echo"Product : " .$attr['title']; ?></h2>
                <h3><?php echo"Quantity : " .$attr['quantity']; ?></h3>
                <h3><?php echo "Subtotal : &euro; " .$subtotal;?></h3>
            </div>
        </article>
        <?php
                    }
                }
            }
	    ?>
        <div class="total">
            <?php echo "<h2>Total: &euro; " .$total. "</h2>"; ?>
         </div>
        <div class="UandC">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="check" value="Checkout">
        </div>
        </main>
    </body>
</html>
