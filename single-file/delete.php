<?php
session_start();
if(!isset($_SESSION['login'])){
	header('Location: login.php');
	exit;
}

$id = $_GET['id'];

$conn = mysqli_connect('localhost','root','','phpdasar');
mysqli_query($conn,"DELETE FROM kader WHERE id=$id");

if(mysqli_affected_rows($conn) > 0){
	echo '<script>
					alert("kader berhasil dihapus");
					document.location.href = "index.php";
				</script>';
} else{
	echo '<script>
					alert("kader gagal dihapus");
				</script>';
}
?>