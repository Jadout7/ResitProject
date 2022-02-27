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
            <article>
                <div class="orderBox">
                    <h2>Order Number</h2>
                    <h3>Total price: &euro;32,98</h3>
                    <a href="#">Order details &gt;&gt;</a>
                </div>
            </article>
            <article>
                <div class="orderBox">
                    <h2>Order Number</h2>
                    <h3>Total price: &euro;32,98</h3>
                    <a href="#">Order details &gt;&gt;</a>
                </div>
            </article>
            <article>
                <div class="orderBox">
                    <h2>Order Number</h2>
                    <h3>Total price: &euro;32,98</h3>
                    <a href="#">Order details &gt;&gt;</a>
                </div>
            </article>
            <article>
                <div class="orderBox">
                    <h2>Order Number</h2>
                    <h3>Total price: &euro;32,98</h3>
                    <a href="#">Order details &gt;&gt;</a>
                </div>
            </article>
            <div class="more">
                <b><u><a href="#">More orders &gt;&gt;</a></u></b>
            </div>
            <?php
            $sql="select oi.orderitemid, oi.orderid, oi.productdesc, oi.quantity from orderitems oi where oi.orderid = 1;";
            ?>
        </main>    
    </body>
</html>
