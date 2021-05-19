<?php
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}

require 'function.php';

$kader = read('SELECT * FROM kader ORDER BY nama ASC');

if(isset($_POST['search'])){
	$kader = search($_POST['keyword']);
}

include 'templates/header.php';
?>
	
	<style>
		@media print {
			.tambah-kader,
			.logout,
			.search,
			.aksi { display: none; }
		}
	</style>
  <title>Kader Bengkulu</title>
</head>
<body>
	<div class="container text-center">
		<h2 class="my-4">Daftar Kader Bengkulu</h2>
		<div class="row">
			<div class="col-4 mx-auto">
				<div class="row mb-4">
					<div class="col-8">
						<a href="create.php" class="btn btn-dark btn-block tambah-kader">Tambah Kader</a>				
					</div>
					<div class="col-4">
						<a href="logout.php" class="btn btn-warning btn-block logout" onclick="return confirm('logout ?');">Logout</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-4 mx-auto mb-4">
				<form action="" method="post">
					<div class="row">
						<div class="col-8">
							<div class="input-group search">
							  <input type="text" class="form-control" placeholder="cari kader" name="keyword" autocomplete="off" id="keyword">
							  <div class="input-group-append">
							    <button class="btn btn-dark" type="submit" name="search">Cari</button>
							  </div>
							</div>
						</div>
						<div class="col-4">
							<a href="cetak.php" class="btn btn-info btn-block" target="_blank">Cetak</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="live">
			<table class="table table-striped shadow">
			  <thead>
			    <tr>
			      <th scope="col">No</th>
			      <th scope="col">Foto</th>
			      <th scope="col">Nama</th>
			      <th scope="col">Asal</th>
			      <th scope="col">Jurusan</th>
			      <th scope="col">Golongan Darah</th>
			      <th scope="col">Email</th>
			      <th scope="col" class="aksi">Aksi</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $no=1; foreach($kader as $k): ?>
			  		<tr>
			  			<td><?= $no; ?></td>
			  			<td><img src="img/<?= $k['foto']; ?>"></td>
			  			<td><?= $k['nama']; ?></td>
			  			<td><?= $k['asal']; ?></td>
			  			<td><?= $k['jurusan']; ?></td>
			  			<td><?= $k['goldar']; ?></td>
			  			<td><?= $k['email']; ?></td>
			  			<td class="aksi">
			  				<a href="update.php?id=<?= $k['id']; ?>" class="badge badge-success">edit</a>
			  				<a href="delete.php?id=<?= $k['id']; ?>" class="badge badge-danger" onclick="return confirm('hapus <?= $k["nama"]; ?> ?');">delete</a>
			  			</td>
			  		</tr>
			  	<?php $no++; endforeach; ?>
			  </tbody>
			</table>
		</div>

		<table border="1" cellpadding="10" cellspacing="0">
			<thead>
				<tr>
					<td>Golongan Darah</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>A</td>
				</tr>
			</tbody>
		</table>
	</div>

<?php include 'templates/footer.php'; ?>