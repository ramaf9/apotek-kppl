<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat datang, Admin</p>

    <div style="text-align: center">

    <a class="btn btn-app" href="<?php echo base_url('Home/logout'); ?>">
      <i class="fa fa-sign-out"></i> Log out
    </a>
      <div class="box-header with-border">
        <h3 class="box-title">User List</h3>
      </div>
    <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Username</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($user as $us) {
        ?>
      <tr>
        <td><?php echo $us['u_name'] ?></td>
        <td><?php echo $us['u_username'] ?></td>
        <td><?php echo $us['u_role'] ?></td>
      </tr>
      <?php
      }?>
    </tbody>
  </table>
  <div class="row">
        <div class="col-xs-8">
        <button type="submit" class="btn btn-success btn-block btn-flat">Hapus</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <a type="submit" class="btn btn-success btn-block btn-flat" href="<?php echo base_url('admin/index'); ?>">Kembali</a>
        </div>
        <!-- /.col -->
      </div>
    </div>
        <!-- /.col -->
      </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
