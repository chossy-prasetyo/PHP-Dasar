<?php
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}

$conn = mysqli_connect('localhost','root','','phpdasar');

if(isset($_POST['submit'])){

	$nama = htmlspecialchars($_POST['nama']);
	$asal = htmlspecialchars($_POST['asal']);
	$jurusan = htmlspecialchars($_POST['jurusan']);
	$goldar = htmlspecialchars($_POST['goldar']);
	$email = htmlspecialchars($_POST['email']);

	$namaFoto = $_FILES['foto']['name'];
	$errorFoto = $_FILES['foto']['error'];
	$tmpFoto = $_FILES['foto']['tmp_name'];

	if($errorFoto === 4){
		echo "<script>
						alert('foto belum diupload');
						document.location.href = 'create.php';
					</script>";
		die;
	}

	$ekstensiLegalFoto = ['jpg','jpeg','png'];
	$ekstensiFoto = explode('.',$namaFoto);
	$ekstensiFoto = strtolower(end($ekstensiFoto));

	if(!in_array($ekstensiFoto,$ekstensiLegalFoto)){
		echo "<script>
						alert('yang diupload bukan foto');
						document.location.href = 'create.php';
					</script>";
		die;
	}

	$namaBaruFoto = uniqid();
	$namaBaruFoto .= '.';
	$namaBaruFoto .= $ekstensiFoto;

	move_uploaded_file($tmpFoto,'../img/'.$namaBaruFoto);
	$foto = $namaBaruFoto;

	$query = "INSERT INTO kader VALUES 
		('','$nama','$asal','$jurusan','$goldar','$email','$foto')
	";
	mysqli_query($conn,$query);

	if(mysqli_affected_rows($conn) > 0){
		echo '<script>
						alert("kader berhasil ditambahkan");
						document.location.href = "index.php";
					</script>';
	} else{
		echo '<script>
						alert("kader gagal ditambahkan");
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
	<style>
		a {
			text-decoration: none;
			color: black;
		}

		button {
			padding: 10px;
		}
	</style>
	<title>Tambah Kader</title>
</head>
<body>
	<h2>Tambah Kader</h2>
	<form action="" method="post" enctype="multipart/form-data">
		<table cellpadding="8">
			<tbody>
				<tr>
					<td><label for="nama">Nama</label></td>
					<td>: <input type="text" name="nama" id="nama" required autocomplete="off"></td>
				</tr>
				<tr>
					<td><label for="asal">Asal</label></td>
					<td>: <input type="text" name="asal" id="asal" required autocomplete="off"></td>
				</tr>
				<tr>
					<td><label for="jurusan">Jurusan</label></td>
					<td>: <input type="text" name="jurusan" id="jurusan" required autocomplete="off"></td>
				</tr>
				<tr>
					<td><label for="goldar">Golongan Darah</label></td>
					<td>: <select name="goldar" id="goldar">
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="AB">AB</option>
									<option value="O">O</option>
								</select>
					</td>
				</tr>
				<tr>
					<td><label for="email">Email</label></td>
					<td>: <input type="email" name="email" id="email" required autocomplete="off"></td>
				</tr>
				<tr>
					<td><label for="foto">Foto</label></td>
					<td>: <input type="file" name="foto" id="foto"></td>
				</tr>
				<tr>
					<td colspan="2">
						<button onclick="return confirm('batalkan tambah kader ?');"><a href="index.php">Batal</a></button>
						<button type="submit" name="submit">Tambah</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</body>
</html>