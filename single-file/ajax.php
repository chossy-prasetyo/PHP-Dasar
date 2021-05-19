<?php 
$keyword = $_GET['keyword'];

$conn = mysqli_connect('localhost','root','','phpdasar');
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
?>

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
				<td><?= $k['goldar']; ?></td>
				<td><?= $k['email']; ?></td>
				<td>
					<button><a href="update.php?id=<?= $k['id']; ?>">edit</a></button>
					<button><a href="delete.php?id=<?= $k['id']; ?>" onclick="return confirm('hapus <?= $k["nama"] ?> ?');">delete</a></button>
				</td>
			</tr>
		<?php $no++; endforeach; ?>
	</tbody>
</table>
