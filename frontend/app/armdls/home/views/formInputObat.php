<!DOCTYPE html>
<html>
<head>
	<title>Tambah Obat</title>
	<link rel="stylesheet" href="assets/bootstrap/css/w3.css">
	<link rel="stylesheet" href="assets/bootstrap/css/w3-black.css">
</head>
</head>
<body>
	<!--<form method="post" action="(action dari input obat menjadi form))">-->
	<div text align="center">
		<h2>Tambah Obat</h2>
	</div>
		
	<table width=100% border=1 class="table-data">
		<tr>
			<td>Nama Obat</td>
			<td ><input type="text" name="Obat" size="30"></td></tr>

			<td >Kategori Obat</td>
				<td >
					<select name="kat">
						<option value="">Kode Obat</option>
						<optgroup label="Obat Kategori">
							<option value="Obat Luar">Ol (Obat Luar)</option>
							<option value="Obat Dalam">OD (Obat Dalam)</option>
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

