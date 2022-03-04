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
            <h1>Order history</h1>
        </div>
        <?php
            include 'Database.php';
            $subtotal=0;
            $total=0;
                $sql = "select ordereditem.item_id, item.price, ordereditem.quantity, ordereditem.status. ordereditem.order_id
                    FROM item 
                    JOIN ordereditem ON ordereditem.item_id = item.item_id
                    WHERE ordereditem.user_id=?
                    GROUP BY ordereditem.order_id;";
                    if($stmt = mysqli_prepare($conn, $sql)) {
                        mysqli_stmt_bind_param($stmt, "i", $user_id);
                        if(mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);
                            while($attr=mysqli_fetch_assoc($result)) {
                                $subtotal=$attr['quantity']*$attr['price'];
                                $total+=$subtotal;             
        ?>
        <article>
            <div class="orderBox">
                <h2>Order Number: <?php echo $attr['order_id']; ?></h2>
                <h3>Total price: <?php echo "&euro;" .$total. ".00"; ?></h3>
                <h3>Order Status: <?php echo $attr['status']; ?></h3>
                <a href="Delete.php">Delete Order</a>
           </div>
        </article>
        <?php
                    }
                }
            }
        ?>
        </main>    
    </body>
</html>
