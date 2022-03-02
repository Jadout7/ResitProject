<body>
<?php
    include 'header.php';
?>
    <main>
    <div class = 'mainTitle'>
        <h1>Our Products<h1>
    </div>
    <?php
        include 'Database.php';
            $sql = "select * FROM item;";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        while($attr=mysqli_fetch_assoc($result)) {
    ?>
    <article>
        <div class = 'article_product'>
            <img src = "<?php $attr['image']?>" alt = "Product Image">
            <h3><?php echo($attr['title']) ?></h3>
            <p><?php echo $attr['description'] ?></p>
            <p><b><i><?php echo $attr['category'] ?></i></b></p>
            <h4><?php echo "Price: &euro;" .$attr['price']. ".00" ?></h4>
            <p><input type="submit" value="Add to Cart">
        </div>
    </article>
    <?php
                }
            }
        }
    ?>    
    </main>
</body>  