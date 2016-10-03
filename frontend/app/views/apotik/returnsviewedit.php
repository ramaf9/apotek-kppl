<?php
get_header();
?>
<script type="text/javascript" src="<?=base_url();?>assets/themes/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?=base_url();?>assets/themes/css/jquery-autocomplete.css">
<script>
$(function() {
$("#datepicker2").datepicker({        
		 dateFormat: "yy-mm-dd",
		 showAnim:"slide", 
    });
});

</script>
<?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
<?php

$att=array(
	'class'=>'form-horizontal',
	'role'=>'form',
	'id'=>'frmcart',
	);
	echo form_open('apotik/returns/go',$att);
?>
<?php foreach($isinfo as $r) { ?>
<div class="control-group">
<label class="control-label" for="inputEmail">No. MR</label>
<div class="controls">
<input type="text" id="inputEmail" name="nomor" value="<?=$r->NoMR;?>" readonly data-validation="length" data-validation-length="min3">

</div>
</div>
<input type="hidden" name="nomorjual" value="<?=$_GET['uid'];?>" />
<div class="control-group">
<label class="control-label" for="inputEmail">Nama Pasien</label>
<div class="controls">
<input type="text" id="inputEmail" name="ruang" value="<?=$r->Nama;?>" readonly data-validation="length" data-validation-length="min3">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputEmail">Tanggal</label>
<div class="controls">
<input type="text"  id="datepicker2" name="tgl" placeholder="Tanggal" title="Klik dan pilih Tanggal">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputEmail">Keterangan Return</label>
<div class="controls">
<textarea name="keterangan">

</textarea>
</div>
</div>
<?php } ?>
<hr>
<div class="alert alert-success">Data Penjualan</div>

<table cellpadding="6" cellspacing="1" style="width:100%" border="1">
<tr>
  
  <th>Nama Obat</th>  
  <th>Jumlah</th>
  <th>Jumlah Return</th>  
  </tr>
<?php $i = 1; ?>
<?php foreach($this->cart->contents() as $items): ?>
<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
    
  <tr>
  
  <td align="center">
  <?php echo $items['name']; ?>
  
  <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
  
  <p>
  <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
  
  <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
  
  <?php endforeach; ?>
  </p>
  
  <?php endif; ?>
  
  </td>  
  <td align="center"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5','class'=>'input-mini','readonly'=>'readonly')); ?></td>
  <td align="center"><?php echo form_input(array('name' => $i.'[return]', 'value' =>0, 'maxlength' => '3', 'size' => '5','class'=>'input-mini')); ?></td>
  </tr>
<?php $i++; ?>
<?php endforeach; ?>
<tr>
  <td colspan="2"> </td>
  <td ></td>
  <td ></td>
  </tr>
</table>
<p>&nbsp;</p>
<input type="submit" name="submit2" value="Simpan Semua" class="btn btn-success" />
<?php echo form_close();?>
<?php
get_footer();
?>