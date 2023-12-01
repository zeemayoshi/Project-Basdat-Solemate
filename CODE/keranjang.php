<?php
session_start();
include 'konek.php'; // Koneksi ke database
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect atau tampilkan pesan bahwa pengguna harus login terlebih dahulu
    header('Location: login.php');
    exit();
}
// Ambil informasi sesi
$user_id = $_SESSION['user_id'];
?>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solemate | Shopping Cart</title>
        <link rel="stylesheet" href="tescart.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<header>

    <div class = "logo"><a href="shoppage.php"><img src="logo solemate.png" width = 100px height = 20px></a></div>

    <div class="icons">
                <a href="formtambahsepatu.php" class="fa fa-plus"></a>
                <a href="keranjang.php" class="fas fa-shopping-cart"></a>
                <a href="profil.php" class="fas fa-user"></a>
            </div>
        </header>

        <br> <br> <br> <br> <br> <br> <br>

<div class="wrapper">

    <div class="project">

        <div class="shop">

            <div class="box">

      <?php
         $cart_query = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE pembeli_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         
                <img src="../gambar/<?php echo $fetch_cart['gambar_barang'];?>">
                <div class="content">
                    <h3> <?php echo $fetch_cart['nama_sepatu']; ?> <br> Rp.<?php echo $fetch_cart['harga_sepatu']; ?> </h3>
            
               <form action="shoppage.php" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['keranjang_id']; ?>">
                  <p class="unit">Quantity: <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>"> </p>
               </form>
            
                    <h4> Total Price: Rp.<?php echo $sub_total = ($fetch_cart['harga_sepatu'] * $fetch_cart['quantity']); ?> </h4>
          <form action="shoppage.php" method="get">

        <p class="btn-area"> <i class="fa fa-divash"> </i> <span class="btn2"> <button type="submit" name="remove" value= "<?php echo $fetch_cart['keranjang_id']; ?>" class="delete-btn" onclick="return confirm('Remove item from cart?');">
            Remove
            </button> </span> </p> </div> </div> </div>
    
</form>

      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<div><td style="padding:20px; text-divansform:capitalize;" colspan="6">no item added</td></div>';
         }
      ?>

        <div class="removeall">
        <form action="shoppage.php" method="post">
            <button type="submit" name="delete_all" onclick="return confirm('Delete all from cart?');">
                Remove All
            </button>
            </form>
        </div>
        <div class="right-bar">
        <form action="shoppage.php" method="post">
        <p><span>Grand Total</span> <hr> <span>Rp.<?php echo $grand_total; ?></span></p>
        </form>

    <form action="checkout.php" method="post">
    <a href="checkout.php"><i class="fas fa-shopping-cart"></i> <input type="submit" value="Checkout" name=checkout> </a>
    </form>
        </div>
</div>

</div>
        </body>
</html>