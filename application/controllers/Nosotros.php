<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Nosotros extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {		
		parent::__construct();
		$this->load->library(array('session'));	
		$this->load->library('cart');
		$this->load->helper('url');
		$this->load->model('estados_model');
		$this->load->model('menus_model');
		$this->load->model('contenidos_model');
		$this->load->model('categorias_model');
		$this->load->model('maquinas_model');	
		$this->load->model('marcas_model');
		$this->load->model('modelos_model');
		$this->load->model('productos_model');
		$this->load->library('pagination');	
		$this->load->library('funciones');
	}
	
	
	public function index() {	
	
		$this->nosotros();
		
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
		
	 public function nosotros(){
    	 if ($this->uri->segment(1) === FALSE)
		{
		    $content = 0;
		}
		else
		{
		    $content = $this->uri->segment(1);
			
		}
	//var_dump($content);
	    $data['site']       = $this->contenidos_model->sp_getSiteOffline();
		//$id = $this->input->post('id');
    	//$data['tipos'] = $this->user_model->get_users_tipos();
    	$data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
    	$data['menus']    	 	 = $this->menus_model->sp_getMenus();
    	$data['content']    	 = $this->contenidos_model->sp_getContenidos($content);
    	$data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$data['banners']    	 = $this->contenidos_model->sp_getBanners();	

 		
		$data['header'] 	= 'home/header';	
		$data['catmenu']   	= 'home/menucat';	
		$data['slider'] 	= 'home/slider';
        $data['view']   	= 'home/contenido';
        $data['footer'] 	= 'home/footer';
       
        $this->load->view('layout/layout',  $data);	
		
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
