<?php 
require 'function.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM kader WHERE
						nama LIKE '%$keyword%' OR
						asal LIKE '%$keyword%' OR
						jurusan LIKE '%$keyword%' OR
						goldar LIKE '%$keyword%'
					ORDER BY nama ASC";
$kader = read($query);
?>

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
      <th scope="col">Aksi</th>
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
  			<td>
  				<a href="update.php?id=<?= $k['id']; ?>" class="badge badge-success">edit</a>
  				<a href="delete.php?id=<?= $k['id']; ?>" class="badge badge-danger" onclick="return confirm('hapus <?= $k["nama"]; ?> ?');">delete</a>
  			</td>
  		</tr>
  	<?php $no++; endforeach; ?>
  </tbody>
</table>
