<?php
get_header();
?>
<div class="row-fluid">
<ul class="thumbnails">


<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Penjualan</h3>
    <p>Penjualan</p>
    <p><a href="<?=base_url('apotik/penjualan');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>

<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Return Penjualan</h3>
    <p>Return Penjualan</p>
    <p><a href="<?=base_url('apotik/return');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>

</ul>
</div>
<?php
get_footer();
?>