<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Apotek | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/green.css'); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat Datang, Admin</p>

    <div style="text-align: center">
    <a class="btn btn-app">
      <i class="fa fa-user-times"></i> Hapus User
    </a>
    <a class="btn btn-app" href="<?php echo base_url('Home/logout'); ?>">
      <i class="fa fa-sign-out"></i> Log out
    </a>
    <div class="box-header with-border">
              <h3 class="box-title">User List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="text-align: center"> Username</th>
                  <th>Role</th>
                  <th style="width: 40px"></th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>rama</td>
                  <td>admin</td>
                  <td>
                    <label>
                      <input type="checkbox">
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>hendro</td>
                  <td>pemilik</td>
                  <td>
                    <label>
                      <input type="checkbox">
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>joni</td>
                  <td>kasir</td>
                  <td>
                    <label>
                      <input type="checkbox">
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>adrian</td>
                  <td>apoteker</td>
                  <td>
                    <label>
                      <input type="checkbox">
                    </label>
                  </td>
                </tr>
              </table>


            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-left">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
              <div class="col-xs-6">
              <a type="submit" class="btn btn-success btn-block btn-flat" href="<?php echo base_url('home/admin/index'); ?>">Kembali</a>
            </div>
            </div>

          </div>

          <!-- /.box -->
          </div>

        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"ss></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
