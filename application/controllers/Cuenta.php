<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Cuenta extends CI_Controller {

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
		$this->load->model('shopping_model');
		$this->load->model('productos_model','',TRUE);	
		$this->load->model('generales_model');
	}
	

	
		/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */	
	public function index(){
	
	     if(!$this->session->userdata('logado')){
          redirect('cuenta/login');      
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
	
		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();

		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();	
			
		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		$this->data['breadcrumbs']  = 'home/breadcrumbs';

		$this->data['header']		= 'home/header';        	
		$this->data['slider']		= 'home/slider';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';	
        $this->data['view']   		= 'cuenta/login';
        $this->data['footer'] 		= 'home/footer';		
			
		$this->load->view('layout/layout',  $this->data);		
	}
	
	public function forgot(){	

		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();

		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();	
			
		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		$this->data['breadcrumbs']  = 'home/breadcrumbs';

		$this->data['header']		= 'home/header';        	
		$this->data['slider']		= 'home/slider';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';	
        $this->data['view']   		= 'cuenta/forgot-password';
        $this->data['footer'] 		= 'home/footer';	
			
			
		$this->load->view('layout/layout',  $this->data);		
	}
	
	public function mi_cuenta(){		
		
		$iduser = $this->session->userdata('id');
		
			
		$this->data['registro']    = $this->users_model->getCustomers('c.id="'.$iduser.'"','','');
        //var_dump($this->data['registro']);	

		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();

		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();

		
		$this->data['menuser']   	= 'home/menu-usuario';	
			
		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		$this->data['breadcrumbs']  = 'home/breadcrumbs';

		$this->data['header']		= 'home/header';        	
		$this->data['slider']		= 'home/slider';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';	
        $this->data['view']   		= 'cuenta/mi-cuenta';
        $this->data['footer'] 		= 'home/footer';		
			
		$this->load->view('layout/layout',  $this->data);	

	
	}

	public function mis_direcciones(){			
		   $iduser = $this->session->userdata('id');	

		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();

		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();
			
			$this->data['cliente']    	= $this->users_model->getCustomers('c.id="'.$iduser.'"','','');	
			$this->data['direcciones']  = $this->users_model->getCustomerAddress('c.id="'.$iduser.'"','','');
			
			
			$this->data['departamentos'] = $this->generales_model->getUbigeo('wsoft_ubigeos','','CodProv="0" and CodDist="0"','','');
      		
				//var_dump();
			//$this->data['direcciones']  = $this->generales_model->get('wsoft_clientes_direcciones','','id_cliente="'.$iduser.'"','','');
			
			
		
			$this->data['menuser']   	= 'home/menu-usuario';				
			$this->data['menusup']   	= 'home/menu-superior';		
			$this->data['menucat']   	= 'home/menu-categorias';
			$this->data['breadcrumbs']  = 'home/breadcrumbs'; 	
	
        	
        	$this->data['header']		= 'home/header';        	
			$this->data['slider']		= 'home/slider';
	        $this->data['footer']		= 'home/footer';
			$this->data['featuresmod']	= 'home/features';	
			$this->data['latestsmod']	= 'home/latest';	
	        $this->data['view']   		= 'cuenta/mis-direcciones';
	        $this->data['footer'] 		= 'home/footer';			
			
			$this->load->view('layout/layout',  $this->data);		
	
	}
	
	public function mis_pedidos(){
		$iduser = $this->session->userdata('id');
		$idped  =  $this->uri->segment(3);		
		
		//echo $idped;	

		if(!empty($idped)){			
			$where2	=	'p.id = "'.$idped.'"';
			$this->data['detalle']      = $this->shopping_model->getOrderDetail($where2,'','');
			$this->data['view']   		= 'cuenta/mis-pedidos-detalle';
		}else{
			$this->data['view']   		= 'cuenta/mis-pedidos';
		}
		
		$where	=	'p.id_cliente = "'.$iduser.'"';
		$this->data['pedido']	= $this->shopping_model->getOrder($where,'','');
		
			
		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();

		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();		
				
		$this->data['menuser']   	= 'home/menu-usuario';				
		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		$this->data['breadcrumbs']  = 'home/breadcrumbs'; 	

    	
    	$this->data['header']		= 'home/header';        	
		$this->data['slider']		= 'home/slider';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';	
        $this->data['footer'] 		= 'home/footer';			
		
		$this->load->view('layout/layout',  $this->data);			
	
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
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register(){                                                                                                                                        
		$nom = $this->input->post('txtNombres');  	
		$ape = $this->input->post('txtApellidos');  	
        $ema = $this->input->post('txtEmail');  
        $pas = $this->input->post('txtPassword');  
      	$pas = sha1($pas);
      	$ter = $this->input->post('chk-terminos'); 
      	$pro = $this->input->post('chk-promocion'); 
		
        $res = $this->users_model->getVerificarEmail($ema);
		
        if($this->cart->total_items()>0){
        	$cart = $this->cart->total_items();
        }else{
        	$cart = 0;
        }

        if($rest == true){
        	$register = 0;
        	$result['cart']    = $cart;
            $result['valid']   = false;                 
            $result['message'] = 'Ya existe este correo.';//$rest->message;
        }else{		   
		    $datos = array('nombres'	=>  $this->input->post('txtNombres'),
		    			   'apellidos'	=>  $this->input->post('txtApellidos'),
						   'email'		=>	$this->input->post('txtEmail'),
						   'password'	=>	$password
					);
			
			if ($this->users_model->add('wsoft_clientes', $datos) == TRUE){
				$register = 1;
				$result['cart']      = $cart;
				$result['valid']     = true;				
				$result['message']   = "Se registró correctamente.";				
			}else{
				$register=0;
				$result['cart']      = $cart;
				$result['valid']     = false;				
				$result['message']   = "No se puede registrar.";
			}
		}
		
		//iniciamos session
		if($register==1){
			$this->iniciarSesion();
		}
	    $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
    }
	
	public function update(){  
		
		$iduser  = $this->session->userdata('id');
	
        $password = $this->input->post('txtPassword');  
      	$password = sha1($password);
		
			$data['message']   = 0;
			$data['resultado'] = '';	
		  
            $datos = array(
                'nombres' => $this->input->post('txtNombres'),
                'apellidos' => $this->input->post('txtApellidos'),
				'genero' => $this->input->post('rdoGenero'),
				'email' => $this->input->post('txtEmail'),
                'telefono' => $this->input->post('txtTelefono'), 
			  	//'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac'),'-'),
				'fech_act' => date('Y-m-d H:i:s')                
            );

            if($this->users_model->edit('wsoft_clientes', $datos,'id',$iduser) == TRUE){				
				$data['message']   = "Datos actualizados correctamente.";
				$data['resultado'] = 'ok';
            }else{
  				$data['message']   = "No se puede registrar.";
				$data['resultado'] = 'error';
            }
	
	    echo json_encode($data);
    }
	
	
	
	/**
	 * verificarLogin function.
	 * 
	 * @access public
	 * @return void
	 */
	public function verificarLogin(){      
        $email    = $this->input->post('txtEmail');  
        $password = $this->input->post('txtPassword');  
      	$password = sha1($password);
        $rest     = $this->users_model->login_user($email, $password);

        if($this->cart->total_items()>0){
        	$cart = $this->cart->total_items();
        }else{
        	$cart = 0;
        }

        if($rest == false){
        	  $result['cart']    = $cart;
              $result['valid']   = false;                 
              $result['message'] = 'Usuario o password incorrecto.';//$rest->message;
        }else{
            
            $datos = array();
            foreach($rest as $row){ 
                if($row->estado==0){
					$result['cart']    = $cart;
					$result['valid']   = false;                 
                    $result['message'] = 'Ud. no tiene permiso, comunicate con el Administrador.'; 				
                }else{  				       			
					$datos = array('id'           => $row->id,
									'nombres'	  => $row->nombres,
									'apellidos'	  => $row->apellidos,
									'email'	      => $row->email,
									'logado'      => TRUE);									
					$this->session->set_userdata($datos);					
					$result['cart']    = $cart;
					$result['valid']   = true;                 
                    $result['message'] = 'OK';
                }
            }
        }
	   	$this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
    }


	/**
	 * iniciarSesion function.
	 * 
	 * @access public
	 * @return void
	 */	
	public function iniciarSesion(){      
        $username = $this->input->post('txtEmail');  
        $password = $this->input->post('txtPassword');  
      	$password = sha1($password);
        $result   = $this->users_model->login_user($username, $password);
    		
        if($result){            
            $datos = array();
            foreach($result as $row){ 
                 				       			
				$datos = array('id'          => $row->id,
								'nombres'	  => $row->nombres,
								'apellidos'	  => $row->apellidos,
								'email'	      => $row->email,
								'logado'      => TRUE);
									
				$this->session->set_userdata($datos);	
            }
        }
    }
	
	//Registrar Direccion
	public function registerAddress(){
		
		$iduser= $this->session->userdata('id');		
		$direc = $this->input->post('txtDireccion');  	
        $refer = $this->input->post('txtReferencia');
		$ubige = $this->input->post('cboDistrito');
	
   
		$data['message']   = 0;
		$data['resultado'] = '';	
	  
		$datos = array(
			'id_cliente' => $iduser,
			'direccion'  => $this->input->post('txtDireccion'),
			'referencia' => $this->input->post('txtReferencia'),
			'cod_ubigeo' => $this->input->post('cboDistrito'),
			'predeterminado' => $this->input->post('cboDefault')			
		);

		if($this->users_model->add('wsoft_clientes_direcciones', $datos) == TRUE){				
			$data['message']   = "Direccion grabado correctamente.";
			$data['resultado'] = 'ok';
		}else{
			$data['message']   = "No se puede registrar.";
			$data['resultado'] = 'error';
		}
	
	    echo json_encode($data);
    }
	
	
	//Registrar Direccion
	public function registerAddressDefault(){
		
		$iduser   = $this->session->userdata('id');		
		//$opciones = $this->input->post('rdoOpcion'); 
		$id  = $this->input->post('id'); 
		$val = $this->input->post('val');

	    //echo "id:".$id."<br>";
		//echo "valor:".$val."<br>";
		$registro = $this->generales_model->get("wsoft_clientes_direcciones","","id_cliente='".$iduser."'","","");
		
		$bandera = 0;
		foreach($registro as $r){
			if($r->id==$id){
				if($val==0){
				  $valor=1;
			    }else{
					$valor=0;	
				}
			}else{
				$valor=0;
			}
			
			$data  = array(
				'predeterminado' => $valor
			);
			$this->users_model->edit('wsoft_clientes_direcciones', $data,'id',$r->id);
			$bandera = 1;	
		}
		
		if($bandera == 1){
			$data['message']   = "Grabado correctamente...";
			$data['resultado'] = 'ok';
		}else{
			$data['message']   = "No se puede grabar...";
			$data['resultado'] = 'error';
		}
		 
		
				 
	    echo json_encode($data);
    }
	
	//Registrar Direccion
	public function registerAddressDefaultjjjjj(){
		
		$iduser   = $this->session->userdata('id');		
		//$opciones = $this->input->post('rdoOpcion'); 
		//$id  = $this->input->post('id'); 
		//$val = $this->input->post('val');

	      //echo "id:".$id."<br>";
		  //echo "valor:".$val."<br>";
		  //$registro = $this->generales_model->get("wsoft_clientes_direcciones","","id_cliente='".$iduser."'","","");
		  
		 
				$array  = $this->input->post('rdoOpcion');
				////var_dump($array);
				
				if(is_array($array) || !empty($array)){
					foreach($array as $k => $valor ){
						$id    = $array[$k]["id"];
						
						//if(isset($array[$k]["val"])){
						if(!empty($array[$k]["val"])){
							$val = $array[$k]["val"];							
						}else{
							$val = "";
						}
						
						if($val==0){
							$valor=1;
						}else if($val==1){
							$valor=0;
						}else{
							$valor=0;
						}						
						echo "id: ".$id." -- valor:".$val."<br>";						
						$data  = array(
							'predeterminado' => $valor
						);
						//$this->users_model->edit('wsoft_clientes_direcciones', $data,'id',$id);
				    }
					$data['message']   = "Grabado correctamente...";
			        $data['resultado'] = 'ok';
				}else{
					$data['message']   = "No se puede grabar...";
					$data['resultado'] = 'error';
				}
 
	    echo json_encode($data);
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
        $this->session->unset_userdata('logado');
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
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
	
	
	public function forgotPassword(){ 
     // Cargar librería y archivo de config
      //$this->load->library('email');
      $this->config->load('email'); 
              
      if($this->input->post('txtEmail')){
          $email  = $this->input->post('txtEmail');  
          $rest   = $this->users_model->forgot_password($email);

          if($rest == false){
            $result['valid']   = false;                 
            $result['message'] = 'Este E-mail no está registrado.';//$rest->message;
          }else{
					$user_email    = $rest[0]->email;
					$user_passw    = $rest[0]->password;
					$user_name     = $rest[0]->nombres;
			        $user_id       = $rest[0]->id;			
			        $codigo        = generarCodigos(4);
			
      			    $data   = array(					
							'forgot_pass_identity' => $codigo												  
      					);			
			        $this->users_model->edit('wsoft_clientes', $data,'id',$user_id);
       
           // $user_email=$row->email;

              if((!strcmp($email, $user_email))){ 
				//$url = 'http://'.$_SERVER["SERVER_NAME"].'/login/cambia_pass.php?user_id='.$user_id.'&token='.$token;
						
                  /*Mail Code*/
					//$data = array();
					$this->data["nombre"] = $user_name;
					$this->data["codigo"] = $codigo;
					$contenido_HTML = reset_password_html($this->data);
				   
					$to_email   = $user_email;
					$from_email = "admin@aquisher.com";					
					$subject    = "Recuperación de contraseña";
					
					$this->email->from($from_email,'Aquisher');
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
                $result['valid']   = error;                 
                $result['message'] = 'E-mail inválido!';//$rest->message;
              }
        }
      }

      $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
    }


	public function resetPassword(){ 
     // Cargar librería y archivo de config
      //$this->load->library('email');
      $this->config->load('email'); 
              
      if($this->input->post('codigo')){
          $email   = $this->input->post('codigo');  
		  $passw1  = $this->input->post('password1');
		  $passw2  = $this->input->post('password2');  		  
          $rest   = $this->home_model->get_codigo($email);

          if($rest == false){
              $result['valid']   = false;                 
              $result['message'] = 'El código no es valido.';//$rest->message;
          }else{           
			$user_id       = $rest[0]->id;
			$password      = sha1($passw1);
			
			$data = array(					
							'password' => $password												  
					);
			
			if ($this->usuarios_model->edit('usuarios', $data,'id',$user_id) == TRUE){
			
				$result['valid']   = true;                 
				$result['message'] = "Se ha cambiado la contraseña satisfactoriamente.";
			}else{
				$result['valid']   = false;                        
                $result['message'] = "No se pudo cambiar la contraseña.";
			}
					  
       /*
              if((!strcmp($email, $user_email))){ 
				//$url = 'http://'.$_SERVER["SERVER_NAME"].'/login/cambia_pass.php?user_id='.$user_id.'&token='.$token;
				
				$url = 'http://cas.microcys.com';
			
			
                  $to_emial   = $user_email;

                  $from_email = "admin@sapimsa.pe";
                  //$message    = "Tienes justificaciones pendientes de aprobar, favor de ingresar al sistema CAS para su verificacion. ";
                  $message    = "Hola $user_name: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>
								Tu Codigo de Verificacion es : <b> $codigo</b>";
	
				  $subject    = "Recuperar Password - Sistema de Usuarios";
				//$subject    = $user_name.", tienes una nueva notificacio";
				 //$asunto = 'Recuperar Password - Sistema de Usuarios';
					

                  $this->email->from($from_email,'MICROCYS.COM');
                  $this->email->to($user_email);
                  $this->email->subject($subject);
                  $this->email->message($message);
                  //$this->email->message($output);
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
                $result['valid']   = error;                 
                $result['message'] = 'Invalid Email ID !';//$rest->message;
              }*/
        }
      }

      $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
    }

	
}
