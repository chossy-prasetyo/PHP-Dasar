<?php
session_start();
if(isset($_SESSION['login'])){
	header('Location: index.php');
	exit;
}

$conn = mysqli_connect('localhost','root','','phpdasar');

if(isset($_POST['daftar'])){
	$username = strtolower(stripslashes($_POST['username']));

	$result = mysqli_query($conn,"SELECT username FROM user WHERE username='$username'");
	if(mysqli_fetch_assoc($result)){
		echo "<script>
						alert('username sudah terdaftar');
						document.location.href = 'registrasi.php';
					</script>";
		die;
	}

	$password = mysqli_real_escape_string($conn,$_POST['password']);
	$password2 = mysqli_real_escape_string($conn,$_POST['password2']);

	if($password2 !== $password){
		echo "<script>
						alert('konfirmasi password salah');
						document.location.href = 'registrasi.php';
					</script>";
		die;
	}

	$password = password_hash($password,PASSWORD_DEFAULT);

	$query = "INSERT INTO user VALUES ('','$username','$password')";
	mysqli_query($conn,$query);

	if(mysqli_affected_rows($conn) > 0){
		echo '<script>
						alert("registrasi berhasil");
						document.location.href = "index.php";
					</script>';
	} else{
		echo '<script>
						alert("registrasi gagal");
					</script>';
		echo mysqli_error($conn);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrasi</title>
</head>
<body>
	<h2>Form Registrasi</h2>
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
					<td><label for="password2">Ulangi Password</label></td>
					<td>: <input type="password" name="password2" id="password2" required autocomplete="off"></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center;">
						<button type="submit" name="daftar" style="padding: 10px;">Daftar</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<a href="login.php" style="margin-left: 90px; text-decoration: none;">kembali ke halaman login</a>
</body>
</html>