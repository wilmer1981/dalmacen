<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Users extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {		
		parent::__construct();
		$this->load->library(array('session'));
		//$this->load->helper(array('url'));
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('pagination');		
	}
	
	
	public function index() {		

		
	}

    public function get_userss() {
        // create the data object
        //$data = new stdClass();         
           $data['users'] = $this->user_model->get_users();
       // if ($this->user_model->get_users()) {                
            // user creation ok
            $this->load->view('header-home');
            $this->load->view('user/list/list', $data);
            $this->load->view('footer-home');                
        //}        
    } 

    public function get_users() {
    	$pages=10; //Número de registros mostrados por páginas

    	/* URL a la que se desea agregar la paginación*/
    	$config['base_url'] = base_url().'index.php/user/get_users/';
        /*Obtiene el total de registros a paginar */
   		$config['total_rows'] = $this->user_model->get_total_usuarios(); 
   		/*Obtiene el numero de registros a mostrar por pagina */
    	//$config['per_page'] = '1';
    	$config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
 
    	/*Indica que segmento de la URL tiene la paginación, por default es 3*/
    	//$config['uri_segment'] = '2'; 
    	$config["uri_segment"] = 3;//el segmento de la paginación

    	/*Se personaliza la paginación para que se adapte a bootstrap*/
    	/*
	    $config['cur_tag_open']  = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open']  = '<li>';
	    $config['num_tag_close'] = '</li>';
	    //$config['last_link']     = FALSE;
	    //$config['first_link']    = FALSE;
	    $config['first_link']    = 'Primera';//primer link
		$config['last_link']     = 'Última';//último link
	    $config['next_link']     = '&raquo;';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close']= '</li>';
	    $config['prev_link']     = '&laquo;';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close']= '</li>';
	     */	
	    $config['full_tag_open']  = '<ul class="pagination pagination-md pagination-height">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open']   = '<li>';
		$config['num_tag_close']  = '</li>';
		$config['cur_tag_open']   = '<li class="active"><span>';
		$config['cur_tag_close']  = '<span></span></span></li>';
		$config['prev_tag_open']  = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open']  = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_link']     = 'Primera';
		$config['prev_link']      = '&laquo;';
		$config['last_link']      = 'Última';
		$config['next_link']      = '&raquo;';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close']= '</li>';
		$config['last_tag_open']  = '<li>';
		$config['last_tag_close'] = '</li>'; 

	    /* Se inicializa la paginacion*/
    	$this->pagination->initialize($config);

    	/* Se obtienen los registros a mostrar*/
   		$data['users'] = $this->user_model->get_usuarios($config['per_page'], $this->uri->segment(3)); 
  		//$data['users'] = $this->user_model->get_usuarios($config['per_page'], $config['uri_segment']); 
  		
  		//$data['users'] = $this->user_model->total_paginados($config['per_page'], $config['uri_segment']); 
  		
  		//$data['users'] = $this->user_model->total_paginados($config['per_page'], $this->uri->segment(3)); 
        // $data['users'] = $this->user_model->get_users();
       // if ($this->user_model->get_users()) {                
            // user creation ok
            $this->load->view('header-home');
            $this->load->view('user/list/list', $data);
            $this->load->view('footer-home');                
        //}        
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
		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('user/login/login');
			$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->user_model->resolve_user_login($username, $password)) {
				
				$id      = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($id);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->login;
				$_SESSION['logged_in']    = (bool)true;
				//$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				//$_SESSION['is_admin']     = (bool)$user->is_admin;
				
				// user login ok
				//$this->load->view('header-home');
				//$this->load->view('user/login/login_success', $data);
				redirect(base_url('index.php/chome'), 'refresh');
				//$this->load->view('example', $data);
				//$this->load->view('footer-home');
				
			} else {
				
				// login failed
				$data->error = 'Wrong username or password.';				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/login/login', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	/*public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->view('header');
			$this->load->view('user/logout/logout_success', $data);
			$this->load->view('footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			//redirect('user/logout/');
			
		}
		
	}*/
	
	function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect(base_url('/'), 'refresh');
    }

    public function register(){
		//$id = $this->input->post('id');
    	//$data['tipos'] = $this->user_model->get_users_tipos();
        $this->load->view('header');
		//$this->load->view('user/register',$data);
		$this->load->view('user/register');
		$this->load->view('footer');
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


    public function edit_user(){
		//$id   = $this->input->post('id');
		$id =  $this->uri->segment(3);
    	$user = $this->user_model->get_user($id);
    	$data['id']        = (int)$user->id;
		$data['username']  = (string)$user->login;
		$data['nombre']    = (string)$user->nombre;
		$data['apellidos'] = (string)$user->apellidos;
		$data['email']     = (string)$user->email;
       //$id =  $this->uri->segment(3);
       // $this->db->where('id',$id);
        //$data['query'] = $this->db->get('curd');
       // $data['id'] = $id;
        $this->load->view('user/edit', $data);
    }

    public function user_edit(){
		//$id   = $this->input->post('id');
		$id =  $this->uri->segment(3);
    	$user = $this->user_model->get_user($id);
    	
    	$data['id']        = (int)$user->id;
		$data['username']  = (string)$user->login;
		$data['nombre']    = (string)$user->nombre;
		$data['apellidos'] = (string)$user->apellidos;
		$data['email']     = (string)$user->email;
		$data['idgrupo']      = (string)$user->idgrupo;
		$data['grupo']      = (string)$user->grupo;

		$data['tipos']     = $this->user_model->get_users_tipos();
       //$id =  $this->uri->segment(3);
       // $this->db->where('id',$id);
        //$data['query'] = $this->db->get('curd');
       // $data['id'] = $id;
		

		$this->load->view('header-home');
        $this->load->view('user/edit-user', $data);
        $this->load->view('footer-home');
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
