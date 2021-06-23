<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        if((!$this->session->userdata('logado'))){
            redirect('home/login');
        }
        /*if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('home/login');
        }*/

        $this->load->helper(array('codegen_helper','url'));
        $this->load->model('empleados_model','',TRUE);
        $this->load->model('usuarios_model','',TRUE);
		$this->load->model('documentos_model','',TRUE);
		$this->load->model('permisos_model','',TRUE);	
		$this->load->model('menus_model','',TRUE);	
		$this->load->model('roles_model','',TRUE);	
		
        $this->data['menuMantenimiento'] = 'Mantenimiento';  
		
        
       
    }

	public function index() {   
	        
        $this->data['roles'] = $this->roles_model->getRoles('','','','','');
		
		$this->data['menuRoles'] = 'Roles';
		
		//var_dump($this->data['menus']);
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'mantenimiento/roles/roles';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
	public function menuitems() {  
        $id = $this->uri->segment(3);	
		//var_dump($id);
		$this->data['tipo'] = $this->menus_model->get('menus_tipo','','id="'.$id.'"','','');
	        
        $this->data['menus'] = $this->menus_model->getMenuItems('','',$id,'','');
		//var_dump($this->data['menus']);
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'menus/menu_items';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
	public function menuadd() {  
        $id = $this->uri->segment(3);	
		
		$this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		
		$this->data['tipo'] = $this->menus_model->get('menus_tipo','','id="'.$id.'"','','');
	        
        $this->data['menus'] = $this->menus_model->getMenuItems('','',$id,'','');
		//var_dump($this->data['menus']);
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'menus/menu_add';  
        $this->load->view('layout/template',  $this->data);
    
    }


    public function adicionar() {
		$this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
			
			  //si no se ha seleccionado imagen
            if($_FILES['imagenUser']['error'] == UPLOAD_ERR_NO_FILE){ 
                $url_imagen  = '';                        
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('imagenUser')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                     $upload_data = $this->upload->data();
                     $url_imagen  = $upload_data['file_name'];
                }           
            }      
          
		  
            $data = array(
                'nombres' => set_value('txtNombre'),
                'apellidos' => set_value('txtApellidos'),
                'tipo_documento' => set_value('cboTipo_Documento'),
                'num_documento' => set_value('txtNum_Documento'),
                'telefono' => set_value('txtTelefono'),               
                'email' => set_value('txtEmail'),
                'direccion' => set_value('txtDireccion'),
                'fech_nac' => set_value('txtFecha_Nac'),
				//'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac')),
				'url_imagen' => $url_imagen                   
            );

            if ($this->empleados_model->add('empleados', $data) == TRUE) {				
								
				$empleado = $this->empleados_model->getByMaxId('empleados', 'id');
                $empleado_id=$empleado->id;

                $password = $this->input->post('txtPassword');  
				$password = $this->encrypt->sha1($password);
				$data = array(
					'id_empleado' => $empleado_id,
					'login' => set_value('txtLogin'),
					'password' => $password,
					'nivel' => set_value('cboIdTipo'),
					'permisos_id' => set_value('cboIdPermiso'),
					'estado' => '1'   
					  
				);

                $this->usuarios_model->add('usuarios', $data);
				
                $this->session->set_flashdata('success','Usuario agregado con éxito!');
                redirect(base_url() . 'usuarios/adicionar/');
			   
			   
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
		
		$this->data['documentos'] = $this->documentos_model->getDocumentos('documentos','','operacion="P"','','');
		//var_dump($this->data['documentos']);
	    $this->data['permisos']  = $this->permisos_model->getActive('permisos','permisos.idpermiso,permisos.nombre'); 
        $this->data['tipousers'] = $this->usuarios_model->getAllTipo('usuarios_tipo','usuarios_tipo.idtipo,usuarios_tipo.nombre'); 		
	
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'mantenimiento/empleados/empleadosAdicionar';
        $this->load->view('layout/template',  $this->data);

    }

    public function editar() {

         $id = $this->uri->segment(3);
		// echo "Id user: ".$id;
		$this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
			$ruta=$this->input->post('txtRutaImg');
			// si no hay imagen seleccionada y existe la ruta           
			if ( ($_FILES['imagenUser']['error'] == UPLOAD_ERR_NO_FILE) && !empty($ruta)  ) {              
				  $url_imagen = $this->input->post('txtRutaImg');			
			// si no hay imagen seleccionada y no existe la ruta
            }else if ( ($_FILES['imagenUser']['error'] == UPLOAD_ERR_NO_FILE) && empty($ruta) ) { 
				 $url_imagen = '';  
			
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('imagenUser')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                     $upload_data = $this->upload->data();
                     $url_imagen  = $upload_data['file_name'];
                }           
            }   
			
            $data = array(
                'nombres' => set_value('txtNombre'),
                'apellidos' => set_value('txtApellidos'),
                'tipo_documento' => set_value('cboTipo_Documento'),
                'num_documento' => set_value('txtNum_Documento'),
                'telefono' => set_value('txtTelefono'),               
                'email' => set_value('txtEmail'),
                'direccion' => set_value('txtDireccion'),
               // 'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac')),
				'fech_nac' => set_value('txtFecha_Nac'),
				'url_imagen' => $url_imagen ,
                'fech_act'=>date('Y-m-d H:m:s')       
            );

            if ($this->empleados_model->edit('empleados', $data,'id',$id) == TRUE) {
				
				    if($this->input->post('txtPassword')==""){
						 $data = array(					
							//'id_empleado' => $id,
							'login' => set_value('txtLogin'),         
							'nivel' => set_value('cboIdTipo'),
							'permisos_id' => set_value('cboIdPermiso'),
							'estado' => '1',
							'fech_act'=>date('Y-m-d H:m:s')
						);
					}else{

						$password = $this->input->post('txtPassword');  
						$password = $this->encrypt->sha1($password);
						$data = array(					
							//'id_empleado' => $id,
							'login' => set_value('txtLogin'),
							'password' => $password,
							'nivel' => set_value('cboIdTipo'),
							'permisos_id' => set_value('cboIdPermiso'),
							'estado' => '1',                
							'fech_act'=>date('Y-m-d H:m:s')  
						  
						);
					}
				$this->usuarios_model->edit('usuarios', $data,'id_empleado',$id); 
					   
			    $this->session->set_flashdata('success','Usuario editado con éxito!');
                redirect(base_url() . 'usuarios/editar/'.$id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
        
        $this->data['documentos'] = $this->documentos_model->getDocumentos('documentos','','operacion="P"','','');
        $this->data['empleados']  = $this->empleados_model->getEmpleados('e.id="'.$id.'"','','');
       // var_dump($this->data['empleados']);
	   
	    $this->data['permisos']  = $this->permisos_model->getActive('permisos','permisos.idpermiso,permisos.nombre'); 
        $this->data['tipousers'] = $this->usuarios_model->getAllTipo('usuarios_tipo','usuarios_tipo.idtipo,usuarios_tipo.nombre');   
        $this->data['usuarios']  = $this->usuarios_model->getUsers('u.id="'.$id.'"','','');  
 
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'mantenimiento/empleados/empleadosEditar';
        $this->load->view('layout/template',  $this->data);

    }
	
	public function register() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|xss_clean');
        $this->form_validation->set_rules('txtDescripcion', 'Descripcion', 'trim|xss_clean');


        if($this->form_validation->run() == false){
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{		
				$data = array( 						
					'nombre' => $this->input->post('txtTitulo'),
					'descripcion' => $this->input->post('txtDescripcion') 				
				);	

            if ($this->roles_model->add('usuarios_tipo', $data) == TRUE) {  
				echo "Ok";
            } else {
                echo "Error";
			}
        }
	}
	
	public function update(){
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|xss_clean');
        $this->form_validation->set_rules('txtDescripcion', 'Descripcion', 'trim|xss_clean');


        if($this->form_validation->run() == false){
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{	
				$id   = $this->input->post('txtId');
				$data = array( 						
					'nombre' => $this->input->post('txtTitulo'),
					'descripcion' => $this->input->post('txtDescripcion'),
					'fech_act' => date('Y-m-d H:i:s') 
				);	

            if ($this->roles_model->edit('usuarios_tipo', $data,'idtipo',$id) == TRUE) {  
				echo "Ok";
            } else {
                echo "Error";
			}
        }
	}



	public function lista() {
      // $this->lista();
		$config['base_url'] = base_url().'empleados/gerenciar/';
       // $config['total_rows'] = $this->clientes_model->count('customers');
        $total_c1 = $this->empleados_model->count('empleados');
  
        $config['total_rows'] = $total_c1;
        $config['per_page'] = 10;
        if($this->uri->segment(3)){
            $config['per_star'] = $this->uri->segment(3);
        }else{
            $config['per_star'] = 0;
        }
        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>'; 
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class="active"><span>'; 
        $config['cur_tag_close'] = '<span></span></span></li>'; 
        $config['prev_tag_open'] = '<li>'; 
        $config['prev_tag_close'] = '</li>'; 
        $config['next_tag_open'] = '<li>'; 
        $config['next_tag_close'] = '</li>'; 
        //$config['first_link'] = '&laquo;'; 
        $config['first_link'] = 'Primera';
        //$config['prev_link'] = '‹'; 
        $config['prev_link'] = 'Anterior';
        //$config['last_link'] = '&raquo;'; 
        $config['last_link'] = '&Uacute;ltima';
        //$config['next_link'] = '›'; 
        $config['next_link'] = 'Pr&oacute;xima';
        $config['first_tag_open'] = '<li>'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li>'; 
        $config['last_tag_close'] = '</li>'; 

       // $user_id= $this->session->userdata('id');   
        
        $this->data['empleados'] = $this->empleados_model->getEmpleados('',$config['per_page'],$config['per_star']);
		      
        $this->load->view('mantenimiento/empleados/empleadosLista',  $this->data);
    
    }

        public function listas() {
      // $this->lista();
        $config['base_url'] = base_url().'empleados/gerenciar/';
       // $config['total_rows'] = $this->clientes_model->count('customers');
        $total_c1 = $this->empleados_model->count('empleados');
  
        $config['total_rows'] = $total_c1;
        $config['per_page'] = 10;
        if($this->uri->segment(3)){
            $config['per_star'] = $this->uri->segment(3);
        }else{
            $config['per_star'] = 0;
        }
        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>'; 
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class="active"><span>'; 
        $config['cur_tag_close'] = '<span></span></span></li>'; 
        $config['prev_tag_open'] = '<li>'; 
        $config['prev_tag_close'] = '</li>'; 
        $config['next_tag_open'] = '<li>'; 
        $config['next_tag_close'] = '</li>'; 
        //$config['first_link'] = '&laquo;'; 
        $config['first_link'] = 'Primera';
        //$config['prev_link'] = '‹'; 
        $config['prev_link'] = 'Anterior';
        //$config['last_link'] = '&raquo;'; 
        $config['last_link'] = '&Uacute;ltima';
        //$config['next_link'] = '›'; 
        $config['next_link'] = 'Pr&oacute;xima';
        $config['first_tag_open'] = '<li>'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li>'; 
        $config['last_tag_close'] = '</li>'; 

       // $user_id= $this->session->userdata('id');   
        
        $this->data['empleados'] = $this->empleados_model->getEmpleados('',$config['per_page'],$config['per_star']);
              
        $this->load->view('mantenimiento/empleados/empleadosListas',  $this->data);
    
    }

        public function delete(){

           /* if(!$this->permission->checkPermission($this->session->userdata('permiso'),'dMarca')){
               $this->session->set_flashdata('error','No tiene permiso para eliminar Marcas.');
               redirect(base_url());
            }*/

            //$varID=$this->uri->segment(3);
            // $id =  $this->input->post('id');
             $id     =  $_POST['id'];
             $estado =  $_POST['estado'];

            if($estado==1){
                $status=0;
            }else{
                $status=1;
            }
    
            if ($id == null){
               // $this->session->set_flashdata('error','Error al intentar eliminar Usuario.');            
                //redirect(base_url().'usuarios');
                echo "No hay Id";
            }else{      
                //$this->usuarios_model->delete('usuarios','id',$id);
                    $data = array(
                        'estado' => $status,                  
                        'fech_act'=> date('Y-m-d H:m:i')                         
                    );   
                $this->empleados_model->edit('empleados', $data,'id',$id);         
                echo "Ok";
                //$this->session->set_flashdata('success','Marca eliminado con éxito!');  
            }
            //redirect(base_url().'marcas');
    }



}
