<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat datang, Bagian Pengadaan</p>
    <div style="text-align: center">
    <a class="btn btn-app" href="<?php echo base_url('Home/logout'); ?>">
      <i class="fa fa-sign-out"></i> Log out
    </a>

    <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Obat</th>
        <th>Vendor</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($pengadaan_obat as $po) {
        ?>
      <tr>
        <td><?php echo $po['po_id'] ?></td>
        <td><?php echo $po['po_vendor'] ?></td>
        <td><?php echo $po['po_quantity'] ?></td>
      </tr>
      <?php
      }?>
    </tbody>
  </table>

    <form method="post">
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Kode Obat">
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Nama Obat">
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Harga Jual">
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Satuan">
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-8">
        <button type="submit" class="btn btn-success btn-block btn-flat">Tambah</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <a type="submit" class="btn btn-success btn-block btn-flat" href="<?php echo base_url('admin/index'); ?>">Kembali</a>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->