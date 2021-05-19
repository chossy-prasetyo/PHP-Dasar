<?php
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}

$goldar = ['A','B','AB','O'];

require 'function.php';

$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM kader WHERE id=$id");
$kader = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
	if(update($_POST) > 0){
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

include 'templates/header.php';
?>

	<title>Edit Kader</title>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-6">
				<div class="card mt-3 shadow-lg">
				  <div class="card-header text-light bg-dark text-center">
				    <h5>Edit Data Kader</h5>		  	
				  </div>
				  <div class="card-body">
				    <form action="" method="post" enctype="multipart/form-data">
				    	  <div class="form-group row">
							    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
							    <div class="col-sm-10">
							    	<input type="hidden" class="form-control" value="<?= $kader['id']; ?>" name="id">
							    	<input type="hidden" class="form-control" name="fotolama" value="<?= $kader['foto']; ?>">
							      <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off" value="<?= $kader['nama']; ?>">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="asal" class="col-sm-2 col-form-label">Asal</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="asal" name="asal" required autocomplete="off" value="<?= $kader['asal']; ?>">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="jurusan" name="jurusan" required autocomplete="off" value="<?= $kader['jurusan']; ?>">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="goldar" class="col-sm-4 col-form-label">Golongan Darah</label>
							    <div class="col-sm-8">
					          <select class="form-control" id="goldar" name="goldar">
					          	<?php foreach($goldar as $goldar): ?>
					          		<?php if($goldar == $kader['goldar']): ?>
								      		<option value="<?= $goldar; ?>" selected><?= $goldar ?></option>
								      	<?php else: ?>
								      		<option value="<?= $goldar; ?>"><?= $goldar ?></option>
								      	<?php endif; ?>
								      <?php endforeach; ?>
								    </select>
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="email" class="col-sm-2 col-form-label">Email</label>
							    <div class="col-sm-10">
							      <input type="email" class="form-control" id="email" name="email" required autocomplete="off" value="<?= $kader['email']; ?>">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
							    <div class="col-sm-10" style="display: flex; align-items: center;">
							    	<img src="img/<?= $kader['foto']; ?>" class="rounded mr-2 shadow">
							      <input type="file" class="form-control-file" id="foto" name="foto">
							    </div>
							  </div>
						    <button class="btn btn-dark float-right ml-2" type="submit" name="submit" onclick="return confirm('ubah data ?');">Ubah</button>
						    <a href="index.php" class="btn btn-secondary float-right" onclick="return confirm('batalkan edit data ?');">Batal</a>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>

<?php include 'templates/footer.php'; ?>