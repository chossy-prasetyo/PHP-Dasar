<?php
session_start();
if(isset($_SESSION['login'])){
	header('Location: index.php');
	exit;
}

$conn = mysqli_connect('localhost','root','','phpdasar');

if(isset($_POST['login'])){
	$username = $_POST['username'];

	$result = mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");
	if(mysqli_num_rows($result) === 1){
		$password = $_POST['password'];
		$account = mysqli_fetch_assoc($result);

		if(password_verify($password,$account['password'])){
			$_SESSION['login'] = true;
			header('Location: index.php');
			exit;
		}	else{
			$error = 'password salah';
		}
	} else{
		$error = "username tidak terdaftar, registrasi terlebih dahulu, klik link di bawah!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<h2>Login Page</h2>
	<?php if(isset($error)): ?>
		<p style="color: red; font-style: italic;"><?= $error; ?></p>
	<?php endif; ?>
	<form action="" method="post">
		<table cellpadding="8">
			<tbody>
				<tr>
					<td><label for="username">Username</label></td>
					<td>: <input type="text" name="username" id="username" required autocomplete="off"></td>
				</tr>
				<tr>
					<td><label for="password">Password</label></td>
					<td>: <input type="password" name="password" id="password" required autocomplete="off"></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center;">
						<button type="submit" name="login" style="padding: 10px;">Login</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<p style="font-size: 12px;">belum ada account ? klik link di bawah untuk registrasi</p>
	<a href="registrasi.php" style="margin-left: 90px; text-decoration: none;">Registrasi</a>
</body>
</html>