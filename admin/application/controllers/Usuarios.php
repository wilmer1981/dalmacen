<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

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
		
        $this->data['menuUsuarios'] = 'Usuarios';
         
       
    }

	public function index() {         
      
		$this->data['usuarios'] = $this->usuarios_model->getUsers('','','');

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';   
        $this->data['breadcrumbs'] = 'home/breadcrumbs';   
        $this->data['menuGestorUsuarios'] = 'Mantenimiento';  

        // cargamos  la interfaz
        $this->data['view']   = 'mantenimiento/empleados/empleados';  
        $this->load->view('layout/template',  $this->data);
    
    }


    public function adicionar() {		
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {		  
            $data = array(
                'nombres' => set_value('txtNombres'),
                'apellidos' => set_value('txtApellidos'),
				'direccion' => set_value('txtDireccion'),
                'id_tipodocumento' => set_value('cboTipoDoc'),
                'num_documento' => set_value('txtNumDoc'),
                'telefono' => set_value('txtTelefono'), 
				'login' => set_value('txtLogin'),
				'password' => set_value('txtPassword'),
				'id_permiso' => set_value('cboIdPermiso'),
                'email' => set_value('txtEmail'),
				'id_tipousuario' => set_value('cboGrupo'),
                'fech_nac' => set_value('txtFechNac'),
				//'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac'),'-'),
				'url_image' => set_value('txtImage')                  
            );

            if ($this->usuarios_model->add('wsoft_usuarios', $data) == TRUE){				
                $this->session->set_flashdata('success','Usuario agregado con éxito!');
                redirect(base_url() . 'usuarios/adicionar/');		   
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
		
		$this->data['documentos'] = $this->documentos_model->getDocumentos('wsoft_documentos','','','','');
	    $this->data['permisos']  = $this->permisos_model->getActive('wsoft_permisos','id,nombre'); 
        $this->data['tipousers'] = $this->usuarios_model->getAllTipo('wsoft_usuarios_tipo','id,titulo'); 		
	
		$this->data['menuGestorUsuarios'] = 'Mantenimiento';  
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
        $this->data['view']   = 'mantenimiento/empleados/empleadosAdicionar';
        $this->load->view('layout/template',  $this->data);
    }
	
	public function grabar() {
		$this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
			$result['valid']    = false;     
			$result['message']  = validation_errors(); 
           
        } else {
			
				  
            $data = array(
                'nombres' => set_value('txtNombres'),
                'apellidos' => set_value('txtApellidos'),
				'direccion' => set_value('txtDireccion'),
                'id_tipodocumento' => set_value('cboTipoDoc'),
                'num_documento' => set_value('txtNumDoc'),
                'telefono' => set_value('txtTelefono'), 
				'login' => set_value('txtLogin'),
				'password' => set_value('txtPassword'),
				'id_permiso' => set_value('cboIdPermiso'),
                'email' => set_value('txtEmail'),
				'id_tipousuario' => set_value('cboGrupo'),
                'fech_nac' => set_value('txtFechNac'),
				//'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac'),'-'),
				'url_imagen' => set_value('txtImage')                  
            );

            if ($this->usuarios_model->add('usuarios', $data) == TRUE){			
				
              	$result['valid']    = true;     
			    $result['message']  = 'OK'; 	   
			   
            } else {
				$result['valid']    = false;     
			    $result['message']  = 'No se pudo grabar'; 
                
            }
        }
		
		$this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));  
		

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
			
			if($this->input->post('txtPassword')==""){
				$data = array(
					'nombres' => set_value('txtNombres'),
					'apellidos' => set_value('txtApellidos'),
					'direccion' => set_value('txtDireccion'),
					'id_tipodocumento' => set_value('cboTipoDoc'),
					'num_documento' => set_value('txtNumDoc'),
					'telefono' => set_value('txtTelefono'), 
					'login' => set_value('txtLogin'),					
					'id_permiso' => set_value('cboIdPermiso'),
					'email' => set_value('txtEmail'),
					'id_tipousuario' => set_value('cboGrupo'),
					'fech_nac' => set_value('txtFechNac'),				
					'url_image' => set_value('txtImage'),
					'estado' => $this->input->post('rdoStatus'),
					'fech_act'=>date('Y-m-d H:i:s')					
				);
			
			}else{
						
				$data = array(
					'nombres' => set_value('txtNombres'),
					'apellidos' => set_value('txtApellidos'),
					'direccion' => set_value('txtDireccion'),
					'id_tipodocumento' => set_value('cboTipoDoc'),
					'num_documento' => set_value('txtNumDoc'),
					'telefono' => set_value('txtTelefono'), 
					'login' => set_value('txtLogin'),
					'password' => sha1(set_value('txtPassword')),
					'id_permiso' => set_value('cboIdPermiso'),
					'email' => set_value('txtEmail'),
					'id_tipousuario' => set_value('cboGrupo'),
					'fech_nac' => set_value('txtFechNac'),				
					'url_image' => set_value('txtImage'),
					'estado' => $this->input->post('rdoStatus'),
					'fech_act'=>date('Y-m-d H:i:s')
				);
			}

            if ($this->usuarios_model->edit('wsoft_usuarios', $data,'id',$id) == TRUE) {				
			    $this->session->set_flashdata('success','Usuario editado con éxito!');
                redirect(base_url('usuarios/editar/'.$id));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
        
        $this->data['documentos'] = $this->documentos_model->getDocumentos('wsoft_documentos','','','','');
        $this->data['registro']    = $this->usuarios_model->getUsers('u.id="'.$id.'"','','');
       //var_dump($this->data['registro']);
	   
	    //$this->data['permisos']  = $this->permisos_model->getActive('permisos','idpermiso,nombre'); 
		$this->data['permisos']  = $this->usuarios_model->getAllTipo('wsoft_permisos','id,nombre'); 
        $this->data['tipousers'] = $this->usuarios_model->getAllTipo('wsoft_usuarios_tipo','id,titulo');  		
           
		$this->data['menuGestorUsuarios'] = 'Mantenimiento';  
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
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
	
	//eliminar registros check
    public function deletes(){

        /*if(!$this->permission->checkPermission($this->session->userdata('permiso'),'dRegistro')){
               $this->session->set_flashdata('error','No tiene permiso para eliminar Archivos.');
               redirect(base_url());
        }*/
        // $this->load->helper("file");       

        //$id     =  $_POST['id'];
        //$estado =  $_POST['estado'];        	

        if(!empty($_POST['chkRegistro'])){
            // Ciclo para mostrar las casillas checked checkbox.
            foreach($_POST['chkRegistro'] as $selected){
                //echo $selected."</br>";// Imprime resultados
                $id = $selected;
                //consultamos archivo
               
				$registro  = $this->usuarios_model->getUsers('u.id="'.$id.'"','','');
                $url       = $registro[0]->url_image;
            
                //$path = "uploads/files";
                //$dh   = dir($path);
                //$realfile = $path . "/" . $archivo; 

				$realfile = $url;                 
                if ($id == null){
                        $result['valid']   = 'error';                 
                        $result['message'] = ' No se puede eliminar...';
                }else{  
                    if($url !==""){ //si tiene imagen
                        @unlink($realfile);               
                        $del = $this->usuarios_model->delete("wsoft_usuarios","id",$id);                         
                    }else{ 
						$del = $this->usuarios_model->delete("wsoft_usuarios","id",$id);   
                    } 

					if($del == false){
						$result['valid']   = false;                 
						$result['message'] = "No se puede eliminar.";
					}else{         
						$result['valid']   = true;                 
						$result['message'] = "Eliminacion exitosa.";
					} 					
                }

            }
        }
		
        //redirect(base_url().'marcas');
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));    
    }
	
	
	public function uploadImage() {
			
			  //si no se ha seleccionado imagen
			if($_FILES['file-input']['error'] == UPLOAD_ERR_NO_FILE){ 
                $filename   = '';  
				$result['valid']   = false;	
				$result['message'] = "Seleccione imagen"; 				
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/users/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('file-input')) {
					$message = $this->upload->display_errors();                   
                    $bandera =  0;
                }else{                   
					$upload_data = $this->upload->data();
                    $filename    = $upload_data['file_name'];
                    $tamanio     = $upload_data['file_size'];
                    $extension   = $upload_data['file_ext'];
					$bandera=1;
                }           
            }         
		 

            if($bandera==1) {								
				$result['valid']    = true;        
				$result['urlimage'] = "uploads/users/".$filename ; 				
                $result['message']  = 'Archivo cargado correctamente.'; 
			} else {
                $result['valid']    = 'error';     
				$result['urlimage'] = ''; 				
                $result['message']  = $message; 
            }
			
			$this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));   
				
    }
	
	// TIPO DE USUARIOS
	
	public function tipos() {   
	        
        $this->data['tipos'] = $this->usuarios_model->get('wsoft_usuarios_tipo','','','','');
		
		$this->data['menuUsuariosTipo'] = 'Roles';
		
		//var_dump($this->data['menus']);
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';  
		$this->data['breadcrumbs'] = 'home/breadcrumbs';  		

        // cargamos  la interfaz
        $this->data['view']   = 'mantenimiento/usuarios/usuariosTipo';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
	public function addtipo() {		
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'required');

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {	
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$Content = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);		
            $data = array(
                'titulo' => set_value('txtTitulo'),
                'descripcion' => $Content	               
            );

            if ($this->usuarios_model->add('wsoft_usuarios_tipo', $data) == TRUE){				
                $this->session->set_flashdata('success','Grupo Usuario agregado con éxito!');
                redirect(base_url() . 'usuarios/addtipo/');		   
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }		
	
		$this->data['menuUsuariosTipo'] = 'Roles'; 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
        $this->data['view']   = 'mantenimiento/usuarios/usuariosTipoAdd';
        $this->load->view('layout/template',  $this->data);
    }
	
	public function updatetipo() {	
		$id = $this->uri->segment(3);	
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'required');

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {	
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$Content = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);		
            $data = array(
                'titulo' => set_value('txtTitulo'),
                'descripcion' => $Content	               
            );

            if ($this->usuarios_model->edit('wsoft_usuarios_tipo', $data,'id',$id) == TRUE){				
                $this->session->set_flashdata('success','Grupo Usuario editado con éxito!');
                redirect(base_url('usuarios/updatetipo/'.$id));		   
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }	

		$this->data['registro'] = $this->usuarios_model->get('wsoft_usuarios_tipo','','id="'.$id.'"','','');		
	
		$this->data['menuUsuariosTipo'] = 'Roles'; 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
        $this->data['view']   = 'mantenimiento/usuarios/usuariosTipoEdit';
        $this->load->view('layout/template',  $this->data);
    }
		
		
		
		

}




