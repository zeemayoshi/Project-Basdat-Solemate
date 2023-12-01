<?php

include 'konek.php';

$product_id = $_GET['product_id'];

$query = "SELECT * FROM sepatu WHERE sepatu_id = '$product_id'";
$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0)
    $product_detail = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solemate | Product Details</title>
        <link rel="stylesheet" href="detailproduk.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>
<body>
    <header>
            <input type="checkbox" name="" id="toggler">
            <label for="toggler" class="fas fa-bars"></label>

            <div class = "logo"><a href="shoppage.php"><img src="logo solemate.png" width = 100px height = 20px></a></div>
            <div class="icons">
                <a href="productregist.html" class="fa fa-plus"></a>
                <a href="tescart.html" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-user"></a>
                
            </div>
        </header>
        <div class="container">
            <div class="title">PRODUCT DETAIL</div>
            <div class="detail">
            <div class="image">
                    <img src="../gambar/<?php echo $product_detail['sepatu_gambar']; ?>">
                </div>
                <div class="content">
                    <h1 class="name">
                    <?php echo "{$product_detail['sepatu_nama']}"; ?>
                    </h1>
                <div class="price">  
                    <?php echo "Rp.{$product_detail['sepatu_harga']}"; ?>
                </div>
                <div class="size">
                        <p>Size:</p>
                        <p> <?php echo "{$product_detail['sepatu_ukuran']}"; ?> </p>
                </div>
                <div class="description">
                <p> <?php  echo "{$product_detail['sepatu_deskripsi']}"; ?> </p>
                </div>
    
        </div>
        </div>
    </body>
</html>