<?php
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}

$goldar = ['A','B','AB','O'];

$id = $_GET['id'];

$conn = mysqli_connect('localhost','root','','phpdasar');
$result = mysqli_query($conn,"SELECT * FROM kader WHERE id=$id");
$kader = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){

	$id = $_POST['id'];
	$nama = htmlspecialchars($_POST['nama']);
	$asal = htmlspecialchars($_POST['asal']);
	$jurusan = htmlspecialchars($_POST['jurusan']);
	$goldar = htmlspecialchars($_POST['goldar']);
	$email = htmlspecialchars($_POST['email']);
	$fotolama = $_POST['fotolama'];

	if($_FILES['foto']['error'] === 4){
		$foto = $fotolama;
	} else{
		$namaFoto = $_FILES['foto']['name'];
		$errorFoto = $_FILES['foto']['error'];
		$tmpFoto = $_FILES['foto']['tmp_name'];

		$ekstensiLegalFoto = ['jpg','jpeg','png'];
		$ekstensiFoto = explode('.',$namaFoto);
		$ekstensiFoto = strtolower(end($ekstensiFoto));

		if(!in_array($ekstensiFoto,$ekstensiLegalFoto)){
			echo "<script>
							alert('yang diupload bukan foto');
							document.location.href = 'update.php';
						</script>";
			die;
		}

		$namaBaruFoto = uniqid();
		$namaBaruFoto .= '.';
		$namaBaruFoto .= $ekstensiFoto;

		move_uploaded_file($tmpFoto,'../img/'.$namaBaruFoto);
		$foto = $namaBaruFoto;
	}

	$query = "UPDATE kader SET 
							nama = '$nama',
							asal = '$asal',
							jurusan = '$jurusan',
							goldar = '$goldar',
							email = '$goldar',
							foto = '$foto'
						WHERE id=$id";
	mysqli_query($conn,$query);

	if(mysqli_affected_rows($conn) > 0){
		echo '<script>
						alert("data kader berhasil diubah");
						document.location.href = "index.php";
					</script>';
	} else{
		echo '<script>
						alert("data kader gagal diubah");
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
	<title>Edit Kader</title>
</head>
<body>
	<h2>Edit Data Kader</h2>
	<form action="" method="post" enctype="multipart/form-data">
		<table cellpadding="10">
			<tbody>
				<tr>
					<td><label for="nama">Nama</label></td>
					<td>: 
						<input type="hidden" value="<?= $kader['id']; ?>" name="id">
						<input type="hidden" value="<?= $kader['foto']; ?>" name="fotolama">
						<input type="text" name="nama" id="nama" required autocomplete="off" value="<?= $kader['nama']; ?>"></td>
				</tr>
				<tr>
					<td><label for="asal">Asal</label></td>
					<td>: <input type="text" name="asal" id="asal" required autocomplete="off" value="<?= $kader['asal']; ?>"></td>
				</tr>
				<tr>
					<td><label for="jurusan">Jurusan</label></td>
					<td>: <input type="text" name="jurusan" id="jurusan" required autocomplete="off" value="<?= $kader['jurusan']; ?>"></td>
				</tr>
				<tr>
					<td><label for="goldar">Golongan Darah</label></td>
					<td>: 
						<select name="goldar" id="goldar">
							<?php foreach($goldar as $goldar): ?>
								<?php if($goldar == $kader['goldar']): ?>
									<option value="<?= $goldar; ?>" selected><?= $goldar; ?></option>
								<?php else: ?>
									<option value="<?= $goldar; ?>"><?= $goldar; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for="email">Email</label></td>
					<td>: <input type="email" name="email" id="email" required autocomplete="off" value="<?= $kader['email']; ?>"></td>
				</tr>
				<tr>
					<td><label for="foto">Foto</label></td>
					<td style="display: flex; align-items: center;">: 
						<img src="../img/<?= $kader['foto']; ?>" style="margin: 0 5px;">
						<input type="file" name="foto" id="foto">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<button onclick="return confirm('batalkan edit data kader ?');"><a href="index.php">Batal</a></button>
						<button type="submit" name="submit" onclick="return confirm('ubah data kader ?');">Ubah</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</body>
</html>