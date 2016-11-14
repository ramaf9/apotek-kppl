<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<bodyclass="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat datang, Apoteker</p>
     <div style="text-align: center">

    <a class="btn btn-app" href="<?php echo base_url('Home/logout'); ?>">
      <i class="fa fa-sign-out"></i> Log out
    </a>
    <a class="btn btn-app" href="<?php echo base_url('Home/Apoteker/create'); ?>">
      Input Obat 
    </a>
    <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Obat</th>
        <th>Unit Obat</th>
        <th>Jumlah</th>
      </tr>
    </thead>
     <tbody>
        <?php foreach($obat as $o) {
        ?>
      <tr>
        <td><?php echo $o['o_id'] ?></td>
        <td><?php echo $o['o_name'] ?></td>
        <td><?php echo $o['o_unit'] ?></td>
        <td><?php echo $o['o_quantity'] ?></td>
       </tr>
      <?php
      }?>
      </tbody>
  </table>
    </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
</html>>