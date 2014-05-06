<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo "KIO : ".$page_title; ?></title>

    <!-- Bootstrap core CSS -->
		<?php
			$rutas = array('assets/css/bootstrap.min.css');
			
			foreach ($rutas as $ruta) {
				echo "<link href='".base_url().$ruta."' rel='stylesheet' />";
			}
		 ?>
	</head>

	<body>
		<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">KIO Sistema</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><?php echo anchor('empleados/', '<i class="icon-text-width"></i> Empleados', 'title="Empleados"'); ?></li>
		        <li><?php echo anchor('catalogos/proyectos', '<i class="icon-text-width"></i> Proyectos', 'title="Proyectos"'); ?></li>
		        <li><?php echo anchor('reportes/', '<i class="icon-text-width"></i> Reportes', 'title="Reportes"'); ?></li>
		        <li><?php echo anchor('catalogos/', '<i class="icon-dashboard"></i> Catalogos', 'title="Catalogos"'); ?></li>
		        <li><?php echo anchor('empleados/asistencias', '<i class="icon-dashboard"></i> Asistencias', 'title="Asistencias"'); ?></li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li>
		        	<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/avatars/user.jpg" alt="Jason's Photo" />
							<span class="user-info">
								<small>Bienvenido,</small>
							</span>
						</li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user['email']; ?><b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li class="divider"></li>
		            <li><?php echo anchor('auth/logout', '<i class="icon-off"></i> Logout', 'title="Logout"'); ?></li>
		          </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <?php $this->load->view($page_name); ?> 

        </div>
      </div>

      <hr>

      <footer>
        <p>© Kiotech 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php
    	$string1 = 'document.write("'."<script src='";
    	$string2 = 'assets/grocery_crud/js/jquery-1.10.2.min.js';
    	$string3 = "'>".'"+"<"+"/script>");';
    ?>
    <script type="text/javascript">
    	window.jQuery || <?php echo $string1.base_url().$string2.$string3; ?>
    </script>

    <!-- <script src="<?php echo base_url(); ?>assets/grocery_crud/js/jquery-1.10.2.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
	</body>
</html>