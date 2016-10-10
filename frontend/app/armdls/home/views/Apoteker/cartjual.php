
<script>
$(function () {
        $("#aDelete").click(function(){ 
		if(confirm("Apakah anda ingin menghapus data penjualan ini?")){
          $.ajax({
            type: 'get',
            url: '<?= base_url('apotik/penjualan/delete');?>',
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
</script>
<div class="alert alert-success">Data Penjualan Apotik RS</div>
<?php 
$arr=array(
		'id'=>'frmcart'
		);
echo form_open('',$arr); ?>
<table class="table table-bordered">
<tr>
  <th>Jenis Resep</th>
  <th>Jumlah</th>
  <th>Nama Obat</th>
  <th style="text-align:right">Harga Beli</th>
  <th style="text-align:right">Harga Jual</th>
  <th style="text-align:right">Jasa Resep</th>
  <th style="text-align:right">Sub Total</th>
  <th></th>
  </tr>
<?php $i = 1; 
$jasaresep=0;
$biayajasa=0;
?>
<?php foreach($this->cart->contents() as $items): ?>
<?php echo form_hidden($items['id'], $items['id']); ?>
<?php echo form_hidden($this->cart->format_number($items['qty']), $items['qty']); ?>
<?php
$jasaresep=$jasaresep+$items['jasaresep'];
$biayajasa=$items['biayajasa'];
?>    
  <tr>
  <td align="center"><?php echo $items['jenisresep']; ?></td>
  <td align="center"><?php echo $this->cart->format_number($items['qty']); ?></td>
  <td align="center">
 <?php echo getInfoObat($items['id']); ?>
  
  <?php if ($this->cart->has_options($items['id']) == TRUE): ?>
  
  <p>
  <?php foreach ($this->cart->product_options($items['id']) as $option_name => $option_value): ?>
  
  <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
  
  <?php endforeach; ?>
  </p>
  
  <?php endif; ?>
  
  </td>
  <td align="center" style="text-align:right">Rp <?php echo $this->cart->format_number($items['price']); ?></td>
  <td align="center" style="text-align:right">Rp <?php echo $this->cart->format_number($items['jual']); ?></td>
    <td align="center" style="text-align:right">Rp <?php echo $this->cart->format_number($items['jasaresep']); ?></td>
  <td align="center" style="text-align:right">Rp <?php echo $this->cart->format_number(($items['subtotal']+$items['jasaresep'])); ?></td>
  </tr>
<?php $i++; ?>
<?php endforeach; ?>
<tr>
  <td colspan="2"> </td>
  <td ><strong>Biaya Jasa</strong></td>
  <td >Rp <?php echo $this->cart->format_number($biayajasa); ?></td>
  </tr>
<tr>
  <td colspan="2"> </td>
  <td ><strong>Total</strong></td>
  <td >Rp <?php echo $this->cart->format_number((($this->cart->total()+$jasaresep)+$biayajasa)); ?></td>
  </tr>
</table>
<a id="aDelete" href="javascript:void(0)">Hapus Data</a>
<?php echo form_close();?>
