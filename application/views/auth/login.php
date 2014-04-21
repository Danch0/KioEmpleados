<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Login Page - Ace Admin</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- basic styles -->
    <?php
      $rutas = array('assets/css/bootstrap.min.css', 'assets/css/font-awesome.min.css', 'assets/css/ace-fonts.css', 'assets/css/ace.min.css', 'assets/css/ace-rtl.min.css', 'assets/css/ace-skins.min.css');
      
      foreach ($rutas as $ruta) {
        echo "<link href='".base_url().$ruta."' rel='stylesheet' />";
      }
     ?>
  </head>

  <body class="login-layout">
    <div class="main-container">
      <div class="main-content">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
              <div class="center">
                <h1>
                  <i class="icon-leaf green"></i>
                  <span class="red">Kio</span>
                  <span class="white">Empleados</span>
                </h1>
                <h4 class="blue">&copy; Kiotech</h4>
              </div>

              <div class="space-6"></div>

              <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                  <div class="widget-body">
                    <div class="widget-main">
                      <h1 class="header blue lighter bigger"><?php echo lang('login_heading');?></h1>
                      <p><?php echo lang('login_subheading');?></p>

                      <div id="infoMessage" class="red"><?php echo $message;?></div>

                      <?php echo form_open("auth/login");?>

                        <p>
                          <?php echo lang('login_identity_label', 'identity');?>
                          <?php echo form_input($identity); ?>
                        </p>

                        <p>
                          <?php echo lang('login_password_label', 'password');?>
                          <?php echo form_input($password);?>
                        </p>
                        <div class="space"></div>
                        <div class="clearfix">
                          <label class="inline">
                            <p>
                              <?php echo lang('login_remember_label', 'remember');?>
                              <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                            </p>
                          </label>

                          <?php echo form_submit('submit', lang('login_submit_btn'), 'class="width-35 pull-right btn btn-sm btn-primary"');?>
                        
                        </div>
                      <?php echo form_close();?>
                    </div><!-- /widget-main -->
                    <div class="toolbar clearfix">

                      <p><a href="forgot_password" class="red"><?php echo lang('login_forgot_password');?></a></p>
                    </div>
                  </div><!-- /widget-body -->
                </div><!-- /login-box -->
              </div><!-- /position-relative -->
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->

    <!-- <script type="text/javascript">
    //   window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    // </script> -->
    <?php 
    $cadena_url = "<script src='" . base_url() . "assets/js/jquery-2.0.3.min.js'></script>";
    echo $cadena_url;
        // echo '<script type="text/javascript">
        //  window.jQuery || document.write("' $cadena_url '");
        // </script>'
    ?>
    <!-- <![endif]-->

    <!-- inline scripts related to this page -->

    <script type="text/javascript">
      function show_box(id) {
       jQuery('.widget-box.visible').removeClass('visible');
       jQuery('#'+id).addClass('visible');
      }
    </script>
  </body>
</html>
