<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contenidos extends CI_Controller {

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
   
        $this->load->model('empleados_model','',TRUE);
        $this->load->model('usuarios_model','',TRUE);
		$this->load->model('documentos_model','',TRUE);
		$this->load->model('permisos_model','',TRUE);	
        $this->load->model('productos_model','',TRUE);   
		
        $this->data['menuContenido'] = 'Contenidos';         
       
    }

	public function index() {   
	        
        //$this->data['empleados'] = $this->empleados_model->getEmpleados('','','');
		$this->data['productos'] = $this->productos_model->getProductos('');

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';   
        $this->data['breadcrumbs'] = 'home/breadcrumbs';   
        $this->data['menuGestorProductos'] = 'Mantenimiento';  

        // cargamos  la interfaz
        $this->data['view']   = 'almacen/productos/productos';  
        $this->load->view('layout/template',  $this->data);
    
    }

    public function adicionar() {
		$this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if($this->form_validation->run('empleados') == false){
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{
			
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
				//'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac'),'-'),
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
					'nivel' => set_value('cboGrupo'),
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
			$ruta=$this->input->post('txtRutaImgUser');
			// si no hay imagen seleccionada y existe la ruta           
			if ( ($_FILES['imagenUser']['error'] == UPLOAD_ERR_NO_FILE) && !empty($ruta)  ) {              
				  $url_imagen = $this->input->post('txtRutaImgUser');			
			// si no hay imagen seleccionada y no existe la ruta
            }else if ( ($_FILES['imagenUser']['error'] == UPLOAD_ERR_NO_FILE) && empty($ruta) ) { 
				 $url_imagen = '';  
			
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/users/";
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
               // 'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac'),'-'),
				'fech_nac' => set_value('txtFecha_Nac'),
				'url_imagen' => $url_imagen ,
                'fech_act'=>date('Y-m-d H:m:s')       
            );

            if ($this->empleados_model->edit('empleados', $data,'id',$id) == TRUE) {
				
				    if($this->input->post('txtPassword')==""){
						 $data = array(					
							'id_empleado' => $id,
							'login' => set_value('txtLogin'),         
							'nivel' => set_value('cboGrupo'),
							'permisos_id' => set_value('cboIdPermiso'),
							'estado' => $this->input->post('rdoStatus'),
							'fech_act'=>date('Y-m-d H:i:s')
						);
					}else{

						$password = $this->input->post('txtPassword');  
						$password = $this->encrypt->sha1($password);
						$data = array(					
							'id_empleado' => $id,
							'login' => set_value('txtLogin'),
							'password' => $password,
							'nivel' => set_value('cboGrupo'),
							'permisos_id' => set_value('cboIdPermiso'),
							'estado' => $this->input->post('rdoStatus'),                
							'fech_act'=>date('Y-m-d H:i:s')  
						  
						);
					}
				$this->usuarios_model->edit('usuarios', $data,'id',$id); 
					   
			    $this->session->set_flashdata('success','Usuario editado con éxito!');
                redirect(base_url() . 'usuarios/editar/'.$id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
        
        $this->data['documentos'] = $this->documentos_model->getDocumentos('documentos','','operacion="P"','','');
        //$this->data['empleados']  = $this->empleados_model->getEmpleados('e.id="'.$id.'"','','');
       // var_dump($this->data['empleados']);
	   
	    //$this->data['permisos']  = $this->permisos_model->getActive('permisos','idpermiso,nombre'); 
		$this->data['permisos']  = $this->usuarios_model->getAllTipo('permisos','idpermiso,nombre'); 
        $this->data['tipousers'] = $this->usuarios_model->getAllTipo('usuarios_tipo','idtipo,nombre');   
        $this->data['usuarios']  = $this->usuarios_model->getUsers('u.id="'.$id.'"','','');  
 
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'mantenimiento/empleados/empleadosEditar';
        $this->load->view('layout/template',  $this->data);

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
