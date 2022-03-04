<body>
    <?php
    include "header.php";
    include 'Database.php';
    ?>
    <?php
    if (isset($_POST['Search'])) {
        $search = $_POST['text'];
        $sql = "SELECT * from item where title like %?%;";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $search);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($attr = mysqli_fetch_assoc($result)) {
                    header("Location: ./Products.php");
    ?>
                    <article>
                        <div class='article_product'>
                            <img src="./upload/<?php echo $attr['image'] ?>" alt="Product Image"><br><br>
                            <h4><?php echo $attr['title'] ?></h4><br>
                            <p><?php echo "<b>Description: </b>" . $attr['description'] ?></p><br>
                            <p><b><i><?php echo "Category: " . $attr['category'] ?></i></b></p><br>
                            <h4><?php if ($attr['ageres'] == "1") {
                                    echo "Age restricted item.";
                                }
                                ?>
                            </h4><br>
                            <h4><?php echo "Price: &euro;" . $attr['price'] . ".00"; ?></h4><br>
                            <div class='log'>
                                <form method="post" action=Add.php enctype="multipart/form-data">
                                    <input type="submit" name="add" value="Add to Cart">
                                </form>
                            </div>
                        </div>
                    </article>
    <?php
                }
            }
        }
    }
    ?>

</body>