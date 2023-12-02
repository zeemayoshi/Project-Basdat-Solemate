<?php

include 'konek.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

// Handle delete action
if (isset($_GET['delete'])) {
    $delete_user_id = $_GET['delete'];
    $delete_user_query = mysqli_query($koneksi, "DELETE FROM `user` WHERE user_id = '$delete_user_id'");
    
    if ($delete_user_query) {
        header('location: login.php'); // Redirect to login page after deletion
    } else {
        $message[] = 'Failed to delete user.';
    }
}

// Handle edit action
if (isset($_GET['edit'])) {
    // Redirect to an edit profile page or modal
    header('location: edit_profile.php');
    exit(); // Stop further execution
}
if (isset($_POST['tambah_stok'])) {
   $product_id = $_POST['product_id'];
   $additional_stock = $_POST['product_quantity'];

   // Update stock in the sepatu table
   $update_stock_query = mysqli_query($koneksi, "UPDATE sepatu SET sepatu_stok = sepatu_stok + $additional_stock WHERE sepatu_id = '$product_id'");

   if ($update_stock_query) {
       echo "Stok sepatu berhasil ditambah.";
   } else {
       echo "Gagal menambah stok sepatu: " . mysqli_error($koneksi);
   }
}
if (isset($_GET['hapus'])) {
   $delete_user_id = $_GET['hapus'];
   $delete_user_query = mysqli_query($koneksi, "DELETE FROM sepatu WHERE sepatu_id = '$delete_user_id'");
   
   if ($delete_user_query) {
       header('location: profil.php'); // Redirect to login page after deletion
   } else {
       $message[] = 'Failed to delete user.';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solemate | Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
   
<?php
if (isset($message)) {
   foreach ($message as $msg) {
      echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
   }
}
?>

<header>

<div class = "logo"><a href="shoppage.php"><img src="logo solemate.png" width = 100px height = 20px></a></div>
<div class="icons">
            <a href="formtambahsepatu.php" class="fa fa-plus"></a>
            <a href="keranjang.php" class="fas fa-shopping-cart"></a>
            <a href="profil.php" class="fas fa-user"></a>
        </div>
    </header>

    <div class="wrapper">
        <div class="wrapper1">
            <form action="">
                <h1>Profile</h1>
                <div class="input-box">
                    <div class="input-field">

   <?php
      $select_user = mysqli_query($koneksi, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('Query failed');
      if (mysqli_num_rows($select_user) > 0) {
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

                     <input type="text" value="<?php echo $fetch_user['user_name']; ?>" readonly>
                     <i class='bx bxs-user'></i>
                  </div>  

                  <div class="input-field">
                     <input type="email" value="<?php echo $fetch_user['user_email']; ?>" readonly>
                     <i class='bx bxs-envelope' ></i>
                  </div>
               </div>

                <div class="button">
                <a href="?edit=<?php echo $user_id; ?>" class="edit-btn">Edit Profile</a>
      <a href="?delete=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to delete your account?');" class="delete-btn">Delete Account</a>
      <a href="logout.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to log out?');" class="delete-btn">Log Out</a>
                </div>
            </form>
        </div>
    </div>
   <?php

   $select_product = mysqli_query($koneksi, "SELECT * FROM sepatu") or die('query failed');
   if(mysqli_num_rows($select_product) > 0){
      while($fetch_product = mysqli_fetch_assoc($select_product)){
?>
   <form method="post" class="box" action="">

   <div class="wrapper">
        <div class="wrapper2">
            <h1>My Product</h1>
            <div class="slider snaps-inline">
                <div class="media-element">
                    <div class="name">
                     <p><?php echo $fetch_product['sepatu_nama']; ?></p>
      </div>
      <input type="hidden" min="1" name="product_quantity" value="1">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['sepatu_gambar']; ?>">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['sepatu_nama']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['sepatu_harga']; ?>">
      <input type="hidden" name="product_id" value="<?php echo $fetch_product['sepatu_id']; ?>">
      <div class="image">
      <img src="../gambar/<?php echo $fetch_product['sepatu_gambar']; ?>" width=277.5px height=277.5px>
      </div>
      <div class="quantity">
      <input type="number" min="1" name="product_quantity" value="<?php echo $fetch_product['sepatu_stok']; ?>">
      <input type="submit" value="Add" name="tambah_stok" class="btn">
      </div>
      </form>

<?php
   };
};
?>
</div>
</div>
</body>
</html>



