<?php
session_start();
include 'konek.php';
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Solemate | Product Registration</title>
        <link rel="stylesheet" href="productregist.css" />
    </head>
<body>
        <div class="productregistrationform">
            <h1>Register Your Product!</h1>
<form action="prosestambahsepatu.php" method="post" enctype="multipart/form-data">
    <p>Product Name:</p>
    <input type="text" name="sepatu_nama" required>
    <p>Price:</p>
    <input type="number" name="sepatu_harga" required> 
    <div class="category">
    <p>Category:</p>
    <input type="radio" name="kategori_sepatu" value="laki-laki"> <span>Man</span>
	<input type="radio" name="kategori_sepatu" value="wanita"> <span>Woman</span>
    </div>
    <p>Size(EU):</p>
    <input type="text" name="sepatu_ukuran" required placeholder="35-43" min="35" max="43">
    <p>Product Stock:</p>
    <input type="number" name="sepatu_stok" required>
    <p>Product Description:</p>
    <textarea name="sepatu_deskripsi" rows="4"></textarea>
    <p>Image:</p>
    <input type="file" name="sepatu_gambar" required>
    
    <br> <br>

    <input type="submit" class="button" value="Register"  id="button" name=tambah>
                <a href="shoppage.php" class="button" id="button">Cancel</a>
            </form>
        </div>

        <br>
        <br>
        <br>
        
    </body>
</html>