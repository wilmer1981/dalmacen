<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Contenidos extends CI_Controller {

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
		$this->load->helper(array('url'));
		//$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->model('menus_model');
		$this->load->model('marcas_model');
		$this->load->model('modelos_model');
		$this->load->model('maquinas_model');
		$this->load->model('contenidos_model');
		$this->load->model('productos_model');
		$this->load->library('pagination');	
		$this->load->model('estados_model');
		$this->load->library('funciones');		
	}
	
	
	public function index() {	

		$this->productos();
		
	}


    public function registro(){
		//$id = $this->input->post('id');
    	//$data['tipos'] = $this->user_model->get_users_tipos();
        $this->load->view('header');
		//$this->load->view('user/register',$data);
		$this->load->view('user/register');
		$this->load->view('footer');
    }

	
	public function preview(){	
	
	
		//$id = $this->input->post('id');
		$url       =  $this->uri->segment(3);      
    	$array 		= explode("-", $url);
    	$idprod     =  $array[0];  
    	//var_dump($url);
    	//var_dump($idprod);
		
		$limit=2;

    	//$data['breadcrumb']      = $this->maquinas_model->sp_getBreadcrumbs($idprod,'producto');
		$data['site']       = $this->contenidos_model->sp_getSiteOffline();
        $data['breadcrumb']      = $this->maquinas_model->sp_getBreadcrumbs($idprod,'productos');

		//$data['estados']    	 = $this->estados_model->get_estados();	
		$data['menus']    	 	 = $this->menus_model->sp_getMenus();			
		$data['categorias']      = $this->maquinas_model->sp_getCategorias();
		$data['subcategorias']   = $this->maquinas_model->sp_getSubCategorias();	
		//$data['categoriaslimit'] = $this->maquinas_model->sp_getCategoriasLimit($limit);		
		$data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
		//$data['features']    	 = $this->productos_model->sp_getProductsFeatures($limit);	
		//$data['promotions']    	 = $this->productos_model->sp_getProductsPromotions();	
	
	
    	$data['producto']   = $this->productos_model->sp_getProducto($idprod);	
    	$data['images']     = $this->productos_model->sp_getProductoImages($idprod);
        //$data['filesprod']   = $this->productos_model->sp_getProductosFile('producto',$idprod);	
				
      // var_dump($data['breadcrumb']);
	   
    	//var_dump($data['producto']);
		$data['features']    	 = $this->productos_model->sp_getProductsFeatures();
        $data['latests']    	 = $this->productos_model->sp_getProductsLatest();		
			
		$data['banners']    	 = $this->contenidos_model->sp_getBanners();

        //$this->load->view('header',$data);
		//$this->load->view('productos/preview',$data);
		//$this->load->view('footer',$data);
		
	
		//$data['featuresview']  	= 'productos/productos_features';	      
       
    	
		$data['header'] 	= 'home/header';
		$data['slider'] 	= 'home/slider';
		//$data['catmenu']   	= 'home/menucat';	
		$data['catmenu']   	= 'home/menu-acordeon';
        $data['view']   	= 'productos/preview';	
        $data['footer'] 	= 'home/footer'; 
		$data['featuresmod']= 'home/features';	
		$data['latestsmod']= 'home/latest';	
		
        $this->load->view('layout/layout',  $data);	
		
		
    }
	

    public function subcategoria(){
		//$id = $this->input->post('id');
		$id =  $this->uri->segment(3);
    	//$data['tipos'] = $this->user_model->get_users_tipos();
    	$data['menus']	= $this->menus_model->sp_getMenus();	
        $this->load->view('header',$data);
		//$this->load->view('user/register',$data);
		$this->load->view('productos/preview');
		$this->load->view('footer');
    }


    public function categories(){
		
		$data['site']            = $this->contenidos_model->sp_getSiteOffline();
		$limit=8;
		$data['estados']    	 = $this->estados_model->get_estados();	
		$data['menus']    	 	 = $this->menus_model->sp_getMenus();
			
		$data['categorias']      = $this->maquinas_model->sp_getCategorias();
		$data['subcategorias']   = $this->maquinas_model->sp_getSubCategorias();	

		$data['categoriaslimit'] = $this->maquinas_model->sp_getCategoriasLimit($limit);		
		$data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
		$data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$data['banners']    	 = $this->contenidos_model->sp_getBanners();	
		$data['latests']    	 = $this->productos_model->sp_getProductsLatest();
		
		
		
		$data['header'] 	= 'home/header';	
		//$data['catmenu']   	= 'home/menucat';
		$data['catmenu']   	= 'home/menu-acordeon';
        	
		$data['slider'] 	= 'home/slider';
       // $data['view']   	= 'productos/catalogo_categorias';
		$data['view']   	= 'home/panel';
        $data['footer'] 	= 'home/footer';
		$data['featuresmod']= 'home/features';	
		$data['latestsmod']= 'home/latest';	
       
        $this->load->view('layout/layout',  $data);		
		
    }

    public function subcategories(){
		//$id = $this->input->post('id');
    	//$data['tipos'] = $this->user_model->get_users_tipos();
    	$data['menus']    	 	 = $this->menus_model->sp_getMenus();
    	$data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$data['modelos']    	 = $this->modelos_model->sp_getModelosAll();		
        $this->load->view('header',$data);
		//$this->load->view('user/register',$data);
		//$this->load->view('productos/categories');
		$this->load->view('productos/subcategories');
		$this->load->view('footer',$data);
    }

    public function productos(){ 

      //var_dump($this->uri->segment(1));	
	$url = $this->uri->segment(2);

	//$config['base_url'] = base_url().'productos/'.$url.'/';
	$config['base_url'] = base_url().'productos/';
		
	 //$config['base_url'] = base_url().'catalogo/productos/'.$idsub.'/';
	$total_c1             = $this->productos_model->count('wsoft_productos');
	$config['total_rows'] = $total_c1;
        $config['per_page'] = 12;
		if($this->uri->segment(2)){
			$config['per_star'] = $this->uri->segment(2);
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
		$config['first_link'] = 'Primera';	
		$config['prev_link'] = 'Anterior';		
		$config['last_link'] = '&Uacute;ltima';	
		$config['next_link'] = 'Pr&oacute;xima';
		$config['first_tag_open'] = '<li>'; 
		$config['first_tag_close'] = '</li>'; 
		$config['last_tag_open'] = '<li>'; 
		$config['last_tag_close'] = '</li>'; 

	    /* Se inicializa la paginacion*/
    	$this->pagination->initialize($config);
		

	    $data['site']            = $this->contenidos_model->sp_getSiteOffline();
		$limit=8;
		$data['estados']    	 = $this->estados_model->get_estados();	
		$data['menus']    	 	 = $this->menus_model->sp_getMenus();
			
		$data['categorias']      = $this->maquinas_model->sp_getCategorias();
		$data['subcategorias']   = $this->maquinas_model->sp_getSubCategorias();	

		$data['categoriaslimit'] = $this->maquinas_model->sp_getCategoriasLimit($limit);		
		$data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
		$data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$data['banners']    	 = $this->contenidos_model->sp_getBanners();	
		$data['latests']    	 = $this->productos_model->sp_getProductsLatest();
		$data['productos']    	 = $this->productos_model->sp_getProducts($config['per_page'],$config['per_star']);
		
 	
		
		
		//$this->load->view('productos/productos',$data);
		//$this->load->view('footer',$data);
		
	$data['header'] 	= 'home/header';	
		//$data['catmenu']   	= 'home/menucat';
	$data['catmenu']   	= 'home/menu-acordeon';
       	$data['slider'] 	= 'home/slider';
       // $data['view']   	= 'productos/catalogo_categorias';
	$data['view']   	= 'productos/productosCatalogo';
        $data['footer'] 	= 'home/footer';
	$data['featuresmod']= 'home/features';	
	$data['latestsmod']= 'home/latest';	
       
        $this->load->view('layout/layout',  $data);	
		
    }
	
	  public function productossss(){
		

    	$url       =  $this->uri->segment(3);  
    	//$idsub     = substr($url, 0, 1);
    	$array 		= explode("-", $url);
    	$idsub     =  $array[0];  
    	
		$config['base_url'] = base_url().'productos/'.$url.'/';
	    //$config['base_url'] = base_url().'catalogo/productos/'.$idsub.'/';
	    $total_c1           = $this->maquinas_model->count('wsoft_productos',$idsub);
	    //$total_c1 = 5;
	    //echo "Total: ".$total_c1;
		$config['total_rows'] = $total_c1;
        $config['per_page'] = 12;
		if($this->uri->segment(4)){
			$config['per_star'] = $this->uri->segment(4);
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
		$config['first_link'] = 'Primera';	
		$config['prev_link'] = 'Anterior';		
		$config['last_link'] = '&Uacute;ltima';	
		$config['next_link'] = 'Pr&oacute;xima';
		$config['first_tag_open'] = '<li>'; 
		$config['first_tag_close'] = '</li>'; 
		$config['last_tag_open'] = '<li>'; 
		$config['last_tag_close'] = '</li>'; 

	    /* Se inicializa la paginacion*/
    	$this->pagination->initialize($config);

    	/* Se obtienen los registros a mostrar*/
   		//$data['users'] = $this->user_model->get_usuarios($config['per_page'], $this->uri->segment(3)); 
		$data['site']            = $this->contenidos_model->sp_getSiteOffline();
    	$data['breadcrumb']      = $this->maquinas_model->sp_getBreadcrumbs($idsub,'subcategorias');
		$data['categorias']      = $this->maquinas_model->sp_getCategorias();
		$data['subcategorias']   = $this->maquinas_model->sp_getSubCategorias();
    	$data['menus']    	 	 = $this->menus_model->sp_getMenus();
    	$data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$data['modelos']    	 = $this->modelos_model->sp_getModelosAll();		
		$data['productos']    	 = $this->productos_model->sp_getProductosLis($idsub,$config['per_page'],$config['per_star']);
		$data['filesprod']       = $this->productos_model->sp_getProductosFile('',$idsub);	
		//var_dump($data['productos']);	
		//var_dump($data['filesprod']);	
        $data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$data['banners']    	 = $this->contenidos_model->sp_getBanners();			
        

		//var_dump($data['breadcrumb']);	
		
     	$data['header'] 	= 'home/header';
		$data['slider'] 	= 'home/slider';
		//$data['catmenu']   	= 'home/menucat';
        $data['catmenu']   	= 'home/menu-acordeon';		
        $data['view']   	= 'productos/productos';
		//$data['view']   	= 'productos/productosLista';
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
