<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect atau tampilkan pesan bahwa pengguna harus login terlebih dahulu
    header('Location: login.php');
    exit();
}
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($koneksi, "DELETE FROM 'keranjang' WHERE keranjang_id = '$remove_id'") or die('query failed');
    header('location:shoppage.php');
 }
   
 if(isset($_GET['delete_all'])){
    mysqli_query($koneksi, "DELETE FROM 'keranjang' WHERE pembeli_id = '$user_id'") or die('query failed');
    header('location:shoppage.php');
 }

// Ambil informasi sesi
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Solemate Homepage</title>
</head>
<body>
    <h1>Welcome to Solemate</h1>
    <p>Find your perfect pair of shoes here!</p>
    <p>
        <a href="formtambahsepatu.php">Tambah Sepatu</a>
    </p>
    <p>	
        <a href="shoppage.php">Go to Shopping Page</a>
    </p>
    <p>
        <a href="profil.php">Profil Pengguna</a>
    </p>
</body>
</html>
