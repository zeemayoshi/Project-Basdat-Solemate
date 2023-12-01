<?php
session_start();
include 'konek.php';
// Proses formulir login
if (isset($_POST['login'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    // Lindungi dari serangan SQL injection
    $email = mysqli_real_escape_string($koneksi, $email);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Query untuk memeriksa keberadaan pengguna
    $query = "SELECT user_id FROM user WHERE user_email = '$email' AND user_password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if ($result->num_rows == 1) {
        // Pengguna ditemukan, atur session user_id
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];

        // Redirect ke halaman dashboard atau halaman lain
        header("Location: shoppage.php");
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}

?>

