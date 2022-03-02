<!DOCTYPE html>
<html>
    <head>
        <title>Orders</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Main.css" type="text/css">
    </head>
    <body>
        <?php
            include 'header.php';
        ?>
        <main class="orderPickerTable">
            <div class="orderPickerGreetings">
                <h1>Hello <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "!"; ?></h1>
            </div>
            <div>
                <p>All orders:</p>
                <table border="1px">
                    <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>User id</th>
                        <th>Order id</th>
                        <th>Order date</th>
                        <th>Status</th>
                        <th>Tack & Trace code</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'Database.php';
                            $sql = "SELECT user.firstname, user.lastname, orderpicker.user_id, orderpicker.order_id, orderpicker.order_date, orderpicker.status, orderpicker.track_code FROM user LEFT JOIN orderpicker ON (user.user_id = orderpicker.user_id)"; // query select statement
                            $result = mysqli_query($conn, $sql) or die(mysqli_error());
                            while($row=mysqli_fetch_array($result)){   // fetches a result row as an array
                        ?>
                        <tr>
                            <td><?php echo $row['firstname']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <?php
                                    if($row['status']== "Is shipped") {
                                        echo $row['track_code'];
                                    }else {
                                        echo "None";
                                    }
                                ?>
                            </td>
                            <?php
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
