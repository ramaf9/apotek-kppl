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