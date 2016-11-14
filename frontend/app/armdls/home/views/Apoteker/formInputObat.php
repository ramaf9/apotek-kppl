<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Tambah Obat</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="id" name="id" class="form-control" placeholder="ID">
        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="name" name="name" class="form-control" placeholder="Nama Obat">
        <span class="glyphicon glyphicon-glass form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="quantity" name="quantity" class="form-control" placeholder="Kuantitas Obat">
        <span class="glyphicon glyphicon-plus form-control-feedback"></span>
      </div>
      <div class="form-group">
                  <label>Jenis</label>
                  <select name="role" class="form-control">
                    <option value="BOTOL">Botol</option>
                    <option value="PIL">Pil</option>
                  </select>
                </div>
      <div class="row">
        <div class="col-xs-8">
        <button type="submit" class="btn btn-success btn-block btn-flat">Tambah</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <a type="submit" class="btn btn-success btn-block btn-flat" href="<?php echo base_url('home/Apoteker/index'); ?>">Kembali</a>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->