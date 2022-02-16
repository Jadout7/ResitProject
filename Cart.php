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
            <article>
                <div class="productBox">
                    <img src="./resoruces/iphone13-small.png" alt="iPhone 13"/>
                    <h2>iPhone 13</h2>
                    <label for="amount"><b>Amount</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="amount" id="amount">
                    <h3>&euro;32,98</h3>
                </div>
            </article>
            <article>
                <div class="productBox">
                    <img src="./resoruces/iphone13-small.png" alt="iPhone 13"/>
                    <h2>iPhone 13</h2>
                    <label for="amount"><b>Amount</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="amount" id="amount">
                    <h3>&euro;32,98</h3>
                </div>
            </article>
            <article>
                <div class="productBox">
                    <img src="./resoruces/iphone13-small.png" alt="iPhone 13"/>
                    <h2>iPhone 13</h2>
                    <label for="amount"><b>Amount</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="amount" id="amount"> 
                    <h3>&euro;32,98</h3>
                </div>
            </article>
            <div class="total">
                <h2>Total &euro;230,24</h2>
            </div>
            <div class="UandC">
                <input type="submit" name="update" value="Update">
                <input type="submit" name="check" value="Checkout">
            </div>
        </main>
    </body>
</html>
