<?php
get_header();
?>
 <style>
.ui-autocomplete-loading {
background: white url('<?=base_url();?>assets/img/ajax-loader2.gif') right center no-repeat;
}
</style>
<script type="text/javascript" src="<?=base_url();?>assets/themes/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?=base_url();?>assets/themes/css/jquery-autocomplete.css">
<script>
$(function() {
$("#datepicker2").datepicker({        
		 dateFormat: "yy-mm-dd",
		 showAnim:"slide", 
    });
});

function checkdata()
{     
        var tersedia = $('#tersedia').val();
		var qty = $('#jumlah').val();
		if(qty > tersedia || qty=="0")
		{
			alert('Jumlah yang dikirim melebihi batas yang tersedia');
			$('#jumlah').val('0');
			$('#jumlah').focus();
			return false;
		}else{
			return true;
		}		
}
</script>
<script>

$(document).ready(function() {
    $("#qty_racikan").keyup(function(){
    	var qty=$("#qty_racikan").val();
    	if(Number(qty) > 0 && Number(qty) < 11)
    	{
			$("#biayajasa").val("1000");
		}else if(Number(qty) > 10 && Number(qty) < 30)
		{
			$("#biayajasa").val("2000");
		}else if(Number(qty) > 29)
		{
			$("#biayajasa").val("3000");
		}else{
			$("#biayajasa").val("0");
		}
        
    });  
});


jQuery(document).ready(function(){

	$('input[name^=namaobat]').autocomplete({		
		source:'<?=base_url('data/barang/getobat');?>', 
		minLength:2,		
		select:function(evt, ui)
		{	
			
			this.form.kode.value = ui.item.kode;
			this.form.nama_obat.value = ui.item.value;
			this.form.tersedia.value = ui.item.stok_rs;
			this.form.satuan.value = ui.item.satuan;
			this.form.harga_beli.value = ui.item.harga_beli;
			this.form.harga_jual.value = ui.item.harga_jual;
		}
	});
});

function getcart() {
    $.get('<?= base_url('apotik/penjualan/lihat');?>', function(data) {
      $('#responsecontainer').html(data);
    });
}
      $(function () {
        $('input[name=submit]').click(function (e) {
		 var tersedia = $('#tersedia').val();
		var qty = $('#jumlah').val();
		if(Number(qty) > Number(tersedia) || qty=="0")
		{
			alert('Jumlah yang dikirim melebihi batas yang tersedia');
			$('#jumlah').val('0');
			$('#jumlah').focus();
			return false;
		}else{
          $.ajax({
            type: 'get',
            url: '<?= base_url('apotik/penjualan/add');?>',
            data: $('form').serialize(),
			error: function (xhr, ajaxOptions, thrownError) {
				return false;		  	
			},			
			beforeSend: function() {
			
    		$('#responsecontainer').html("<img src='<?= base_url();?>/assets/img/ajax-loader.gif' />");
 			 },
            success: function () {			
			 	getcart();
            }
          });
          e.preventDefault();
		}
        });
      });

$(document).ready(function() {
$('#jenisresep').on('change', function() {
  var jenisresep=$(this).val();
  if(jenisresep=="Non Racikan")
  {
  	$('#jasaresep').val("300");
  }else if(jenisresep="Racikan")
  {
  	$('#jasaresep').val("0");
  }
});
 });
</script>

<?php 
$att=array(
	'class'=>"form-horizontal",
	);
echo form_open(base_url('apotik/penjualan/checkout'),$att);?>
<div class="control-group">
<label class="control-label" for="inputEmail">No MR</label>
<div class="controls">
<input type="text" id="inputEmail" name="nomr" placeholder="No MR">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Nama</label>
<div class="controls">
<input type="text" id="inputPassword" name="nama" placeholder="Nama Pasien">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputEmail">Tipe Pasien</label>
<div class="controls">
<?php
bindingcombo("kategori_pasien","tipe","id_kategori_pasien","nama_kategori");
?>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputEmail">Tanggal</label>
<div class="controls">
<input type="text"  id="datepicker2" name="tgl" placeholder="Tanggal" title="Klik dan pilih Tanggal">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Jenis Rawatan</label>
<div class="controls">
<select name="jenisrawat">
<option value="inap">Rawat Inap</option>
<option value="jalan"> Rawat Jalan</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Jumlah Racikan</label>
<div class="controls">
<input type="text" id="qty_racikan" name="qty_racikan" class="input-mini" value="0">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Jasa Racikan</label>
<div class="controls">
<input type="text" id="biayajasa" readonly="readonly" name="biayajasa" value="0">
</div>
</div>

<table id="mytable" class="table table-striped">
<thead>
<tr>
<th>Jenis Resep</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>QTY</th>
<th>Satuan</th>
<th>Harga Jual</th>
<th>Jasa</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody id="p_scents">
<tr>
<td>
	<select name="jenisresep" id="jenisresep">
		<option value="Non Racikan">Non Racikan</option>
		<option value="Racikan">Racikan</option>
	</select>
</td>
<td><input type="text" data-validation="length" readonly="readonly" data-validation-length="1-40" id="kode" class="input-mini" name="kodeobat" value="" /></td>
<td><input type="text" data-validation="length" data-validation-length="1-100" id="nama_obat" class="input-large" name="namaobat" value=""/></td>
<td><input type="text" data-validation="number" data-validation-allowing="float" class="input-mini" name="jumlah" id="jumlah" value="" />
<input type="hidden" name="tersedia" id="tersedia" />
</td>
<td><input type="text" data-validation="length" readonly="readonly" data-validation-length="1-50" id="satuan" class="input-mini" name="satuan" value="" /></td>
<td><input type="hidden" readonly="readonly" data-validation="number" data-validation-allowing="float" id="harga_beli" class="input-small" name="hargabeli" value="" /><input type="text" readonly="readonly" data-validation="number" data-validation-decimal-separator="." data-validation-allowing="float" id="harga_jual" class="input-small" name="hargajual" value="" /></td>
<td><input type="text" readonly="readonly" data-validation="number" data-validation-allowing="float" id="jasaresep" class="input-small" name="jasaresep" value="300" /></td>
<td><input name="submit" type="submit" class="btn btn-small btn-primary" value="Tambahkan"></td>
<td></td>
</tr>
</tbody>
</table>
<div id="responsecontainer" align="center">
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<input type="submit" name="submit2" value="Simpan Semua" class="btn btn-success" />
</form>

<?php
get_footer();
?>


 