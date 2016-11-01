<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat Datang, Admin</p>

    <div style="text-align: center">
    <a class="btn btn-app" href="<?php echo base_url('home/admin/addUser'); ?>" align>
      <i class="fa fa-user-plus"></i> Tambah User
    </a>
    <a class="btn btn-app" href="<?php echo base_url('home/admin/delUser'); ?>">
      <i class="fa fa-user-times"></i> Hapus User
    </a>
    <a class="btn btn-app" href="<?php echo base_url('Home/logout'); ?>">
      <i class="fa fa-sign-out"></i> Log out
    </a>
    </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


