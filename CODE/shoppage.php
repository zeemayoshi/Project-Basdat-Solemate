<?php
session_start();
include 'konek.php'; // Koneksi ke database
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect atau tampilkan pesan bahwa pengguna harus login terlebih dahulu
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];
if(isset($_GET['remove'])){
   $keranjang_id = $_GET['remove'];
   mysqli_query($koneksi, "DELETE FROM keranjang WHERE keranjang_id = '$keranjang_id'") or die('query failed');
   header('location:shoppage.php');
}
  
if(isset($_POST['delete_all'])){
   mysqli_query($koneksi, "DELETE FROM keranjang WHERE pembeli_id = '$user_id'") or die('query failed');
   header('location:shoppage.php');
}

// Ambil informasi sesi
if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $product_id = $_POST['product_id'];
 
    $select_cart = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE nama_sepatu = '$product_name' AND pembeli_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select_cart) > 0){
       $message[] = 'product already added to cart!';
    }else{
       mysqli_query($koneksi, "INSERT INTO keranjang(pembeli_id, nama_sepatu, harga_sepatu, gambar_barang , quantity,sepatu_id) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity','$product_id')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 };
 if(isset($_POST['update_cart'])){
    $update_quantity = $_POST['cart_quantity'];
    $update_id = $_POST['cart_id'];
    mysqli_query($koneksi, "UPDATE keranjang SET quantity = '$update_quantity' WHERE keranjang_id = '$update_id'") or die('query failed');
    $message[] = 'cart quantity updated successfully!';
 }
 $search_results = [];

// Periksa apakah ada hasil pencarian dari sesi atau cookie
if (isset($_SESSION['search_results'])) {
    $search_results = $_SESSION['search_results'];
    // Hapus data pencarian dari sesi atau cookie setelah digunakan
    unset($_SESSION['search_results']);
}
// Periksa apakah pengguna mengirimkan data pencarian

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=Edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Solemate | Homepage</title> 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   <link rel="stylesheet" href="tesprojekakhir.css" />
</head>
<body>
   <header>
      <div class = "logo"><a href="#"><img src="logo solemate.png" width = 100px height = 20px></a></div>
      <div class="search">
                    <form action="prosescari.php" method="post">
                    <input type="search"
                           placeholder=" Search ..."
                           name="search_data">
                           <button type="submit" name="cari">
                            <i class="fa fa-search" style="font-size: 18px;"></i>
                             </button>         
                        </form>
        </div>
      <div class="icons">
                <a href="formtambahsepatu.php" class="fa fa-plus"></a>
                <a href="keranjang.php" class="fas fa-shopping-cart"></a>
                <a href="profil.php" class="fas fa-user"></a>
                
            </div>
        </header>

        <section class="home" id="home">
            <div class="content">
                <h3>#WalkWithSolemate</h3>
                <a href="#products" class="btn" id="gallery">Shop</a>
            </div>
        </section>

        <section class = "about" id ="about">
            <h1 class="heading">About Us</h1>
            <div class="row">
                <div class="picture-container">
                    <img src="1663278676-best-nike-air-max-sneakers-buy-01.gif"></img>
                </div>

                <div class="content">
                    <h3>Why <span>Choose</span> Us?</h3>
                    <p>Discover Unparalleled Shopping Excellence with Us! At Solemate, We Redefine Your Online Shopping Experience by Offering a Seamless Fusion of Quality, Variety, and Unmatched Customer Service. From Curated Collections of the Latest Trends to Time-Tested Classics, We Pride Ourselves on Providing a Diverse Selection to Cater to Every Style and Preference</p>  
                </div>
            </div>
        </section>

        <section class="products" id="products">

            <h1 id="gallery" class="heading">All Products</h1>

<?php
if (!empty($search_results)) {
   foreach ($search_results as $row) {
       ?>

<div class="box-container">
                <div class="box">
                    <div class="image">

       <form method="post" class="box" action=" ">
       <a href="detail_barang.php?product_id=<?php echo $fetch_product['sepatu_id']; ?>">
        <div><img src="../gambar/<?php echo $fetch_product['sepatu_gambar']; ?>" alt="Product Image"></div>
    </a>
           <div class="icons">
               <a class="fas fa-shopping-cart"><input type="submit" value="submit" name="add_to_cart"></a>
               <button type="submit" class="btn" name="add_to_cart">
                            <i class="fas fa-shopping-cart" style="font-size: 18px;"></i>
                             </button>  
            </div> </div>
         <div class="content"> </h3> <?php echo $row['sepatu_nama']; ?> </h3>
           <div class="price">Rp.<?php echo $row['sepatu_harga']; ?></div>
         </div>
           <input type="hidden" min="1" name="product_quantity" value="1">
           <input type="hidden" name="product_image" value="<?php echo $row['sepatu_gambar']; ?>">
           <input type="hidden" name="product_name" value="<?php echo $row['sepatu_nama']; ?>">
           <input type="hidden" name="product_price" value="<?php echo $row['sepatu_harga']; ?>">
           <input type="hidden" name="product_id" value="<?php echo $row['sepatu_id']; ?>">
           
       </form>
       <a href="detail_barang.php?product_id=<?php echo $fetch_product['sepatu_id']; ?>" class="btn">Detail Barang</a>
            </form>

   </div> </div>
       <?php
   }
} else {
   $select_product = mysqli_query($koneksi, "SELECT * FROM sepatu") or die('query failed');
   if(mysqli_num_rows($select_product) > 0){
      while($fetch_product = mysqli_fetch_assoc($select_product)){
?>

            <div class="box-container">
                <div class="box">
                    <div class="image">

   <form method="post" class="box" action="">
   <a href="detail_barang.php?product_id=<?php echo $fetch_product['sepatu_id']; ?>">
        <div><img src="../gambar/<?php echo $fetch_product['sepatu_gambar']; ?>" alt="Product Image"></div>
    </a>
      <div class="icons"> <a class="fas fa-shopping-cart"><input type="submit" value=" Buy" name="add_to_cart"></a> </div> </div>
      <div class="content"> <h3> <?php echo $fetch_product['sepatu_nama']; ?> </h3>
      <div class="price"> Rp.<?php echo $fetch_product['sepatu_harga']; ?> </div> </div>
      <input type="hidden" min="1" name="product_quantity" value="1">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['sepatu_gambar']; ?>">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['sepatu_nama']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['sepatu_harga']; ?>">
      <input type="hidden" name="product_id" value="<?php echo $fetch_product['sepatu_id']; ?>">
   </form>

   </div> </div>

<?php
   };
};
};
?>

<section class="footer">
            <div class="box-container">
                <div class="box">
                    <h3>Location</h3>
                    <p>Bogor, Jawa Barat</p>
                    <p>Bandung, Jawa Barat</p>
                </div>

                <div class="box">
                    <h3>Contact Info</h3>
                    <p>+123-456-7890</p>
                    <p>solemate@gmail.com</p>
                    <p>Bogor, Indonesia - 16680</p>
                    <img src="payment.png" alt="">
                </div>
            </div>
        </section>
    </body>
</html>