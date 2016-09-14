<?php include('header.php') ?>
  <body class="login">
    <div class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="brand text-center">
            <h1>
              <div class="logo-icon">
                <i class="icon-beer"></i>
              </div>
              Hierapolis
            </h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form method="POST" action="home/login">
            <fieldset class="text-center">
       <?php   
       if(isset($message_error) && $message_error){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
         
          echo '</div>'; 

      }?>
              <legend>Login to your account</legend>
              <div class="form-group">
                <input class="form-control" placeholder="Username" type="text" name="username" autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" type="password" name="password" autocomplete="off">
              </div>
              <div class="text-center">
                <div class="checkbox">
                  <label>
                    <input type="checkbox">
                    Remember me on this computer
                  </label>
                </div>
                <a><button class="btn btn-default" type="submit">Sign in</button></a>
                <br>
                <a href="">Forgot password?</a>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
<?php include('footer.php') ?>