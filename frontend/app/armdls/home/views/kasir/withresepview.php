<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>E</b>-Apotek
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Dengan Resep</p>

    <form method="post">
      <div class="form-group">
        <label>Resep</label>
          <!-- <textarea class="form-control" rows="3" placeholder="Masukkan resep disini"></textarea> -->
          <table class="table">
          <thead>
            <tr>
              <th>No obat</th>
              <th>Nama obat</th>
              <th>Kuantitas</th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <td><?php echo $ro_id ?></td>
              <td><?php echo $o_name ?></td>
              <td>
                  <?php echo $ro_quantity." ".$o_unit ?>
              </td>
            </tr>

          </tbody>
        </table>

      </div>
      <div class="form-group">
        <label>Harga</label>
          <input type="text" class="form-control" placeholder="Masukkan nomor antrian disini" disabled value="Rp <?php echo $price ?>,00">
          <?php if(isset($message)){
                echo '<h4>'.$message.'</h4>';
          } ?>

      </div>
      <div class="row">
        <div class="col-xs-8">
          <button type="submit" class="btn btn-success btn-block btn-flat">Bayar</button>
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
