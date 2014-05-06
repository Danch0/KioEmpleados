<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php $page_title = isset($page_title) ? "Kio :"  : "Kio : Login"; ?>
    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap core CSS -->
    <?php
      $rutas = array('assets/css/bootstrap.min.css', 'assets/css/signin.css');
      
      foreach ($rutas as $ruta) {
        echo "<link href='".base_url().$ruta."' rel='stylesheet' />";
      }
     ?>
  </head>

  <body class="login-layout">
    <div class="container">
      <div id="infoMessage"><?php echo $message;?></div>
      <?php echo form_open("auth/login", array('class' => 'form-signin', 'role' => 'form'));?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php
          $identity = array('id' => 'identity', 'name' => 'identity', 'type' => 'email', 'placeholder' => 'Email', 'required' => '', 'autofocus' => '', 'class' => 'form-control');
          echo form_input($identity);
          $password = array('id' => 'password', 'name' => 'password', 'type' => 'password', 'placeholder' => 'Password', 'required' => '', 'class' => 'form-control');
          echo form_input($password);

        ?>
        <span><?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Recordarme?</span>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <?php echo form_close();?>

    </div>

    <!-- basic scripts -->

    <!--[if !IE]> -->

    <!-- <script type="text/javascript">
    //   window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    // </script> -->
    <?php 
    echo "<script src='" . base_url() . "assets/grocery_crud/js/jquery-1.10.2.min.js'></script>";
    ?>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
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
