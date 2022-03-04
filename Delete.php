<body>
    <?php
    include 'header.php';
    include 'Database.php';
    ?>
    <main>
        <?php   //selects Id from userId and deletes it
    include 'conn.php';
    if (isset($_GET['item_id'])) {
        $id = $_GET['item_id'];
        $query = "DELETE FROM `ordereditem` WHERE item_Id = '$id'";
        $run = mysqli_query($conn, $query);
        if ($run) {
            header('location:./Cart.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
        <?php
        /*
        if (isset($POST['Delete'])) {
            $sql = "DELETE FROM `orders` WHERE `order_id` = ? && `status` == 'Is Received';";
            mysqli_stmt_bind_param($stmt, "i", $orderid);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ./History.php");
            } else {
                echo "execute statement failed";
            }
        }
        */
        ?>