<?php
get_header();
$att=array(
	'class'=>'form-horizontal',
	'id'=>'myform1',
	);
echo form_open('apotik/laporan/repsisastok',$att)
?>
<div class="alert alert-info">
Kosongkan pencarian jika ingin mencetak semua
</div>
<div class="control-group">
    <label class="control-label" for="inputPassword">Pilih Cari</label>
    <div class="controls">
    <select name="key">   
    <option value="obat.nama_obat">Nama Obat</option>
    <option value="kategori_obat.nama_kategori">Kategori Obat</option>
    </select>
    </div>
    </div>   
  <div class="control-group">
    <label class="control-label" for="inputPassword">Kata Pencarian</label>
    <div class="controls">
    <input name="value" type="text">
    </div>
    </div>    
    <div class="control-group">
    <div class="controls">   
    <button type="submit" class="btn btn-success" name="submit">Kirim</button>
    </div>
    </div>
    </form>
<?php get_footer();?>