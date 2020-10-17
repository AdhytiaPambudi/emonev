<!DOCTYPE html>
<html>
<head>
	<title>DATA BINWAS</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
		vertical-align: middle;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
	$outputDaerah = str_replace(' ', '-', $daerah->nm_daerah);
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data-Binwas-".$thn."-".$daerah->ket."-".$outputDaerah.".xls");
	?>

	<center>
		<h1>KERTAS KERJA PENILAIAN INDIKATOR ITJEN T.A <?=$thn; ?><br/> <?= strtoupper($daerah->ket) .' '. $daerah->nm_daerah; ?> </h1>
	</center>

	<table border="1">
		<tr>
			<th style="background-color:#ccc;">NO</th>
			<th style="background-color:#ccc;">INDIKATOR</th>
			<th style="background-color:#ccc;">TARGET</th>
			<th style="background-color:#ccc;">SUB INDIKATOR</th>
			<th style="background-color:#ccc;">PARAMETER</th>
			<th style="background-color:#ccc;">SUB PARAMETER</th>
			<th style="background-color:#ccc;">PENILAIAN</th>
			<th style="background-color:#ccc;">BOBOT</th>
		</tr>
		
	</table>
</body>
</html>