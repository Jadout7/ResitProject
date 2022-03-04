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
        if(!isset($_SESSION['sessionID'])) {
        header("location:./errors&success.php?error=login");
    }
    ?>
    <main>
        <div class="mainTitle">
            <h1>Your cart</h1>
        </div>
        <?php
            $user_id = $_SESSION['sessionID'];
            $subtotal=0;
            $total=0;
            $sql = "select item.image, item.title, item.price, ordereditem.quantity, user.user_id
                FROM item 
                JOIN ordereditem ON ordereditem.item_id = item.item_id
                JOIN user  ON user.user_id =" . $user_id;

                if($stmt = mysqli_prepare($conn, $sql)) {
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

                <form method="post" action="Delete.php">
                <input type="hidden" name="item_id" value="<?php echo $c['item_id']; ?>">
                <input type="submit" value="Delete">
                </form>

                <form method="post" action="Update.php">
                    <input type="number" name="quantity" min="1" value="<?php echo $c['quantity']; ?>">
                    <input type="hidden" name="item_id" value="<?php echo $c['item_id']; ?>">
                    <input type="submit" value="Update">
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
            <form method="post" action="Checkout.php">
            <input type="submit" name="Checkout" value="Checkout">
            </form>
        </div>
        </main>
    </body>
</html>
