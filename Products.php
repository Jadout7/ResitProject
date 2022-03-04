<body>
    <?php
    include 'header.php';
    include 'Database.php';
    ?>
    <main>
        <div class='mainTitle'>
            <h1>Our Products</h1>
        </div>
        <form method="post" action="Sort.php" enctype="multipart/form-data">
            <div class="orderBy">
                <select name="orderBy">
                    <option value="Price Asc">Price Ascending</option>
                    <option value="Price Desc">Price Descending</option>
                    <option value="Name Asc">Name Ascending</option>
                    <option value="Name Desc">Name Descending</option>
                    <option value="Category Asc">Category Ascending</option>
                    <option value="Category Desc">Category Descending</option>
                </select>
                <label class="log">
                <input type="submit" name="Sort" value="Sort" >
                </label>
            </div>
        </form>
        <?php
        $sql = "select * FROM item;";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                while ($attr = mysqli_fetch_assoc($result)) {
        ?>
            <article>
                <div class='article_product'>
                    <img src="./upload/<?php echo $attr['image'] ?>" alt="Product Image"><br><br>
                    <h4><?php echo $attr['title'] ?></h4><br>
                    <p><?php echo "<b>Description: </b>" . $attr['description'] ?></p><br>
                    <p><b><i><?php echo "Category: " . $attr['category'] ?></i></b></p><br>
                    <h4><?php  if ($attr['ageres'] == "1")  {
                                echo "Age restricted item.";
                            }
                        ?>
                    </h4><br>
                    <h4><?php echo "Price: &euro;" . $attr['price'] . ".00"; ?></h4><br>
                    <div class='log'>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                        <input type="submit" name="add" value="Add to Cart">
                    </form>
                    </div>
                </div>
            </article>
             <?php
                $query = "Select ofage FROM user";
                if ($stmt = mysqli_prepare($conn, $query)) { //database compiles and performs query optimization and stores w/o executing
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_store_result($stmt);
                    }
                $item_id = $attr['item_id'];
                $quantity = 1;
                $sql = 'INSERT INTO ordereditem (item_id, order_id, quantity) VALUES (' . $item_id . ',?,' . $quantity . ')'; //the query for inserting into the database
                if (isset($_POST['add'])) {
                    if ($attr['ageres'] == 1) {
                        if ($stmt = mysqli_prepare($conn, $sql)) {
                            $stmt->bind_param('i', $order_id);//bind values to parameters
                            if ($stmt->execute()) {
                                header("location:./errors&success.php?success=added");
                                mysqli_stmt_close($stmt); //close statement
                                mysqli_close($conn); //close connection
                            }else {
                                echo "Error: " . mysqli_error($conn);
                                die();
                            }
                        }else {
                            echo "Error: " . mysqli_error($conn);
                            die();
                        }
                    }elseif ($attr['ageres'] == 0) {
                        echo "You need to be 18+ to add this to your cart!";
                    }elseif ($attr['ageres'] == 0) {
                        if ($stmt = mysqli_prepare($conn, $sql)) {
                            $stmt->bind_param('i', $order_id);//bind values to parameters
                            if ($stmt->execute()) {
                                header("location:./errors&success.php?success=added");
                                mysqli_stmt_close($stmt); //close statement
                                mysqli_close($conn); //close connection
                            }else {
                                echo "Error: " . mysqli_error($conn);
                                die();
                            }
                        }else {
                            echo "Error: " . mysqli_error($conn);
                            die();
                        }
                    }
                }
            }
        }
        }else {
            echo "Error: " . mysqli_error($conn);
            die();
        }
    }else {
            echo "Error: " . mysqli_error($conn);
            die();
    }
    ?>
    </main>
</body>