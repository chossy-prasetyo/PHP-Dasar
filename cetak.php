<?php 

require_once __DIR__ . '/vendor/autoload.php';

require 'function.php';

$kader = read('SELECT * FROM kader ORDER BY nama ASC');

$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/cetak.css">
	<title>Document</title>
</head>
<body>
	<h1>Kader Bengkulu</h1>

	<table border="1" cellspacing="0" cellpadding="10">
	  <thead>
	    <tr>
	      <th scope="col">No</th>
	      <th scope="col">Foto</th>
	      <th scope="col">Nama</th>
	      <th scope="col">Asal</th>
	      <th scope="col">Jurusan</th>
	      <th scope="col">Golongan Darah</th>
	      <th scope="col">Email</th>
	    </tr>
  	</thead>
	  <tbody>';

	  $no = 1;
	  foreach($kader as $k){
	  	$html .= '
	  		<tr>
	  			<td align="center">'.$no++.'</td>
	  			<td><img src="img/'.$k["foto"].'" width="50"></img></td>
	  			<td>'.$k["nama"].'</td>
	  			<td>'.$k["asal"].'</td>
	  			<td>'.$k["jurusan"].'</td>
	  			<td align="center">'.$k["goldar"].'</td>
	  			<td>'.$k["email"].'</td>
	  		</tr>
	  	';
	  }

$html .= '
		</tbody>
	</table>
</body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output('kader-bengkulu.pdf',"I");
?>

