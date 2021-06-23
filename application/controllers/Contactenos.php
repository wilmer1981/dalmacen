<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Contactenos extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {		
		parent::__construct();	
        $this->load->library(array('session','form_validation', 'email','cart'));		
		$this->load->helper('url');
		$this->load->model('estado_model');
		$this->load->model('menu_model');
		$this->load->model('contenido_model');
		$this->load->model('categoria_model');
		$this->load->model('maquina_model');	
		$this->load->model('marca_model');
		$this->load->model('modelo_model');
		$this->load->model('producto_model');
		$this->load->library('pagination');	
		$this->load->library('funciones');		
	}
	
	
	public function index() {	

		//$this->categories();
		$this->contactenos();
		
	}



	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register2() {		
		// create the data object
		$data = new stdClass();	

		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');	

		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) {			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('user/register/register', $data);
			$this->load->view('footer');			
		} else {			
			// set variables from the form
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');			
			if ($this->user_model->create_user($username, $email, $password)) {				
				// user creation ok
				$this->load->view('header');
				$this->load->view('user/register/register_success', $data);
				$this->load->view('footer');				
			} else {				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/register/register', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
		
	

    public function cotizacion(){
		
		$nom = $this->input->post('nombre');
		$cor = $this->input->post('correo');
		$tel = $this->input->post('telefono');
		$idp = $this->input->post('idprod');
        
        if ($this->contactenos_model->add_cotizacion($nom, $cor, $tel, $idp)) {				
				// user creation ok
				//$this->load->view('header-home');
				//$this->load->view('user/register/register_success', $data);
				//$this->load->view('footer-home');	

				echo'<div class="alert alert-success">Envio correcto.</div>';

				//redirect(base_url('index.php/user/get_users'), 'refresh');


			} else {				
				//$data->error = 'There was a problem creating your new account. Please try again.';				
			// user creation failed, this should never happen
					// send error to the view
				//$this->load->view('header-home');
				//$this->load->view('user/register', $data);
				//$this->load->view('footer-home');

				echo'<div class="alert alert-danger">Hubo un problema al enviar solicitud. Por favor, inténtelo de nuevo.</div>';		
				
			}
    }

    public function suscripcion(){
	
		$email = $this->input->post('email');
	
        
        if ($this->contactenos_model->add_suscripcion($email)) {				
				// user creation ok
				echo'<div class="alert alert-success">suscripcion correcta.</div>';
				//redirect(base_url('index.php/user/get_users'), 'refresh');


			} else {				
				//$data->error = 'There was a problem creating your new account. Please try again.';				
			// user creation failed, this should never happen
					// send error to the view
				//$this->load->view('header-home');
				//$this->load->view('user/register', $data);
				//$this->load->view('footer-home');

				echo'<div class="alert alert-danger">Hubo un problema al enviar solicitud. Por favor, inténtelo de nuevo.</div>';		
				
			}
    }


    public function contacto(){
    	 	//get the form data
			$name       = $this->input->post('userName');
			$from_email = $this->input->post('userEmail');
			$phone      = $this->input->post('userPhone');
			$message    = $this->input->post('userMsg');
			$subject    = "Mensaje enviado de la pagina";
			
			$output = "DATOS DE CONTACTO: \n";
			$output .= "------------------\n\n";
			$output .= "Nombre   : $name\n";
			$output .= "Email    : $from_email\n";
			$output .= "Telefono : $phone\n";
			$output .= "Mensaje  : $message\n";

            
            //set to_email id to which you want to receive mails
            /*
			$to_email = 'wilmer1981@gmail.com';
            
            //configure email settings
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.gmail.com'; // change this to yours
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'wilmer1981@gmail.com'; // change this to yours
            $config['smtp_pass'] = 'soyelmejor12345,,'; // change this to yours
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n"; //use double quotes
			*/
			$to_email = 'ventas@escalerasymaniobras.com';  
			//$to_email = 'wilmer_1981@hotmail.com';  
			
			$config['protocol'] = 'mail';		
			$config['smtp_host'] = 'gator4131.hostgator.com'; // change this to yours
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'ventas@maniobrasarequipa.com'; // change this to yours
			$config['smtp_pass'] = 'PERU2015'; // change this to yours
			$config['mailtype'] = 'html';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['newline'] = "\r\n"; //use double quotes   
				
			$this->email->initialize($config);            
            //send mail
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($output);
            if ($this->email->send())
            {
                // mail sent
                echo "YES";
            }
            else
            {
                //error
                echo "NO";
            }
   
    }




    public function contactenos(){
		
		$data['site']       = $this->contenido_model->sp_getSiteOffline();
		//$id = $this->input->post('id');
    	//$data['tipos'] = $this->user_model->get_users_tipos();
    	$data['marcas']     	 = $this->marca_model->sp_getMarcasAll();	
    	$data['menus']    	 	 = $this->menu_model->sp_getMenus();
    	$data['features']    	 = $this->producto_model->sp_getProductsFeatures();	
		$data['banners']    	 = $this->contenido_model->sp_getBanners();	

	
		$data['header'] 	= 'home/header';	
		$data['catmenu']   	= 'home/menucat';	
		$data['slider'] 	= 'home/slider';
        $data['view']   	= 'home/contactenos';
        $data['footer'] 	= 'home/footer';
       
        $this->load->view('layout/layout',  $data);	
		
    }




    public function add_user(){
    	// create the data object
		$data = new stdClass();
    	// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');	

		// set validation rules
		//$this->form_validation->set_rules('username', 'user name', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.email]', array('is_unique' => 'This username already exists. Please choose another one.'));
		//$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		//$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		//$this->form_validation->set_rules('nombre', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[wsoft_usuarios.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		
		if ($this->form_validation->run() === false) {			
			// validation not ok, send validation errors to the view
			//$data->error = 'There was a problem creating your new account. Please try again.';				
			//$this->load->view('header-home');
			//$this->load->view('user/register', $data);
			//$this->load->view('footer-home');	

			echo'<div class="alert alert-danger">'.validation_errors().'</div>';
            exit;

		} else {			
			// set variables from the form
			$email      = $this->input->post('email');
			$password   = $this->input->post('password');
			$nombre     = $this->input->post('nombre');	
			$apellidos  = $this->input->post('apellidos');	
			$tipo       = $this->input->post('tipo');	
			$telefono   = $this->input->post('telefono');
			$direccion  = $this->input->post('direccion');	
			$genero     = $this->input->post('gender');	

			if ($this->user_model->add_user($nombre, $apellidos, $genero, $email, $password, $tipo, $direccion, $telefono)) {				
				// user creation ok
				//$this->load->view('header-home');
				//$this->load->view('user/register/register_success', $data);
				//$this->load->view('footer-home');	

				echo'<div class="alert alert-success">Successfully</div>';

				//redirect(base_url('index.php/user/get_users'), 'refresh');


			} else {				
				//$data->error = 'There was a problem creating your new account. Please try again.';				
			// user creation failed, this should never happen
					// send error to the view
				//$this->load->view('header-home');
				//$this->load->view('user/register', $data);
				//$this->load->view('footer-home');

				echo'<div class="alert alert-danger">There was a problem creating your new account. Please try again.</div>';
		

				//echo'<div class="alert alert-danger">'..'</div>';
				
			}
			
		}
	
			/*
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('contact', 'Contact Number', 'required|numeric|max_length[10]|min_length[10]');
            if ($this->form_validation->run() == FALSE){
               echo'<div class="alert alert-danger">'.validation_errors().'</div>';
               exit;
            }
            else{
                $this->home_model->create();
            }*/
    }

     public function create_user(){
    	// create the data object
		$data = new stdClass();
    	// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');	

		// set validation rules
		$this->form_validation->set_rules('email', 'email', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		//$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		//$this->form_validation->set_rules('nombre', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		
		if ($this->form_validation->run() === false) {			
			// validation not ok, send validation errors to the view
			$this->load->view('header-home');
			$this->load->view('user/register', $data);
			$this->load->view('footer-home');			
		} else {			
			// set variables from the form
			$username   = $this->input->post('username');
			$email      = $this->input->post('email');
			$password    = $this->input->post('password');	
	
			if ($this->user_model->create_user($username, $email, $password)) {				
				// user creation ok
				$this->load->view('header');
				$this->load->view('user/register/register_success', $data);
				$this->load->view('footer');				
			} else {				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/register/register', $data);
				$this->load->view('footer');
				
			}
			
		}
	
			/*
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('contact', 'Contact Number', 'required|numeric|max_length[10]|min_length[10]');
            if ($this->form_validation->run() == FALSE){
               echo'<div class="alert alert-danger">'.validation_errors().'</div>';
               exit;
            }
            else{
                $this->home_model->create();
            }*/
    }





    public function update_user(){
                $res['error']="";
                $res['success']="";
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('contact', 'Contact Number', 'required|numeric|max_length[10]|min_length[10]');
                if ($this->form_validation->run() == FALSE){
                $res['error']='<div class="alert alert-danger">'.validation_errors().'</div>';    
                }           
            else{
                $data = array('name'=>  $this->input->post('name'),
                'email'=>$this->input->post('email'),
                'contact'=>$this->input->post('contact'),
                'facebook_link'=>$this->input->post('facebook'));
                $this->db->where('id', $this->input->post('hidden'));
                $this->db->update('curd', $data);
                $data['success'] = '<div class="alert alert-success">One record inserted Successfully</div>';
            }
            header('Content-Type: application/json');
            echo json_encode($res);
            exit;
    }

    public function eliminar(){
    	$id = $this->input->post('id');
        $this->user_model->delete_user($id);
        redirect(base_url('index.php/user/get_users/'), 'refresh');
    }

    //eliminar por href
    public function eliminar_user($id){
       $delete= $this->user_model->eliminar_user($id);
        
        if($delete) return json_encode(array("success" => true));
        //redirect(base_url('index.php/user/get_users/'), 'refresh');
    }

     public function eliminar_user3($id){
      	$jsondata = array();
        if($this->user_model->eliminar_user($id)){ 
            //$response['success']='<div class="alert alert-success">One record deleted Successfully</div>';     
        	$jsondata['success']=true;  
        	$jsondata['message']='One record deleted Successfully';    
       	}else{
			//$response['error']='<div class="alert alert-danger"> Error</div>';
			$jsondata['success']=false;  
        	$jsondata['message']='Error One record deleted'; 
		}

		header('Content-type: application/json; charset=utf-8');
  		echo json_encode($jsondata, JSON_FORCE_OBJECT);
       //echo json_encode($response);
        	//return json_encode(array("success" => true));
       // redirect(base_url('index.php/user/get_users/'), 'refresh');
    }
}
