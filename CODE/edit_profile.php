<?php
include 'konek.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

// Fetch user data for pre-filling the form
$select_user = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id = $user_id") or die('Query failed');
if (mysqli_num_rows($select_user) > 0) {
    $fetch_user = mysqli_fetch_assoc($select_user);
}

// Handle form submission for updating user data
if (isset($_POST['update_profile'])) {
    // Retrieve updated data from the form
    $new_username = mysqli_real_escape_string($koneksi, $_POST['new_username']);
    $new_email = mysqli_real_escape_string($koneksi, $_POST['new_email']);
    $new_pass = mysqli_real_escape_string($koneksi, $_POST['new_password']);
    $new_alamat = mysqli_real_escape_string($koneksi, $_POST['new_alamat']);
    $new_telepon = mysqli_real_escape_string($koneksi, $_POST['new_telepon']);
    // Update user data in the database
    $update_user_query = mysqli_query($koneksi, "UPDATE user SET user_name = '$new_username', user_email = '$new_email', user_password = '$new_pass',user_alamat='$new_alamat',user_telepon='$new_telepon' WHERE user_id = '$user_id'");

    if ($update_user_query) {
        header('location: profil.php'); // Redirect to the profile page after updating
    } else {
        $message[] = 'Failed to update user data.';
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
    <link rel="stylesheet" href="editprofile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

<div class="container">

<div class="wrapper">
        <div class="wrapper1">

        <?php
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
            }
        }
        ?>

        <form method="post" action="">
        <h1>Edit Profile</h1>
        <div class="input-box">
                    <div class="input-field">
            <input type="text" id="new_username" name="new_username" value="<?php echo $fetch_user['user_name']; ?>" required>
            <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-field">
            <input type="email" id="new_email" name="new_email" value="<?php echo $fetch_user['user_email']; ?>" required>
            <i class='bx bxs-envelope' ></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="input-field">
                    <input type="text" id="new_telepon" name="new_telepon" value="<?php echo $fetch_user['user_telepon']; ?>" required>
                    <i class='bx bxs-phone' ></i>
                    </div>
                    <div class="input-field">
		    <input type="text" id="new_password" name="new_password" value="<?php echo $fetch_user['user_password']; ?>" required>
            <i class='bx bxs-lock-alt' ></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="input-field">
		    <input type="text" id="new_alamat" name="new_alamat" value="<?php echo $fetch_user['user_alamat']; ?>" required>
            <i class='bx bxs-home'></i>
                    </div>
                </div>
		    
                <div class="button">
                    <button type="submit" class="btn" name="update_profile">Update Profile</button>
                    <button type="submit" class="btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>