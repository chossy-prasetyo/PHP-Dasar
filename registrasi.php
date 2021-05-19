<?php
session_start();
if(isset($_SESSION['login'])){
	header('Location: index.php');
	exit;
}

require 'function.php';

if(isset($_POST['daftar'])){
	if(registrasi($_POST) > 0){
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

include 'templates/header.php';
?>

	<title>Registrasi</title>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-6">
				<div class="card mt-3 shadow-lg">
				  <div class="card-header text-light bg-dark text-center">
				    <h5>Form Registrasi</h5>		  	
				  </div>
				  <div class="card-body">
				    <form action="" method="post">
				    	  <div class="form-group row">
							    <label for="username" class="col-sm-4 col-form-label">Username</label>
							    <div class="col-sm-8">
							      <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="password" class="col-sm-4 col-form-label">Password</label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
							    </div>
							  </div>
				    	  <div class="form-group row">
							    <label for="password2" class="col-sm-4 col-form-label">Ulangi Password</label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="password2" name="password2" required autocomplete="off">
							    </div>
							  </div>
							  <div class="row justify-content-center">
							  	<div class="col-6 text-center">
								    <button class="btn btn-dark btn-block mb-3" type="submit" name="daftar">Daftar</button>
								    <a href="login.php">kembali ke halaman login</a>
							  	</div>
							  </div>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>
	
<?php include 'templates/footer.php'; ?>