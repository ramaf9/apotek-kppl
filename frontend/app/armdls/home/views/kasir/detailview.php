<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <div style="text-align: center">

    <a class="btn btn-app" href="<?php echo base_url('Home/logout'); ?>">
      <i class="fa fa-sign-out"></i> Log out
    </a>
    <p class="login-box-msg">Detail pesanan: </p>
    <table class="table">
    <thead>
      <tr>
        <th>Nama Pasien</th>
        <th>Obat</th>
        <th>Jumlah Pembelian</th>
      </tr>
    </thead>
    <tbody>
   <!--      <?php foreach ($request_obat as $ro) {
        ?> -->
      <tr>
        <td><?php echo $ro['ro_pasien'] ?></td>
        <td><?php echo $ro['ro_obat'] ?></td>
        <td><?php echo $ro['ro_quantity'] ?></td>
      </tr>
 <!--      <?php
      }?> -->
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