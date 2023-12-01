<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solemate | Register</title>
    <link rel="stylesheet" href="register.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
	<form action="prosesdaftar.php" method="POST"> 
            <h1>Registration</h1>
            <div class="input-box">
                <div class="input-field">  
		<fieldset>
			<input type="text" name="user_name" placeholder="Full Name" required>
			<i class='bx bxs-user'></i>
    	</div>
		<div class="input-field">
		<input type="text" name="user_email" placeholder="Email" required>
		<i class='bx bxs-envelope' ></i>
    </div>
</div>
<div class="input-box">
                <div class="input-field">
			<input type="text" name="penjual_telepon" placeholder="Phone Number" required>
			<i class='bx bxs-phone' ></i>
        </div>	
		<div class="input-field">
		<input type="text" name="user_password" placeholder="Password" required>
		<i class='bx bxs-lock-alt' ></i>
    </div>
</div>
<label><input type="checkbox">I hereby declare that the above information provided is true and correct</label>

            <button type="submit" class="btn" name="daftar">Register</button>
        </form>
    </div>
</body>
</html>	