<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Tanpa Resep</p>

    <form action="../../index2.html" method="post">
      <div class="form-group">
        <label>Keluhan</label>
          <textarea class="form-control" rows="3" placeholder="Masukkan keluhan disini"></textarea>
      </div>
      <div class="form-group">
        <label>Nomor Antrian</label>
          <input type="text" class="form-control" placeholder="Masukkan nomor antrian disini">
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a type="submit" class="btn btn-success btn-block btn-flat">Tambah</a>
        </div>

        <!-- /.col -->
        <div class="col-xs-4">
          <a type="submit" class="btn btn-success btn-block btn-flat" href="<?php echo base_url('home/Kasir/index'); ?>">Kembali</a>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
