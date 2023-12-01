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
   <title>Edit Profile</title>

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <div class="user-profile">
        <h2>Edit Profile</h2>
        <?php
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
            }
        }
        ?>

        <form method="post" action="">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" value="<?php echo $fetch_user['user_name']; ?>" required>

            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" value="<?php echo $fetch_user['user_email']; ?>" required>
    
            <label>Password: </label>
		    <input type="text" id="new_password" name="new_password" value="<?php echo $fetch_user['user_password']; ?>" required>

            <label>Alamat: </label>
		    <input type="text" id="new_alamat" name="new_alamat" value="<?php echo $fetch_user['user_alamat']; ?>" required>

            <label>No.Telp: </label>
		    <input type="text" id="new_telepon" name="new_telepon" value="<?php echo $fetch_user['user_telepon']; ?>" required>

            <button type="submit" name="update_profile">Update Profile</button>
        </form>

        <a href="profil.php">Back to Profile</a>
    </div>

</div>

</body>
</html>