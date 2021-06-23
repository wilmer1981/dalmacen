<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->model('home_model','',TRUE);
        $this->load->model('pedidos_model','',TRUE); 
		$this->load->model('generales_model','',TRUE); 		
  }

	public function index(){
        //if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
        if(!$this->session->userdata('logado')){
          redirect('home/login');      
        }else{	
		
			$fecha_actual = date("Y-m-d");   

			$this->data['counter']    = get_counter();
			//var_dump($this->data['counter']);
		  		 
			$this->data['header']      = 'home/header';
			$this->data['breadcrumbs'] = 'home/breadcrumbs';
			$this->data['footer']      = 'home/footer';
			$this->data['menu']        = 'home/menu';   
          
			$this->data['menuPanel']   = 'Panel';
			$this->data['view']        = 'home/panel';

			$this->load->view('layout/template',  $this->data);  
        }     
    }

    public function login(){        
      $this->load->view('login/login');        
    }

    public function salir(){
        $this->session->sess_destroy();
        redirect('home/login');
    }


    public function verificarLogin(){ 
    //function check_database($password){ 
        //$this->load->library('encrypt');
        $username = $this->input->post('username');  
        $password = $this->input->post('password');  
        //$password = $this->encrypt->sha1($password);
		$password = sha1($password);

        $result   = $this->home_model->login_user($username, $password);

        $data['resultado'] = '';
     
       if($result) {
             //$sess_array = array();
            $datos = array();
            foreach($result as $row) { 
                if($row->estado==0) {
                  $data['resultado'] = 'inactivo';
                  echo json_encode($data);
                } else{   
  				    $nombres = $row->nombres .' '. $row->apellidos;				
                    $datos = array('nome'     => $nombres,
                				'id'          => $row->id,
                				'permiso'     => $row->id_permiso,
                				'nompermisos' => $row->permisos,
                                'imagen'      => $row->url_image,
                				'logado'      => TRUE);

                  $this->session->set_userdata($datos);
                  $data['resultado'] = 'ok';
                  echo json_encode($data);
                }
            }

       }else{
           $data['resultado'] = 'error';
           echo json_encode($data); 
       }
    }
	
	// Enviar correo al usuario con codigo de verificacion
	public function forgotPassword(){ 
		// Cargar librería y archivo de config
		$this->config->load('email'); 
		
		if($this->input->post('email')){
			//$username  = $this->input->post('txtUserName'); 			
			//$rest      = $this->home_model->forgot_password($username,'username');
			$email  = $this->input->post('email'); 
			$rest   = $this->home_model->forgot_password($email);

			if($rest == false){
				$result['valid']   = false;                 
				$result['message'] = 'Este E-mail no está registrado.';//$rest->message;
				//$result['message'] = 'El nombre de usuario no está registrado.';//$rest->message;
			}else{
				$user_login    = $rest[0]->login;
				$user_email    = $rest[0]->email;
				$user_passw    = $rest[0]->password;
				$user_name     = $rest[0]->nombres;
				$user_id       = $rest[0]->id;			
				$codigo        = generarCodigos(6);
				
				$data   = array(					
					'forgot_pass_identity' => $codigo												  
				);			
					$this->generales_model->edit('wsoft_usuarios', $data,'id',$user_id);
			   
					if((!strcmp($email, $user_email))){ 
						//if(!strcmp($username, $user_login)){ 
										
							/*Mail Code*/
							//$data = array();
							$this->data["nombre"] 	= $user_name;
							$this->data["codigo"] 	= $codigo;				
							$contenido_HTML 		= reset_password_html($this->data);				   
							$to_email   			= $user_email;
							$from_email 			= "info@microcys.com";
							$subject    			= "Recuperación de contraseña";
							
							$this->email->from($from_email,'Microcys SAC');
							$this->email->to($user_email);
							$this->email->subject($subject);             
							$this->email->message($contenido_HTML);
					if ($this->email->send()){
						// mail sent                 
						$result['valid']   = true;                 
						$result['message'] = "Se envio el correo satisfactoriamente";
					}else{
						//error
						//$this->email->print_debugger();
						$result['valid']   = false;                        
						$result['message'] = "No se pudo enviar el correo.";
					}
				}else{              
					$result['valid']   = 'error';                 
					//$result['message'] = 'Nombre de usuario inválido!';//$rest->message;
					$result['message'] = 'E-mail inválido!';//$rest->message;
				}
			  }
			}

		$this->output
				  ->set_content_type('application/json')
				  ->set_output(json_encode($result));
	}

	//Actualizar el Password despues de validar el codigo
	public function resetPassword(){ 
        // Cargar librería y archivo de config
        $this->config->load('email');               
        if($this->input->post('verifycode')){
            $code    = $this->input->post('verifycode');  
		    $passw1  = $this->input->post('password1');
		    $passw2  = $this->input->post('password2'); 
			
            $rest    = $this->home_model->getVerifyCode($code);
			
			//echo "Reset: ".$rest;

			if($rest == false){
				$result['valid']   = false;                 
				$result['message'] = 'El código no es valido.';//$rest->message;
            }else{           
			    $user_id	=	$rest[0]->id;
			    $password	=	sha1($passw1);
			
			    $data = array(					
					'password' => $password												  
				);
			
				if ($this->generales_model->edit('wsoft_usuarios', $data,'id',$user_id) == TRUE){  			
					$result['valid']   = true;                 
					$result['message'] = "Se ha cambiado la contraseña satisfactoriamente.";
				}else{
					$result['valid']   = false;                        
					$result['message'] = "No se pudo cambiar la contraseña.";
				}     
            }
       }

		$this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
	}




    public function changePassword() {
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('login/login');
        }

        $oldPassw = $this->input->post('oldPassw');
        $passw    = $this->input->post('newPassw');
		
		//$this->load->library('encrypt');   
       // $oldPassw = $this->encrypt->sha1($oldPassw);
			
		
		$this->load->library('encrypthash'); 
        $oldPassw = $this->encrypthash->tep_encrypt_password($oldPassw);		
        $passw    = $this->encrypthash->tep_encrypt_password($passw);
		
        $result   = $this->home_model->changePassword($passw,$oldPassw,$this->session->userdata('id'));
        if($result){
            $this->session->set_flashdata('success','Contraseña modificada con éxito!');
            redirect(base_url() . 'home/micuenta');
        }
        else{
            $this->session->set_flashdata('error','Ocurrio un error al modificar la contraseña!');
            redirect(base_url() . 'home/micuenta');
            
        }
    }


}
