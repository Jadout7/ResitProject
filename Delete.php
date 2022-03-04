</body>
<?php
include 'header.php';
?>
<main>
    <?php   //selects Id from userId and deletes it
    include 'Database.php';
    if (isset($_GET['order_id'])) {
        $id = $_GET['order_id'];
        $sql = "DELETE FROM `ordereditem` WHERE order_id = $id";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                while ($result==true){
                    header("Location: ./errors&success.php?success=deleted");
                }             
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    ?>
    </body>