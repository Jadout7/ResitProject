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
            $user_id=$_SESSION['user_id'];
            $sql = "SELECT oi.order_item_id, oi.order_id, oi.title, oi.quantity;
                FROM ordereditem oi
                JOIN order o ON oi.order_id = o.order_id
                WHERE o.user_id=?;";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    if(mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $id, $item_id, $title, $quantity);
                        mysqli_stmt_store_result($stmt);
                        $subtotal=$quantity*$price;
                    }
                }  
                /*if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}*/
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
                    <h3><?php $subtotal ?></h3>
                </div>
            </article>
            <article>
                <div class="productBox">
                    <img src="./resources/<?php $image ?>" alt="Product Image"/>
                    <h2><?php $title ?></h2>
                    <label for="amount"><b>Amount</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="amount" id="amount">
                    <h3><?php $subtotal ?></h3>
                </div>
            </article>
            <article>
                <div class="productBox">
                    <img src="./resources/<?php $image ?>" alt="Product Image"/>
                    <h2><?php $title ?></h2>
                    <label for="amount"><b>Amount</b>&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="amount" id="amount">
                    <h3><?php $subtotal ?></h3>
                </div>
            </article>
            <div class="total">
                <?php
                $total+=$subtotal;
                echo "<h2>Total:" .$total. "</h2>";
                ?>
            </div>
            <div class="UandC">
                <input type="submit" name="update" value="Update">
                <input type="submit" name="check" value="Checkout">
            </div>
            <?php
                if(isset($_POST['Checkout'])){
                    $sql = "INSERT INTO ordereditem (order_id, title, quantity) VALUES (?,?,?);";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, "sss", $_SESSION['sessionID'], $item_id, $title, $quantity);
                        if(!mysqli_stmt_execute($stmt)){
                            $error = "Error executing query" . mysqli_error($conn);
                            die($error); //die if we cant execute statement
                        }else
                        header("location:./errors&success.php?success=ordered_item");
                    }else{
                        header("location: ./errors&success.php?error=formdata");
                    }
                    mysqli_stmt_close($stmt); //close statement
                    mysqli_close($conn); //close connection
                }
            ?>
        </main>
    </body>
</html>
