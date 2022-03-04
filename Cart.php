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
        include 'Database.php';
        include 'header.php';
    ?>
    <main>
        <div class="mainTitle">
            <h1>Your cart</h1>
            <form method="post" action=<?php echo $_SERVER['PHP_SELF'];?> enctype="multipart/form-data">
            <div class="orderBy">
                <select name="orderBy">
                    <option value="PriceAscending">Price Ascending</option>
                    <option value="PriceDescending">Price Descending</option>
                    <option value="NameAscending">Name Ascending</option>
                    <option value="NameDescending">Name Descending</option>
                </select>
            </div>
        </div>
        <?php
            $user_id=2;
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
                <img src = "./upload/<?php echo $attr['image']?>" alt = "Product Image">
                <h2><?php echo"Product : " .$attr['title']; ?></h2>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <h3>Quantity: <input type="number" name="quantity" min="1" max="100"></h3>
                </form>
                <h3><?php echo "Subtotal : &euro; " .$subtotal. ".00";?></h3>
            </div>
        </article>
        <?php
                    }
                }
            }
	    ?>
        <div class="total">
            <?php echo "<h2>Total: &euro; " .$total. ".00</h2>"; ?>
         </div>
        <div class="UandC">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="check" value="Checkout">
        </div>
        <?php
            if(isset ($_POST['Update'])){
                if($_POST['orderBy'] == "PriceAscending"){
                    $sql = "select i.image, i.title, oi.quantity, i.price FROM item i JOIN ordereditem oi ON oi.order_item_id = i.item_id JOIN orders o ON oi.order_id = o.order_id WHERE o.user_id=? order by price asc;";
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        if (mysqli_stmt_execute($stmt)) {
                            }else{
                                echo mysqli_error($conn);
                            }
                    }else{
                        echo mysqli_error($conn);
                    }
                }
                elseif($_POST['orderBy'] == "PriceDescending"){
                    $sql = "select i.image, i.title, oi.quantity, i.price FROM item i JOIN ordereditem oi ON oi.order_item_id = i.item_id JOIN orders o ON oi.order_id = o.order_id WHERE o.user_id=? order by price desc;";
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        if (mysqli_stmt_execute($stmt)) {
                            }else{
                                echo mysqli_error($conn);
                            }
                    }else{
                        echo mysqli_error($conn);
                    }
                }
                elseif($_POST['orderBy'] == "NameAscending"){
                    $sql = "select i.image, i.title, oi.quantity, i.price FROM item i JOIN ordereditem oi ON oi.order_item_id = i.item_id JOIN orders o ON oi.order_id = o.order_id WHERE o.user_id=? order by title asc;";
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        if (mysqli_stmt_execute($stmt)) {
                            }else{
                                echo mysqli_error($conn);
                            }
                    }else{
                        echo mysqli_error($conn);
                    }
                }
                elseif($_POST['orderBy'] == "NameDescending"){
                    $sql = "select i.image, i.title, oi.quantity, i.price FROM item i JOIN ordereditem oi ON oi.order_item_id = i.item_id JOIN orders o ON oi.order_id = o.order_id WHERE o.user_id=? order by title desc;";
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        if (mysqli_stmt_execute($stmt)) {
                            }else{
                                echo mysqli_error($conn);
                            }
                    }else{
                        echo mysqli_error($conn);
                    }
                }
            }
        ?>
        </main>
    </body>
</html>
