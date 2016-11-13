<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Apotek | Manager</title>
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
	<title></title>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Selamat datang, Bagian Manajer</p>
    <div style="text-align: center">
    <a class="btn btn-app" href="<?php echo base_url('Home/logout'); ?>">
      <i class="fa fa-sign-out"></i> Log out
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
      </tbody>
     </table>

</body>
</html>