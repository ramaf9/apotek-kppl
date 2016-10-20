<?php
get_header();
?>
<script type="text/javascript" src="<?=base_url();?>assets/themes/js/jquery-ui.js"></script>
<script>
$(function() {
$("#datepicker2").datepicker({        
		 dateFormat: "yy-mm-dd",
		 showAnim:"slide",
    });
});
$(function() {
$("#datepicker3").datepicker({        
		 dateFormat: "yy-mm-dd",
		 showAnim:"slide",
    });
});
</script>
    <div class="alert alert-info">
    Cari Berdasarkan Tanggal
    </div>
<?php
$att=array(
	'class'=>'form-horizontal',
	'id'=>'myform',
	);
echo form_open('apotik/laporan/reprekaptanggal',$att)
?>
<div class="control-group">
    <label class="control-label" for="inputPassword">Pilih Tanggal</label>
    <div class="controls">
    dari tanggal<input type="text" id="datepicker2"  name="tgl" placeholder="Tanggal Transfer">hingga<input type="text" id="datepicker3"  name="tgl2" placeholder="Tanggal Transfer">
    </div>
    </div>   
    
    <div class="control-group">
    <div class="controls">   
    <button type="submit" class="btn btn-success" name="submit">Kirim</button>
    </div>
    </div>
    </form>  
<?php get_footer();?>