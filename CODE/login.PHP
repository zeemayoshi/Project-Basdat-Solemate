<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form in HTML and CSS | Codehal</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
</head>
<body>

<div class="wrapper">
         

   <form action="proseslogin.php" method="post">
   <h1>Login</h1>
            <div class="input-box">

      <input type="email" name="user_email" required placeholder="Email" required>
      <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
      <input type="password" name="user_password" placeholder="Password" required>
      <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
      <input type="submit" name="login" class="btn" value="Login">
      <div class="register-link">
                <p>Don't have an account? <a href="formpendaftaran.php">Register</a></p>
            </div>
   </form>

</div>

</body>
</html>