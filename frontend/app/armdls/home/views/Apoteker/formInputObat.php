<?php echo validation_errors(); ?>

<?php echo form_open('Apoteker/create'); ?>
<html>
<head>
	<title>Tambah Obat</title>
	<link rel="stylesheet" href="assets/bootstrap/css/w3.css">
	<link rel="stylesheet" href="assets/bootstrap/css/w3-black.css">
</head>
</head>
<body>
	<!--<form method="post" action="(action dari input obat menjadi form))">-->
	<?php
	<div text align="center">
		<h2>Tambah Obat</h2>
	</div>
		
	<table width=100% border=1 class="table-data">
		<tr>
			<td>ID Obat</td>
			<td ><input type="text" name="Id" size="30"></td></tr>

			<td>Nama Obat</td>
			<td ><input type="text" name="Obat" size="30"></td></tr>

			<td >Kategori Obat</td>
				<td >
					<select name="Kategori">
						<option value="">Kode Obat</option>
						<optgroup label="Obat unit">
							<option value="Botol">Botol </option>
							<option value="Pil">Pil </option>
						</optgroup>
					</select>
				</td>
			
			<tr><td class="pinggir-data">Stock Obat</td>
			<td class="pinggir-data"><input type="text" name="stock" size="15"></td></tr>

			<tr><td colspan="2" align="center" class="head-data">
			<input type="submit" value="Input">
			</td></tr>
	
		</tr>
	
	</table>
	</form>
</body>
</html>

<?php echo form_close(''); ?>