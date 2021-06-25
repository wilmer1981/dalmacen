<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Productos extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {		
		parent::__construct();			
		$this->load->model('users_model');
		$this->load->model('menus_model');
		$this->load->model('marcas_model');
		$this->load->model('modelos_model');
		$this->load->model('maquinas_model');
		$this->load->model('contenidos_model');
		$this->load->model('productos_model');
		$this->load->library('pagination');	
		$this->load->model('estados_model');
		$this->load->model('generales_model','',TRUE);
		$this->load->library('funciones');		
	}
	
	public function index(){
		//$this->categories();
		$this->producto();		
	}

    public function registro(){
		//$id = $this->input->post('id');
    	//$this->data['tipos'] = $this->user_model->get_users_tipos();
        $this->load->view('header');
		//$this->load->view('user/register',$this->data);
		$this->load->view('user/register');
		$this->load->view('footer');
    }

    public function catalogo(){
    	$url       =  $this->uri->segment(2);
		//echo "URL : ".$url."<br>"; 

    	$categoria = $this->generales_model->get('wsoft_categorias','','url="'.$url.'"','','');
		//var_dump($categoria);

		if(!empty($categoria)){			
			$id                  = $categoria[0]->id; //24
			$idpad               = $categoria[0]->id_categoria;//5

		   //echo "<br>categoria(id):".$id;	
           if($idpad !=0){
				$categoria1 = getSubcategoria($id);//consultamos si tiene subcatehgoria
				if(!empty($categoria1)){	
					$id         = $categoria1[0]->id; //24
					$idpad      = $categoria1[0]->id_categoria;//5
			    }
			}

			$this->data['titulo']= $categoria[0]->titulo;

		}else{
			$id        = 0;
			$idpad     = 0;
			$this->data['titulo']=$url;
		}

		//echo "<br>categoria(id):".$id;	
		//echo "<br>categoria padre(idpad):".$idpad;				
		
		if($idpad == 0){ //categoria padre
			$opcion= "categoria";
		}else{
			$opcion= "subcategoria";
		}

		//$config['base_url']   = base_url().'productos/catalogo/'.$url.'/';
		$config['base_url']   = base_url().'productos/'.$url.'/';
		//echo "<br>Opcon: ".$opcion;
		//echo "<br>ID: ".$id;

		$total_records        = $this->generales_model->count_products($opcion,$id);

		//echo "<br>Total: ".$total_records."<br>";
		$config['total_rows'] = $total_records;
        $config['per_page']   = 6;
		if($this->uri->segment(3)){
			$config['per_star'] = $this->uri->segment(3);
		}else{
			$config['per_star'] = 0;
		}
		
		$config['full_tag_open'] = '<ul class="pagination pagination-md pull-right">';
		$config['full_tag_close'] = '</ul>'; 

		$config['num_tag_open'] = '<li>'; 
		$config['num_tag_close'] = '</li>'; 

		$config['cur_tag_open'] = '<li class="active"><span>'; 
		$config['cur_tag_close'] = '<span></span></span></li>'; 

        $config['prev_link'] = 'Anterior';
		$config['prev_tag_open'] = '<li class="pg-prev">'; 
		$config['prev_tag_close'] = '</li>';
		

  		$config['next_link'] = 'Pr&oacute;xima';
		$config['next_tag_open'] = '<li class="pg-next">'; 
		$config['next_tag_close'] = '</li>'; 
		

		$config['first_link'] = 'Primera';
		$config['first_tag_open'] = '<li>'; 
		$config['first_tag_close'] = '</li>'; 

        $config['last_link'] = '&Uacute;ltima';	
		$config['last_tag_open'] = '<li>'; 
		$config['last_tag_close'] = '</li>'; 
		

	    /* Se inicializa la paginacion*/
    	$this->pagination->initialize($config);


    	$this->data['breadcrumb']    = $this->contenidos_model->sp_getBreadcrumbs($opcion,$url);
    	$this->data['productos']     = $this->productos_model->sp_getProductosLis($opcion,$id,$idpad,$config['per_page'],$config['per_star']);

    	//var_dump($this->data['productos']);
    	$this->data['categories']     = $this->productos_model->sp_getCategoriasList($opcion,$id);

    	//var_dump($this->data['categories']);

  
		$this->data['estados']			= $this->estados_model->get_estados();
		
		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();
			
		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();	
		//var_dump($data['categorias']);
		//var_dump($this->data['subcategorias']);   
		$limit=8;

		$this->data['categoriaslimit'] = $this->productos_model->sp_getCategoriasLimit($limit);		
		$this->data['marcas']     	   = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	   = $this->modelos_model->sp_getModelosAll();	
		$this->data['features']    	   = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	   = $this->contenidos_model->sp_getBanners();	
		$this->data['latests']    	   = $this->productos_model->sp_getProductsLatest();		
	
		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		$this->data['breadcrumbs']  = 'home/breadcrumbs';

		$this->data['menucategorie']   	= 'home/menu-categorias-lateral';

		$this->data['header']		= 'home/header';        	
		$this->data['slider']		= 'home/slider';
        $this->data['view']			= 'productos/productos_catalogo';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';	
       
        $this->load->view('layout/layout',  $this->data);	

    }

	public function preview(){	
		$url       =  $this->uri->segment(2); 	
    	$data   = explode("-", $url);
		$idprod = $data[0];

		$this->data['site']				= $this->contenidos_model->sp_getSiteOffline();
		$this->data['estados']			= $this->estados_model->get_estados();
		
		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();			
		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();	
		//var_dump($data['categorias']);
		//var_dump($this->data['subcategorias']); 
		$where='p.id="'.$idprod.'"'; 
		$this->data['producto']   = $this->productos_model->sp_getProducto($where);	
		var_dump($this->data['producto']);  
		$this->data['marcas']     	   = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	   = $this->modelos_model->sp_getModelosAll();	
		$this->data['features']    	   = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	   = $this->contenidos_model->sp_getBanners();	
		$this->data['latests']    	   = $this->productos_model->sp_getProductsLatest();		
	
		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		$this->data['breadcrumbs']  = 'home/breadcrumbs';

		$this->data['header']		= 'home/header';        	
		$this->data['slider']		= 'home/slider';
        $this->data['view']			= 'productos/productos_detalle';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';	
       
        $this->load->view('layout/layout', $this->data);		
    }

    public function subcategoria(){
		//$id = $this->input->post('id');
		$id =  $this->uri->segment(3);
    	//$this->data['tipos'] = $this->user_model->get_users_tipos();
    	$this->data['menus']	= $this->menus_model->sp_getMenus();	
        $this->load->view('header',$this->data);
		//$this->load->view('user/register',$this->data);
		$this->load->view('productos/preview');
		$this->load->view('footer');
    }


    public function categories(){
		
		$this->data['site']            = $this->contenidos_model->sp_getSiteOffline();
		$limit=8;
		$this->data['estados']    	 = $this->estados_model->get_estados();	
		$this->data['menus']    	 	 = $this->menus_model->sp_getMenus();
			
		$this->data['categorias']      = $this->maquinas_model->sp_getCategorias();
		$this->data['subcategorias']   = $this->maquinas_model->sp_getSubCategorias();	

		$this->data['categoriaslimit'] = $this->maquinas_model->sp_getCategoriasLimit($limit);		
		$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
		$this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();	
		$this->data['latests']    	 = $this->productos_model->sp_getProductsLatest();
		
		
		
		$this->data['header'] 	= 'home/header';	
		//$this->data['catmenu']   	= 'home/menucat';
		$this->data['catmenu']   	= 'home/menu-acordeon';
        	
		$this->data['slider'] 	= 'home/slider';
       // $this->data['view']   	= 'productos/catalogo_categorias';
		$this->data['view']   	= 'home/panel';
        $this->data['footer'] 	= 'home/footer';
		$this->data['featuresmod']= 'home/features';	
		$this->data['latestsmod']= 'home/latest';	
       
        $this->load->view('layout/layout',  $this->data);		
		
    }

    public function subcategories(){
		//$id = $this->input->post('id');
    	//$this->data['tipos'] = $this->user_model->get_users_tipos();
    	$this->data['menus']    	 	 = $this->menus_model->sp_getMenus();
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();		
        $this->load->view('header',$this->data);
		//$this->load->view('user/register',$this->data);
		//$this->load->view('productos/categories');
		$this->load->view('productos/subcategories');
		$this->load->view('footer',$this->data);
    }

  
	  public function productosss(){
		

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
   		//$this->data['users'] = $this->user_model->get_usuarios($config['per_page'], $this->uri->segment(3)); 
		$this->data['site']            = $this->contenidos_model->sp_getSiteOffline();
    	$this->data['breadcrumb']      = $this->maquinas_model->sp_getBreadcrumbs($idsub,'subcategorias');
		$this->data['categorias']      = $this->maquinas_model->sp_getCategorias();
		$this->data['subcategorias']   = $this->maquinas_model->sp_getSubCategorias();
    	$this->data['menus']    	 	 = $this->menus_model->sp_getMenus();
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();		
		$this->data['productos']    	 = $this->productos_model->sp_getProductosLis($idsub,$config['per_page'],$config['per_star']);
		$this->data['filesprod']       = $this->productos_model->sp_getProductosFile('',$idsub);	
		//var_dump($this->data['productos']);	
		//var_dump($this->data['filesprod']);	
        $this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();			
        

		//var_dump($this->data['breadcrumb']);	
		
     	$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
		//$this->data['catmenu']   	= 'home/menucat';
        $this->data['catmenu']   	= 'home/menu-acordeon';		
        $this->data['view']   	= 'productos/productos';
		//$this->data['view']   	= 'productos/productosLista';
        $this->data['footer'] 	= 'home/footer';  			
        $this->load->view('layout/layout',  $this->data);	
		
    }




    public function add_user(){
    	// create the data object
		$this->data = new stdClass();
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
			//$this->data->error = 'There was a problem creating your new account. Please try again.';				
			//$this->load->view('header-home');
			//$this->load->view('user/register', $this->data);
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
				//$this->load->view('user/register/register_success', $this->data);
				//$this->load->view('footer-home');	

				echo'<div class="alert alert-success">Successfully</div>';

				//redirect(base_url('index.php/user/get_users'), 'refresh');


			} else {				
				//$this->data->error = 'There was a problem creating your new account. Please try again.';				
			// user creation failed, this should never happen
					// send error to the view
				//$this->load->view('header-home');
				//$this->load->view('user/register', $this->data);
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
		$this->data = new stdClass();
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
			$this->load->view('user/register', $this->data);
			$this->load->view('footer-home');			
		} else {			
			// set variables from the form
			$username   = $this->input->post('username');
			$email      = $this->input->post('email');
			$password    = $this->input->post('password');	
	
			if ($this->user_model->create_user($username, $email, $password)) {				
				// user creation ok
				$this->load->view('header');
				$this->load->view('user/register/register_success', $this->data);
				$this->load->view('footer');				
			} else {				
				// user creation failed, this should never happen
				$this->data->error = 'There was a problem creating your new account. Please try again.';				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/register/register', $this->data);
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
    	$this->data['id']        = (int)$user->id;
		$this->data['username']  = (string)$user->login;
		$this->data['nombre']    = (string)$user->nombre;
		$this->data['apellidos'] = (string)$user->apellidos;
		$this->data['email']     = (string)$user->email;
       //$id =  $this->uri->segment(3);
       // $this->db->where('id',$id);
        //$this->data['query'] = $this->db->get('curd');
       // $this->data['id'] = $id;
        $this->load->view('user/edit', $this->data);
    }

    public function user_edit(){
		//$id   = $this->input->post('id');
		$id =  $this->uri->segment(3);
    	$user = $this->user_model->get_user($id);
    	
    	$this->data['id']        = (int)$user->id;
		$this->data['username']  = (string)$user->login;
		$this->data['nombre']    = (string)$user->nombre;
		$this->data['apellidos'] = (string)$user->apellidos;
		$this->data['email']     = (string)$user->email;
		$this->data['idgrupo']      = (string)$user->idgrupo;
		$this->data['grupo']      = (string)$user->grupo;

		$this->data['tipos']     = $this->user_model->get_users_tipos();
       //$id =  $this->uri->segment(3);
       // $this->db->where('id',$id);
        //$this->data['query'] = $this->db->get('curd');
       // $this->data['id'] = $id;
		

		$this->load->view('header-home');
        $this->load->view('user/edit-user', $this->data);
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
                $this->data = array('name'=>  $this->input->post('name'),
                'email'=>$this->input->post('email'),
                'contact'=>$this->input->post('contact'),
                'facebook_link'=>$this->input->post('facebook'));
                $this->db->where('id', $this->input->post('hidden'));
                $this->db->update('curd', $this->data);
                $this->data['success'] = '<div class="alert alert-success">One record inserted Successfully</div>';
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
