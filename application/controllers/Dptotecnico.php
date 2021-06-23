<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Dptotecnico extends CI_Controller {

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
		//$id =  $this->uri->segment(1);
		//var_dump($id);

		$this->contenido();
		
	}



    public function contenido(){

    	if ($this->uri->segment(1) === FALSE)
		{
		    $content = 0;
		}
		else
		{
		    $content = $this->uri->segment(1);
		}
        
		$data['site']       = $this->contenido_model->sp_getSiteOffline();

    	$data['marcas']     	 = $this->marca_model->sp_getMarcasAll();	
    	$data['menus']    	 	 = $this->menu_model->sp_getMenus();
    	$data['content']    	 = $this->contenido_model->sp_getContenidos($content);
        $data['features']        = $this->producto_model->sp_getProductsFeatures(); 
        $data['banners']         = $this->contenido_model->sp_getBanners(); 

        //$this->load->view('header',$data);	
		//$this->load->view('home/contenido',$data);
		//$this->load->view('footer',$data);
		
		$data['header'] 	= 'home/header';	
		$data['catmenu']   	= 'home/menucat';	
		$data['slider'] 	= 'home/slider';
        $data['view']   	= 'home/contenido';
        $data['footer'] 	= 'home/footer';
       
        $this->load->view('layout/layout',  $data);	
		
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
