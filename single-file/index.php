<?php 
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}

$conn = mysqli_connect('localhost','root','','phpdasar');
$result = mysqli_query($conn,'SELECT * FROM kader ORDER BY nama ASC');
$kader = [];
while($hasil = mysqli_fetch_assoc($result)){
	$kader[] = $hasil;
}

if(isset($_POST['search'])){
	$keyword = $_POST['keyword'];

	$query = "SELECT * FROM kader WHERE
							nama LIKE '%$keyword%' OR
							asal LIKE '%$keyword%' OR
							jurusan LIKE '%$keyword%' OR
							goldar LIKE '%$keyword%'
						ORDER BY nama ASC";
						
	$result = mysqli_query($conn,$query);
	$kader = [];
	while($hasil = mysqli_fetch_assoc($result)){
		$kader[] = $hasil;
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
	</style>
	<title>Kader Bengkulu</title>
</head>
<body>
	<h2>Daftar Kader Bengkulu</h2>
	<div style="margin-bottom: 30px;">
		<button style="padding: 10px;"><a href="create.php">Tambah Kader</a></button>
		<button style="padding: 10px;" onclick="return confirm('logout ?');"><a href="logout.php">Logout</a></button>
	</div>
	<form action="" method="post" style="margin-bottom: 30px;">
		<input type="text" name="keyword" placeholder="cari kader" autocomplete="off" id="keyword">
		<button type="submit" name="search">Cari</button>
	</form>
	<div id="container">
		<table border="1" cellspacing="0" cellpadding="10">
			<thead>
				<th>No</th>
				<th>Foto</th>
				<th>Nama</th>
				<th>Asal</th>
				<th>Jurusan</th>
				<th>GolDar</th>
				<th>Email</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				<?php $no = 1; foreach($kader as $k): ?>
					<tr>
						<td><?= $no; ?></td>
						<td><img src="../img/<?= $k['foto']; ?>"></td>
						<td><?= $k['nama']; ?></td>
						<td><?= $k['asal']; ?></td>
						<td><?= $k['jurusan']; ?></td>
						<td align="center"><?= $k['goldar']; ?></td>
						<td><?= $k['email']; ?></td>
						<td>
							<button><a href="update.php?id=<?= $k['id']; ?>">edit</a></button>
							<button><a href="delete.php?id=<?= $k['id']; ?>" onclick="return confirm('hapus <?= $k["nama"] ?> ?');">delete</a></button>
						</td>
					</tr>
				<?php $no++; endforeach; ?>
			</tbody>
		</table>
	</div>

	<script src="script.js"></script>
</body>
</html>