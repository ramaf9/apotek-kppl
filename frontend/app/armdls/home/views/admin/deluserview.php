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