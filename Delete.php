</body>
<?php
include 'header.php';
?>
<main>
    <?php   //selects Id from userId and deletes it
    include 'Database.php';
    if (isset($_GET['order_id'])) {
        $id = $_GET['order_id'];
        $query = "DELETE FROM `ordereditem` WHERE order_Id = '$id'";
        $run = mysqli_query($conn, $query);
        if ($run) {
            header("Location: ./errors&success.php?success=deleted");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
    </body>