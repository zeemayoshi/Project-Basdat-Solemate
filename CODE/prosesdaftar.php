<?php
require 'konek.php';
if (isset($_POST['daftar'])){
    $username = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $jk = $_POST['user_JK'];
    $telepon = $_POST['penjual_telepon'];
    $alamat_kirim = $_POST['alamat_kirim'];

    // Masukkan data ke tabel user
    $insert = mysqli_query($koneksi,"INSERT INTO user(user_name,user_email,user_password,user_JK,user_telepon,user_alamat) VALUEs('$username', '$email', '$password', '$jk','$telepon','$alamat_kirim' )");
    $user_id= mysqli_insert_id($koneksi);
    // Masukkan data ke tabel penjual atau pembeli sesuai dengan tipe pengguna
    if( $insert==TRUE ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: login.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.ph dengan status=gagal
        header('Location: login.php?status=gagal');
    }
} 
?>
