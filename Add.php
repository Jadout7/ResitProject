<body>
    <?php
    include 'header.php';
    include 'Database.php';
    ?>
    <main>
        <?php
        $quantity = $_POST["quantity"];
        $item_id = $_POST["item_id"];

        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
        $cart = json_decode($cart);

        $result = mysqli_query($conn, "SELECT * FROM item WHERE item_id = '" . $item_id . "'");
        $product = mysqli_fetch_object($result);

        array_push($cart, array(
            "order_item_id" => $item_id,
            "quantity" => $quantity,
            "item" => $item
        ));
        echo"<br><br>";

        setcookie("cart", json_encode($cart));
        header("Location: products.php");

        ?>

        <?
        $sql="INSERT INTO ordereditem (item_id, order_id, quantity VALUES(?,?,?);";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $item_id, $order_id, $quantity);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error executing query" . mysqli_error($conn);
                die(); //die if we cant execute statement
            }else {
                header("location:./errors&success.php?success=added");
            }
        }
        ?>