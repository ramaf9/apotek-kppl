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


$(function () {
        $('input[name=submit]').click(function (e) {
			
				  $.ajax({
					type: 'get',
					url: '<?= base_url('apotik/laporan/lihatdataMR');?>',
					data: $('form').serialize(),
					error: function (xhr, ajaxOptions, thrownError) {
						return false;		  	
					},
					beforeSend: function() {
					$('#responsecontainer').html("<img src='<?= base_url();?>/assets/img/ajax-loader.gif' />");
					 },
					success: function (data) {
						$('#responsecontainer').html(data);
					
					}
				  });
				  e.preventDefault();
			 
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
echo form_open('',$att)
?>
<div class="control-group">
   
    <div class="control-group">
    <label class="control-label" for="inputPassword">No MR</label>
    <div class="controls">
   <input type="text" id="kode"  name="kode" placeholder="Nomor MR">
    </div>
    </div>   
    <div class="control-group">
    <div class="controls">   
    <input name="submit" type="submit" class="btn btn-medium btn-primary" value="Tampilkan No MR">
    </div>
    </div>
    </form>  
    
    <div id="responsecontainer" align="center">
</div>
<?php get_footer();?>