<!DOCTYPE html>
<html>
    <head>
        <title>Order History</title>
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
            <h1>Your order history</h1>
        </div>
        <?php
        $user_id=1;
        $subtotal=0;
        $total=0;
            $sql = "select distinct o.order_id, i.price, oi.quantity
                FROM item i
                JOIN ordereditem oi ON oi.order_item_id = i.item_id
                JOIN orders o ON oi.order_id = o.order_id
                WHERE o.user_id=?;";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    if(mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $id, $price, $quantity);
                        mysqli_stmt_store_result($stmt);
                        while($attr=mysqli_stmt_fetch($stmt)) {
                            $subtotal=$quantity*$price;
                            $total+=$subtotal;
                            
        ?>
            <article>
                <div class="orderBox">
                    <p>Order Number: <?php $attr['order_id']?></p>
                    <h3>Total price: <?php echo"&euro;" .$total ?></h3>
                    <a href="#">Order details &gt;&gt;</a>
                </div>
            </article>
        </main>    
        <?php
                    }
                }
            }
	    ?>
    </body>
</html>
