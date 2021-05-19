<?php 
$conn = mysqli_connect('localhost','root','','phpdasar');

function read($query){
	global $conn;

	$result = mysqli_query($conn,$query);
	$kader = [];
	while($hasil = mysqli_fetch_assoc($result)){
		$kader[] = $hasil;
	}
	return $kader;
}

function create($data){
	global $conn;

	$nama = htmlspecialchars($data['nama']);
	$asal = htmlspecialchars($data['asal']);
	$jurusan = htmlspecialchars($data['jurusan']);
	$goldar = htmlspecialchars($data['goldar']);
	$email = htmlspecialchars($data['email']);

	$foto = upload();
	if(!$foto){
		return false;
	}

	$query = "INSERT INTO kader VALUES 
		('','$nama','$asal','$jurusan','$goldar','$email','$foto')
	";
	mysqli_query($conn,$query);

	return mysqli_affected_rows($conn);
}

function upload(){
	$namaFoto = $_FILES['foto']['name'];
	$errorFoto = $_FILES['foto']['error'];
	$tmpFoto = $_FILES['foto']['tmp_name'];

	if($errorFoto === 4){
		echo "<script>
						alert('foto belum diupload');
						document.location.href = 'create.php';
					</script>";
	}

	$ekstensiLegalFoto = ['jpg','jpeg','png'];
	$ekstensiFoto = explode('.',$namaFoto);
	$ekstensiFoto = strtolower(end($ekstensiFoto));

	if(!in_array($ekstensiFoto,$ekstensiLegalFoto)){
		echo "<script>
						alert('yang diupload bukan foto');
						document.location.href = 'create.php';
					</script>";
	}

	$namaBaruFoto = uniqid();
	$namaBaruFoto .= '.';
	$namaBaruFoto .= $ekstensiFoto;

	move_uploaded_file($tmpFoto,'img/'.$namaBaruFoto);
	return $namaBaruFoto;
}

function delete($id){
	global $conn;

	mysqli_query($conn,"DELETE FROM kader WHERE id=$id");
	return mysqli_affected_rows($conn);
}

function update($data){
	global $conn;

	$id = $data['id'];
	$nama = htmlspecialchars($data['nama']);
	$asal = htmlspecialchars($data['asal']);
	$jurusan = htmlspecialchars($data['jurusan']);
	$goldar = htmlspecialchars($data['goldar']);
	$email = htmlspecialchars($data['email']);
	$fotolama = $data['fotolama'];

	if($_FILES['foto']['error'] === 4){
		$foto = $fotolama;
	} else{
		$foto = upload();
	}

	$query = "UPDATE kader SET 
							nama = '$nama',
							asal = '$asal',
							jurusan = '$jurusan',
							goldar = '$goldar',
							email = '$email',
							foto = '$foto'
						WHERE id=$id";
	mysqli_query($conn,$query);

	return mysqli_affected_rows($conn);
}

function search($keyword){
	$query = "SELECT * FROM kader WHERE
							nama LIKE '%$keyword%' OR
							asal LIKE '%$keyword%' OR
							jurusan LIKE '%$keyword%' OR
							goldar LIKE '%$keyword%'
						ORDER BY nama ASC";
	return read($query);
}

function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data['username']));

	$result = mysqli_query($conn,"SELECT username FROM user WHERE username='$username'");
	if(mysqli_fetch_assoc($result)){
		echo "<script>
						alert('username sudah terdaftar');
						document.location.href = 'registrasi.php';
					</script>";
		return false;
	}

	$password = mysqli_real_escape_string($conn,$data['password']);
	$password2 = mysqli_real_escape_string($conn,$data['password2']);

	if($password2 !== $password){
		echo "<script>
						alert('konfirmasi password salah');
						document.location.href = 'registrasi.php';
					</script>";
		return false;
	}

	$password = password_hash($password,PASSWORD_DEFAULT);

	$query = "INSERT INTO user VALUES ('','$username','$password')";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function login($data){
	global $conn;

	$username = $data['username'];

	$result = mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");
	
	if(mysqli_num_rows($result) === 1){

		$password = $data['password'];
		$account = mysqli_fetch_assoc($result);

		if(password_verify($password,$account['password'])){
			return 1;
		} else{
			return 3;
		}
	} else{
		return 2;
	}
}
?>