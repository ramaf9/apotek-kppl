<?php
get_header();
?>
<?php
if(!empty($status))
{
	echo $status;
}
$no=0;
if(!empty($is_data))
{
?>
<table class="table table-hover">
<thead>
<tr>	
<td>No MR</td>
<td>Nama Pasien</td>
<td>Tanggal</td>
<td>Jenis Rawat</td>
<td>Aksi</td>
</tr>
</thead>
<tbody>
<?php
	foreach($is_data['results'] as $row)
	{
	$no=$no+1;	

?>
<tr>
<td><?= $row->NoMR;?></td>
<td><?= $row->Nama;?></td>
<td><?= $row->tanggal;?></td>
<td><?= $row->jenisrawat;?></td>
<td>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>apotik/returns/updateview?uid=<?=$row->id_penjualan_apotik_rs;?>'" href="javascript:void(0)"><i class="icon-edit"></i> Edit</a>
</td>
</tr>
<?php }
?>
</tbody>
</table>
<?php }else{ ?>
<div class="alert alert-error"></div>
<?php } ?>

<?= $is_data['links']; ?>
<?php
get_footer();
?>


 