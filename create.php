<?php
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}

require 'function.php';

if(isset($_POST['submit'])){
	if(create($_POST) > 0){
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

include 'templates/header.php';
?>

	<title>Tambah Kader</title>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-6">
				<div class="card mt-3 shadow-lg">
				  <div class="card-header text-light bg-dark text-center">
				    <h5>Tambah Kader</h5>		  	
				  </div>
				  <div class="card-body">
				    <form action="" method="post" enctype="multipart/form-data">
				    	  <div class="form-group row">
							    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="asal" class="col-sm-2 col-form-label">Asal</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="asal" name="asal" required autocomplete="off">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="jurusan" name="jurusan" required autocomplete="off">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="goldar" class="col-sm-4 col-form-label">Golongan Darah</label>
							    <div class="col-sm-8">
					          <select class="form-control" id="goldar" name="goldar">
								      <option value="A">A</option>
								      <option value="B">B</option>
								      <option value="AB">AB</option>
								      <option value="O">O</option>
								    </select>
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="email" class="col-sm-2 col-form-label">Email</label>
							    <div class="col-sm-10">
							      <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
							    <div class="col-sm-10">
							      <input type="file" class="form-control-file" id="foto" name="foto">
							    </div>
							  </div>
						    <button class="btn btn-dark float-right ml-2" type="submit" name="submit">Tambah</button>
						    <a href="index.php" class="btn btn-secondary float-right" onclick="return confirm('batalkan tambah kader ?');">Batal</a>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>
	
<?php include 'templates/footer.php'; ?>