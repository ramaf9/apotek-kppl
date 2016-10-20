<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Apotek | Kasir</title>
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
    <p class="login-box-msg">Selamat datang, Kasir</p>

    <div style="text-align: center">

    <a class="btn btn-app" href="<?php echo base_url('Home/logout'); ?>">
      <i class="fa fa-sign-out"></i> Log out
    </a>
    <table class="table">
    <thead>
      <tr>
        <th>No antrian</th>
        <th>Nama pasien</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($request_obat as $ro) {
        ?>
      <tr>
        <td><?php echo $ro['ro_id'] ?></td>
        <td><?php echo $ro['ro_pasien'] ?></td>
        <td>
            <?php if($ro['ro_status'] == 1){
                ?>
                <a class="btn btn-app" align disabled>
                  </i> LUNAS
                </a>
                <!-- <a class="btn btn-app" href="<?php echo base_url('home/kasir/woresep?id='.$ro['ro_id']); ?>">
                  <i class="fa fa-file-o"></i> Tanpa Resep
                </a> -->
                <?php
            }else{ ?>
                <a class="btn btn-app" align href="<?php echo base_url('home/kasir/wresep?id='.$ro['ro_id']); ?>">
                  <i class="fa fa-file-text-o"></i> Detail
                </a>
                <!-- <a class="btn btn-app" href="<?php echo base_url('home/kasir/woresep?id='.$ro['ro_id']); ?>">
                  <i class="fa fa-file-o"></i> Tanpa Resep
                </a> -->
                <?php
            } ?>

        </td>
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