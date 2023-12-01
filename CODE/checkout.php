<?php
session_start();
include 'konek.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect atau tampilkan pesan bahwa pengguna harus login terlebih dahulu
    header('Location: login.php');
    exit();
}

// Ambil informasi sesi
$user_id = $_SESSION['user_id'];
if (isset($_POST['checkout'])){
$tanggal_pembelian = date("Y-m-d H:i:s");
// Handle form submission
$sql_keranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE pembeli_id = '$user_id'");
    
// Loop through each item in the cart
while ($row = mysqli_fetch_assoc($sql_keranjang)) {
    $id_barang = $row['sepatu_id'];
    $jumlah_barang = $row['quantity'];

    // Kurangi jumlah barang dari stok sepatu
    $sql_kurangi_stok = mysqli_query($koneksi, "UPDATE sepatu SET sepatu_stok = sepatu_stok - $jumlah_barang WHERE sepatu_id = '$id_barang'");
    
    if (!$sql_kurangi_stok) {
        echo "Error updating stock: " . mysqli_error($koneksi);
        exit();
    }
}
$sql_pembelian =  mysqli_query($koneksi,"INSERT INTO pembelian (pembeli_id, pembelian_tanggal) VALUES ('$user_id', '$tanggal_pembelian')");

// Eksekusi query pembelian
if ($sql_pembelian == TRUE) {
    // Query untuk menghapus barang dari keranjang (contoh: tabel keranjang)
    $sql_hapus_keranjang = mysqli_query($koneksi,"DELETE FROM keranjang WHERE pembeli_id = '$user_id'");

} else {
    echo "Error: " . $sql_pembelian . "<br>" . $conn->error;
}
} else {
echo "<p>Form tidak dikirim. Silakan kembali ke halaman sebelumnya.</p>";
}

// Eksekusi query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Solemate | Purchase Verification</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="checkout.css" />
</head>
<body>
<div class="wrapper">
        <div class="container">
            <div class="success-section">
                <div class="check-icon">
                    <span class="icon-line line-tip"></span>
                    <span class="icon-line line-long"></span>
                    <div class="icon-circle"></div>
                    <div class="icon-fix"></div>
                </div>
            </div>

            <div class="title-section">
                <h2 class="title">Your Order Has Been Processed</h2>
                <p class="para">Thank you wholeheartedly for choosing Solemate!</p>
            </div>

            <div class="customer-info">
            <?php
            echo "<p>ID Pembeli: $user_id</p>";
            echo "<p>Tanggal Pembelian: $tanggal_pembelian</p>";
            ?>
            </div>

            <div class="submit-btn">
                <a href="shoppage.php" class="btn" id="gallery">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>