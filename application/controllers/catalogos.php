<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	function __construct(){
		 parent::__construct();

		/* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');

		/* Añadimos el helper al controlador */
		/* $this->load->helper('url'); */
	}
	function index()
	{
		/* */
		$data['page_title'] = 'Catalogos';
		$data['page_name'] = 'catalogos/index';

		$user = $this->ion_auth->user()->row();
		$data['user'] = array('nombre' => $user->first_name, 'email' => $user->email, 'KIO_T03_E_USUARIOS' => $user->id );


		$this->load->view('shared/_layout', $data);
	}
	public function areas(){
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();
		
			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');
		
			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('KIO_T06_CAT_AREAS');
		
			/* Le asignamos un nombre */
			$crud->set_subject('Areas');
		
			/* Asignamos el idioma español */
			$crud->set_language('spanish');
			
			/* Aqui le indicamos que campos deseamos mostrar CUANDO DAMOS DE ALTA*/
			$crud->fields('T06_T_NOMBRE', 'T06_T_DESCRIPCION');
		
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields('T06_T_NOMBRE', 'T06_T_DESCRIPCION');
		
			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns('T06_T_NOMBRE', 'T06_T_DESCRIPCION');
			
			/* Cambiamos el nombre de la field o column al que queremos mostrar*/
			$crud->display_as('T06_T_NOMBRE','Nombre')->display_as('T06_T_DESCRIPCION','Descripción');
					
			/* Generamos la tabla */
			$output = $crud->render();
			$data['output'] = $output;
			$data['page_title'] = 'Areas';
			$data['page_name'] = 'catalogos/v_admin_catalogos';

			$user = $this->ion_auth->user()->row();
			$data['user'] = array('nombre' => $user->first_name, 'email' => $user->email, 'KIO_T03_E_USUARIOS' => $user->id );

			/* La cargamos en la vista situada en
			/applications/views/productos/administracion.php */
			$this->load->view('shared/_layout', $data);
		
		}catch(Exception $e){
		  /* Si algo sale mal cachamos el error y lo mostramos */
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function Roles(){
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();
		
			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');
		
			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('KIO_T08_CAT_ROLES');
		
			/* Le asignamos un nombre */
			$crud->set_subject('Rol');
		
			/* Asignamos el idioma español */
			$crud->set_language('spanish');
			
			/* Aqui le indicamos que campos deseamos mostrar CUANDO DAMOS DE ALTA*/
			$crud->fields('T08_T_NOMBRE', 'T08_T_DESCRIPCION');
		
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields('T08_T_NOMBRE', 'T08_T_DESCRIPCION');
		
			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns('T08_T_NOMBRE', 'T08_T_DESCRIPCION');
			
			/* Cambiamos el nombre de la field o column al que queremos mostrar*/
			$crud->display_as('T08_T_NOMBRE','Nombre')->display_as('T08_T_DESCRIPCION','Descripción');
		
			/* Generamos la tabla */
			$output = $crud->render();
		
			$data['output'] = $output;
			$data['page_title'] = 'Roles';
			$data['page_name'] = 'catalogos/v_admin_catalogos';

			$user = $this->ion_auth->user()->row();
			$data['user'] = array('nombre' => $user->first_name, 'email' => $user->email, 'KIO_T03_E_USUARIOS' => $user->id );

			/* La cargamos en la vista situada en
			/applications/views/productos/administracion.php */
			$this->load->view('shared/_layout', $data);
		
		}catch(Exception $e){
		  /* Si algo sale mal cachamos el error y lo mostramos */
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function proyectos(){
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();
		
			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');
		
			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('KIO_T07_CAT_PROYECTOS');
		
			/* Le asignamos un nombre */
			$crud->set_subject('Proyectos');
		
			/* Asignamos el idioma español */
			$crud->set_language('spanish');
			
			/* Cargamos los empleados que estan asignados al proyecto */
			$crud->set_relation_n_n('empleados', 'KIO_T17_REL_EMPLEADOS_PROYECTO', 'KIO_T01_EMPLEADOS', 'KIO_T07_E_CAT_PROYECTOS', 'KIO_T01_E_EMPLEADOS', 'T01_T_NOMBRE');
		
			/* Mandamos el id de quien agrego el proyecto y l fecha en lo que lo hiso, con una funcion del mismo Controller */
			 $crud->callback_before_insert(array($this,'agregarIdFechaProyecto'));
			
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(
			  'T07_T_NOMBRE',
			  'T07_D_FECHA_INICIO',
			  'T07_D_FECHA_ENTREGA'
			);
			$crud->fields(
			  'T07_T_NOMBRE',
			  'T07_D_FECHA_INICIO',
			  'T07_D_FECHA_ENTREGA',
			  'T07_FL_SUELDO_EXTRA',
			  'empleados',
			  'T07_FH_REGISTRO',
			  'KIO_T03_E_USUARIOS'
			);
			$crud->change_field_type('T07_FH_REGISTRO', 'invisible');
			$crud->change_field_type('KIO_T03_E_USUARIOS', 'invisible');
			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
			  'T07_T_NOMBRE',
			  'T07_D_FECHA_INICIO',
			  'T07_D_FECHA_ENTREGA',
			  'T07_FL_SUELDO_EXTRA',
			  'T07_FH_REGISTRO',
			  'KIO_T03_E_USUARIOS',
			  'empleados',
			  'Jefe'
			);
			
			$crud->callback_column('Jefe',array($this,'_callback_jefe_proyecto'));
			
			/* Cambiamos el nombre de la field o column al que queremos mostrar*/
			$crud->display_as('T07_T_NOMBRE','Nombre')->display_as('T07_D_FECHA_INICIO','FechaInicio')->display_as('T07_D_FECHA_ENTREGA','FechaEntrega');
			$crud->display_as('T07_FL_SUELDO_EXTRA','SueldoExtra')->display_as('T07_FH_REGISTRO','FechaRegistro');
			$crud->display_as('KIO_T03_E_USUARIOS','UsuarioRegistro');
		
			/* Generamos la tabla */
			$output = $crud->render();
		
			$data['output'] = $output;
			$data['page_title'] = 'Proyectos';
			$data['page_name'] = 'catalogos/v_admin_catalogos';

			$user = $this->ion_auth->user()->row();
			$data['user'] = array('nombre' => $user->first_name, 'email' => $user->email, 'KIO_T03_E_USUARIOS' => $user->id );

			/* La cargamos en la vista situada en
			/applications/views/productos/administracion.php */
			$this->load->view('shared/_layout', $data);
		
		}catch(Exception $e){
		  /* Si algo sale mal cachamos el error y lo mostramos */
		  show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function agregarIdFechaProyecto($post_array) {
		$post_array['T07_FH_REGISTRO'] = date('y-m-d H:s:m');
		$post_array['KIO_T03_E_USUARIOS'] = 1;
	 
		return $post_array;
	}
	
	public function _callback_jefe_proyecto($value, $row)
	{
	  //return "<a href='".site_url('admin/sub_webpages/'.$row->empleados)."'>$value</a>";
	  return $row->empleados;
	}
}
	/* End of file catalogos.php */
	/* Location: ./application/controllers/catalogos.php */