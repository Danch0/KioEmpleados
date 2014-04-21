<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleados extends CI_Controller {

	function __construct(){
		 parent::__construct();

		/* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		
		/* Cargamos el modelo*/
		$this->load->model('m_empleados');

		/* Añadimos el helper al controlador */
		/* $this->load->helper('url'); */
	}
	
	function index()
	{
		/* */
		$data['page_title'] = 'Empleados';
		$data['page_name'] = 'empleados/index';

		$user = $this->ion_auth->user()->row();
		$data['user'] = array('nombre' => $user->first_name, 'email' => $user->email, 'KIO_T03_E_USUARIOS' => $user->id );


		$this->load->view('shared/_layout', $data);
	}
	// Funcion para dar de alta a empleados con grocery crud
	public function admin_empleados(){
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();
		
			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');
		
			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('KIO_T01_EMPLEADOS');
		
			/* Le asignamos un nombre */
			$crud->set_subject('Empleados');
		
			/* Asignamos el idioma español */
			$crud->set_language('spanish');
			
			/*Creamos la relacion del campo roles */
			$crud->set_relation('KIO_T08_E_CAT_ROLES','KIO_T08_CAT_ROLES','T08_T_NOMBRE');
			
			/*Creamos la relacion del campo areas */
			$crud->set_relation('KIO_T06_E_CAT_AREAS','KIO_T06_CAT_AREAS','T06_T_NOMBRE');
			
			/*Creamos la relacion del campo politicas */
			$crud->set_relation('KIO_T13_E_POLITICAS_TRABAJO','KIO_T13_POLITICAS_TRABAJO','T13_T_CONCEPTO');
			
			/* Resposable o jefe de el empleado */
			//$crud->set_relation('E_ID_EMPLEADO_RESPONSABLE','ctrl_empleados','T_NOMBRE',array('E_ID_ROL' => '1'));
						
			/* Aqui le indicamos que campos deseamos mostrar CUANDO DAMOS DE ALTA A UN NUEVO EMPLEADO*/
			$crud->fields(
			  'T01_T_NOMBRE', 'T01_T_APELLIDO_PATERNO', 'T01_T_APELLIDO_MATERNO', 'T01_T_SEXO', 'T01_T_ESTADO_CIVIL',
			  'T01_D_FECHA_NACIMIENTO', 'T01_T_CURP', 'T01_E_TELEFONO_FIJO', 'T01_E_TELEFONO_CELULAR', 'T01_T_EMAIL',
			  'T01_T_DIRECCION', 'T01_E_CP', 'T01_T_ESTADO', 'T01_T_MUNICIPIO', 'KIO_T06_E_CAT_AREAS', 'KIO_T08_E_CAT_ROLES',
			  'KIO_T13_E_POLITICAS_TRABAJO', 'T01_H_HORA_ENTRADA', 'T01_H_HORA_SALIDA', 'T01_FL_SUELDO_DIA'
			);
			//$crud->fields('T_NOMBRE', 'T_AP', 'T_AM', 'T_SEXO', 'D_NAC', 'F_SUELDO_DIA', 'E_ID_AREA', 'E_ID_EMPLEADO_RESPONSABLE', 'E_ID_ROL', 'E_CEL');
			
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields('T01_T_NOMBRE', 'T01_T_APELLIDO_PATERNO', 'T01_T_CURP', 'T01_T_SEXO', 'T01_D_FECHA_NACIMIENTO', 'T01_E_TELEFONO_CELULAR', 'T01_FL_SUELDO_DIA');
		
			/* Aqui le indicamos que campos deseamos mostrar EN LA TABLA*/
			$crud->columns(
			  'T01_T_NOMBRE', 'T01_T_APELLIDO_PATERNO', 'T01_T_CURP', 'T01_E_TELEFONO_FIJO', 'T01_E_TELEFONO_CELULAR', 'T01_T_EMAIL', 'KIO_T06_E_CAT_AREAS', 'KIO_T08_E_CAT_ROLES', 'KIO_T13_E_POLITICAS_TRABAJO',
			  'T01_H_HORA_ENTRADA', 'T01_H_HORA_SALIDA', 'Retardos', 'T01_FL_SUELDO_DIA', 'Sueldo quincena'
			);
			
			/* Cambiamos el nombre de la field o column al que queremos mostrar*/
			$crud->display_as('T01_T_NOMBRE','Nombre')->display_as('T01_T_APELLIDO_PATERNO','ApellidoPaterno')->display_as('T01_T_APELLIDO_MATERNO','ApellidoMaterno')->display_as('T01_T_SEXO','Sexo')->display_as('T01_T_ESTADO_CIVIL','EstadoCivil');
			$crud->display_as('T01_D_FECHA_NACIMIENTO','FechaNacimiento')->display_as('T01_T_CURP', 'CURP')->display_as('T01_E_TELEFONO_FIJO','TelefonoFijo')->display_as('T01_E_TELEFONO_CELULAR', 'TelefonoCelular')->display_as('T01_T_DIRECCION','Drección')->display_as('T01_E_CP','CP');
			$crud->display_as('T_COL','Colonia')->display_as('T_EDO','Estado')->display_as('T_MUN','Municipio');
			$crud->display_as('E_ID_AREA','Area')->display_as('E_ID_EMPLEADO_RESPONSABLE','Jefe')->display_as('E_ID_ROL','Rol');
			$crud->display_as('E_ID_POLITICA','PoliticaTrabajo')->display_as('FH_ENTRADA','HoraEntrada')->display_as('FH_SALIDA','HoraSalida');
			$crud->display_as('E_RETARDOS','Retardos')->display_as('F_SUELDO_DIA','SueldoDía')->display_as('F_SUELDO_QUINCENAL','SueldoQuincena');
			$crud->display_as('E_TEL','Telefono')->display_as('E_CEL','Celular');
			
			//$crud->callback_edit_field('E_ID_EMPLEADO_RESPONSABLE',array($this,'get_empleado_Jefe'));
			//$crud->field_type('E_ID_EMPLEADO_RESPONSABLE','dropdown',array($this,'get_empleado_Jefe'));
			
			
			/* Generamos la tabla */
			$output = $crud->render();
			
			$data['output'] = $output;
			$data['page_title'] = 'Empleados';
			$data['page_name'] = 'empleados/v_admin_empleados';

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

	public function compensacione()
	{
		try{
			/* Creamos el objeto */
			$crud = new grocery_CRUD();
			
			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');
			
			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('KIO_T09_CTRL_COMPENSACIONES');
			
			/* Le asignamos un nombre */
			$crud->set_subject('Compensaciones');
			
			/* Asignamos el idioma español */
			$crud->set_language('spanish');
			
			/*Creamos la relacion del campo usuario que hizo el registro */
			$crud->set_relation('KIO_T01_E_EMPLEADOS','KIO_T01_EMPLEADOS','T01_T_NOMBRE');

			/*Creamos la relacion del campo usuario que hizo el registro */
			$crud->set_relation('KIO_T03_E_USUARIOS','KIO_T03_USUARIOS','first_name');
					
			/* Aqui le indicamos que campos deseamos mostrar CUANDO DAMOS DE ALTA A UN NUEVO EMPLEADO*/
			$crud->fields(
			'KIO_T01_E_EMPLEADOS',
			'KIO_T03_E_USUARIOS',
			'T09_T_CONCEPTO',
			'T09_FL_MONTO',
			'T09_FH_REGISTRO'
			);
			/* hacemos invisibles  las filas de usuario registro, por que se toma el id del usuario y hora-fecha al guardar */
			$crud->change_field_type('KIO_T03_E_USUARIOS', 'invisible');
			$crud->change_field_type('T09_FH_REGISTRO', 'invisible');
			
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(
			'KIO_T01_E_EMPLEADOS',
			'T09_T_CONCEPTO',
			'T09_FL_MONTO'
			);
			
			/* Aqui le indicamos que campos deseamos mostrar EN LA TABLA*/
			$crud->columns(
			'KIO_T01_E_EMPLEADOS',
			'KIO_T03_E_USUARIOS',
			'T09_T_CONCEPTO',
			'T09_FL_MONTO',
			'T09_FH_REGISTRO'
			);
			
			/* Cambiamos el nombre de la field o column al que queremos mostrar*/
			$crud->display_as('KIO_T01_E_EMPLEADOS','Empleado');
			$crud->display_as('KIO_T03_E_USUARIOS','Usuario');
			$crud->display_as('T09_T_CONCEPTO','Conceto');
			$crud->display_as('T09_FL_MONTO','Monto');
			$crud->display_as('T09_FH_REGISTRO','Registro');
			
			/* Mandamos el id de quien agrego el proyecto y l fecha en lo que lo hiso, con una funcion del mismo Controller */
			$crud->callback_before_insert(array($this,'_agregar_IdUsuario_Fecha'));

			/* Generamos la tabla */
			$output = $crud->render();
			
			$data['output'] = $output;
			$data['page_title'] = 'Empleados';
			$data['page_name'] = 'empleados/v_admin_empleados';
			
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

	function get_empleado_Jefe()
	{
		$empleadosJefe = $this->m_empleados->empleadoJefe();
		if($empleadosJefe != FALSE){
			foreach ($empleadosJefe as $f) {
				
				$options[$f->E_ID_EMPLEADO]	= $f->T_NOMBRE;
			}
			//return form_dropdown('E_ID_EMPLEADO_RESPONSABLE', $options);
			return $options;
		}
		else {
			return '<input type="text" maxlength="50" value="No hay jefes de proyecto aun" name="E_ID_RESPONSABLE" style="width:462px" OnFocus="this.blur()">';
		}
	}

	function _agregar_IdUsuario_Fecha($post_array) {
		$user = $this->ion_auth->user()->row();
		$post_array['T09_FH_REGISTRO'] = date('y-m-d H:s:m');
		$post_array['KIO_T03_E_USUARIOS'] = $user->id;
	 
		return $post_array;
	}
}
	/* End of file empleados.php */
	/* Location: ./application/controllers/empleados.php */