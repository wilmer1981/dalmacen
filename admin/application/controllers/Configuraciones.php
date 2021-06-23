<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {

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
        $this->load->model('configuraciones_model','',TRUE);
		$this->load->model('generales_model','',TRUE);
		
        $this->data['menuGenerales'] = 'Genereales';
        $this->data['menuConfiguraciones'] = 'Configuraciones';
       
    }

	public function index() {  	

      
		$this->data['permisos'] = $this->generales_model->get('wsoft_permisos','','','','');

        //var_dump($this->data['configuracion']);

        $this->data['header'] = 'home/header';
        $this->data['breadcrumbs'] = 'home/breadcrumbs';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'configuracion/editarConfiguracion';  
        $this->load->view('layout/template',  $this->data);
    
    }



    public function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nombres' => set_value('txtNombre'),
                'apellidos' => set_value('txtApellidos'),
                'tipo_documento' => set_value('cboTipo_Documento'),
                'num_documento' => set_value('txtNum_Documento'),
                'telefono' => set_value('txtTelefono'),               
                'email' => set_value('txtEmail'),
                'direccion' => set_value('txtDireccion'),
                'fech_nac' => set_value('txtFecH_Nac'),
                'estado' => set_value('txtEstado')        
            );

            if ($this->empleados_model->add('empleados', $data) == TRUE) {
                $this->session->set_flashdata('success','Empleado agregado con éxito!');
                redirect(base_url() . 'empleados/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
		
		$this->data['documentos'] = $this->documentos_model->getDocumentos('documentos_tipo','','operacion="P"','','');
		//var_dump($this->data['documentos']);
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'mantenimiento/empleados/empleadoAdicionar';
        $this->load->view('layout/template',  $this->data);

    }

    public function editar(){
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        $this->form_validation->set_rules('txtNombre', 'Nombre Empresa', 'trim|required');            
        //$this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email|is_unique[pacientes.email]');
      
        if ($this->form_validation->run() == false) {          
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{
            $rutalogo   =   $this->input->post('txtRutaImgLogo');  
            $rutaicon   =   $this->input->post('txtRutaImgIcon');  
            $rutalogin  =   $this->input->post('txtRutaImgLogin');      
            // si no hay imagen seleccionada y existe la ruta
            if(($_FILES['imagenLogo']['error'] == UPLOAD_ERR_NO_FILE) && !empty($rutalogo)  ) {          
                $url_imagelogo  = $this->input->post('txtRutaImgLogo');                       
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "2000";
                $config['max_height']    = "2000";                
                $this->load->library('upload', $config);                
                if(!$this->upload->do_upload('imagenLogo')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                    $upload_data   = $this->upload->data();
                    $url_imagelogo  = $upload_data['file_name'];
                }           
            }

            if(($_FILES['imagenIcon']['error'] == UPLOAD_ERR_NO_FILE) && !empty($rutaicon)) {     
                $url_imageicon  = $this->input->post('txtRutaImgIcon');                       
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "2000";
                $config['max_height']    = "2000";                
                $this->load->library('upload', $config);                
                if(!$this->upload->do_upload('imagenIcon')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                    $upload_data = $this->upload->data();
                    $url_imageicon  = $upload_data['file_name'];
                }           
            }

            if(($_FILES['imagenLogin']['error'] == UPLOAD_ERR_NO_FILE) && !empty($rutalogo)) {    
                $url_imagelogin  = $this->input->post('txtRutaImgLogin');                       
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "2000";
                $config['max_height']    = "2000";                
                $this->load->library('upload', $config);                
                if(!$this->upload->do_upload('imagenLogin')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                    $upload_data = $this->upload->data();
                    $url_imagelogin  = $upload_data['file_name'];
                }           
            }

            $permisos = $this->generales_model->get('wsoft_permisos','','','','');
            foreach ($permisos as $t) {
                $accesos[$t->url] = $this->input->post($t->url) ;                             
            }		
			$accesos = serialize($accesos);   
          
          
			$ajustes = $this->generales_model->get('wsoft_configuraciones','','code="config"','','');
	      	foreach($ajustes as $t){           
                $key   ='';
                $value ='';	               
	
                if(strcmp($t->key,"config_name") == 0){                				
					$key   = $t->key;
                    $value = $this->input->post('txtNombre');							
				}
                if(strcmp($t->key,'config_fax')==0){                  
                    $key   = $t->key;
                    $value = $this->input->post('txtRuc');                                           
                }
                if(strcmp($t->key,'config_email')==0){                  
                    $key   = $t->key;
                    $value = $this->input->post('txtEmail');                                    
                }
                if(strcmp($t->key,'config_address')==0){                  
                    $key   = $t->key;
                    $value = $this->input->post('txtDireccion');             
                }				
				if(strcmp($t->key,'config_telephone')==0){					
					$key   = $t->key;
                    $value = $this->input->post('txtTelefono');				
				}
                if(strcmp($t->key,'config_icon')==0){                  
                    $key   = $t->key;
                    $value = $url_imageicon; //$this->input->post('txtRutaImgIcon');             
                }
                if(strcmp($t->key,'config_logo')==0){                  
                    $key   = $t->key;
                    $value = $url_imagelogo; //$this->input->post('txtRutaImgLogo');             
                }
                if(strcmp($t->key,'config_image')==0){   //login               
                    $key   = $t->key;
                    $value = $url_imagelogin; //$this->input->post('txtRutaImgLogin');             
                }
                if(strcmp($t->key,'config_maintenance')==0){   //login               
                    $key   = $t->key;
                    $value = $this->input->post('rdOffline');             
                }
                if(strcmp($t->key,'config_access')==0){                
                    $key   = $t->key;
                    $value = $accesos;             
                }

           
                if(strcmp($t->key,'config_mail_engine')==0){                 
                    $key   = $t->key;
                    $value = $this->input->post('cboProtocolo');                 
                }
                if(strcmp($t->key,'config_mail_parameter')==0){                 
                    $key   = $t->key;
                    $value = $this->input->post('txtParamCorreo');
                }            				
				if(strcmp($t->key,'config_mail_smtp_hostname')==0){					
					$key   = $t->key;
                    $value = $this->input->post('txtNameSMTP');					
				}
				if(strcmp($t->key,'config_mail_smtp_username')==0){					
					$key   = $t->key;
                    $value = $this->input->post('txtUserSMTP');			
				}
				if(strcmp($t->key,'config_mail_smtp_password')==0){					
					$key   = $t->key;
                    $value = $this->input->post('txtPasswordSMTP');
				}
				if(strcmp($t->key,'config_mail_smtp_port')==0){					
					$key   = $t->key;
                    $value = $this->input->post('txtPortSMTP');					
				}
				if(strcmp($t->key,'config_mail_smtp_timeout')==0){					
					$key   = $t->key;
                    $value = $this->input->post('txtTimeoutSMTP');    
				}  

                if(!empty($key)){
                    //echo "Key:".$key;
                    //echo " --- Value:".$value."<br>"; 
                   if ($this->configuraciones_model->editSetting($key,$value) == TRUE) {
                        $bandera=1;                          
                    }else{
                         $bandera=0;          
                    }  
                }		
            }

            if($bandera == 1){
                $this->session->set_flashdata('success','Informacion editada con éxito!');
                redirect(base_url('configuraciones'));           
            }else{
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';            
            }  
        }  

    }

    public function backup(){

        /*if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('mapos/login');
        }*/

        if(!$this->permission->checkPermission($this->session->userdata('permiso'),'cBackup')){
           $this->session->set_flashdata('error','No tiene permiso para efectuar back-up.');
           redirect(base_url());
        }

        
        
        $this->load->dbutil();
        $prefs = array(
                'format'      => 'zip',
                'filename'    => 'backup_'.date('d-m-Y').'.sql'
              );

        $backup =& $this->dbutil->backup($prefs);

        $this->load->helper('file');
        write_file(base_url().'backup/backup.zip', $backup);

        $this->load->helper('download');
        force_download('backup_'.date('d-m-Y H:m:s').'.zip', $backup);
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
            $tabla  =  $_POST['tabla'];

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
                //$this->usuarios_model->edit('usuarios', $data,'id',$id); 
                $this->configuraciones_model->edit($tabla, $data,'id',$id);         
                echo "Ok";
                //$this->session->set_flashdata('success','Marca eliminado con éxito!');  
            }
            //redirect(base_url().'marcas');
    }



}
