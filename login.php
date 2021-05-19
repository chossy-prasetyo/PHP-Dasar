<?php
session_start();
if(isset($_SESSION['login'])){
	header('Location: index.php');
	exit;
}

require 'function.php';

if(isset($_POST['login'])){
	if(login($_POST) === 1){
		$_SESSION['login'] = true;
		header('Location: index.php');
		exit;
	} elseif(login($_POST) === 2){
		$error = 'username tidak terdaftar, registrasi terlebih dahulu, klik link di bawah!';
	} elseif(login($_POST) === 3){
		$error = 'password salah';		
	}
}

include 'templates/header.php';
?>

	<title>Login</title>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-6">
				<div class="card mt-3 shadow-lg">
				  <div class="card-header text-light bg-dark text-center">
				    <h5>Login Page</h5>		  	
				  </div>
				  <div class="card-body">
				  	<div class="row">
				  		<div class="col">
				  			<?php if(isset($error)): ?>
							  	<small class="form-text text-danger mb-3 text-danger text-center"><?= $error; ?></small>
				  			<?php endif; ?>
				  		</div>
				  	</div>
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
							  <div class="row justify-content-center">
							  	<div class="col-6 text-center">
								    <button class="btn btn-dark btn-block" type="submit" name="login">Login</button>
							  	</div>
							  </div>
							  <div class="row">
							  	<div class="col text-center">
							  		<small class="form-text text-muted my-3">belum ada account ? klik link di bawah untuk registrasi</small>
							  		<a href="registrasi.php">Registrasi</a>
							  	</div>
							  </div>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>
	
<?php include 'templates/footer.php'; ?>