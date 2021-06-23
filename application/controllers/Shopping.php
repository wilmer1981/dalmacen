<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Shopping extends CI_Controller {

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
		$this->load->model('productos_model');
		$this->load->model('shopping_model');	
		$this->load->model('categorias_model');
		$this->load->library('funciones');
	    $this->load->library('mathcaptcha');
	    $this->load->library('mercadopago');	
        $this->load->model('contenidos_model');
		$this->load->model('generales_model');		
		//creamos un random alfanumerico de longitud 6 
		//para nuestro captcha y sesión captcha
		$this->rand = random_string('alnum', 6);		
	}
	
	
	public function index() {	

		$this->shopping_view();
		//$this->carrito();
		
	}

	public function captcha()
	{
		//configuramos el captcha
		$conf_captcha = array(
			'word'   => $this->rand,
			'img_path' => './captcha/',
			'img_url' =>  base_url().'captcha/',
            //fuente utilizada por mi, poner la que tengáis
			//'font_path' => './fonts/AlfaSlabOne-Regular.ttf',
			'font_path' => './fonts/Molot.otf',
			'img_width' => '250',
			'img_height' => '60', 
			//decimos que pasados 10 minutos elimine todas las imágenes
			//que sobrepasen ese tiempo
			'expiration' => 600 
		);
 
		//guardamos la info del captcha en $cap
		$cap = create_captcha($conf_captcha);
 
		//pasamos la info del captcha al modelo para 
		//insertarlo en la base de datos
		$this->productos_model->insert_captcha($cap);
		
		//devolvemos el captcha para utilizarlo en la vista
		return $cap;
	}
	//comprobamos si la sessión que hemos creado es igual que el captcha introducido
	//con una función callback
	public function validate_captcha()
	{
 
	    if($this->input->post('captcha') != $this->session->userdata('captcha'))
	    {
	        $this->form_validation->set_message('validate_captcha', 'Error');
	        return false;
	    }else{
	        return true;
	    }
 
	}
	
	function check_math_captcha($str)
	{
		$str=$this->input->post('math_captcha');
		//var_dump($str);
	    if ($this->mathcaptcha->check_answer($str)) {
	        return TRUE;
	    } else {
	        $this->form_validation->set_message('check_math_captcha', 'Enter a valid math captcha response.');
	        return FALSE;
	    }
	}
	


	///////// Agregar producto al carro /////////////////
   	public function add(){
   	//$producto  = $this->productos_model->sp_getProducto($idprod);

   		//$cantidad = 1;

   	    //$cantidad = 1;
   	    /*
   	    $opciones=array();
        if($this->input->post('opciones')){
        	$opciones= $this->input->post('opciones');
        }
        */
        //cogemos los productos en un array para insertarlos en el carrito
        $insert_data = array(
            'id' => $this->input->post('id'),
			'image' => $this->input->post('image'),
			'name' => $this->input->post('name'),	
			'price' => $this->input->post('price'),			
			'qty' => $this->input->post('quantity'),
			'message' => $this->input->post('message')
			//'options' => $opciones
        );
        // This function add items into cart.
		$this->cart->insert($insert_data);
	      
        // This will show insert data in cart.
		redirect('shopping');
		//redirect(base_url(), 'refresh');		
	}

	public function add_OK(){

   		//$url = $this->uri->current_url();
              // Set array for send data.
   		//$message="";
   		//var_dump($this->input->post('idprod'));
		$insert_data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'marca' => $this->input->post('marca'),
			'modelo' => $this->input->post('modelo'),			
			'price' => $this->input->post('price'),
			'message' => $this->input->post('message'),
			'qty' => 1
		);
		//var_dump($insert_data);	
		print_r($insert_data);	

        // This function add items into cart.
		$this->cart->insert($insert_data);
	      
        // This will show insert data in cart.
		//redirect('shopping');
		//redirect(base_url(), 'refresh');
	}
	
	/////////// Eliminar producto del carro //////////////////
	public function remove($rowid) {
                    // Check rowid value.
		if ($rowid==="all"){
                       // Destroy data which store in  session.
			$this->cart->destroy();
		}else{
                    // Destroy selected rowid in session.
			$this->data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
                     // Update cart data, after cancle.
			$this->cart->update($this->data);
		}
		
        // This will show cancle data in cart.
		redirect('shopping');
	}
	
	/////// Mostrar carro de compra ////////////////
	public function shopping_view(){	
		$url        =  $this->uri->segment(3);      
    	$array 		=  explode("-", $url);
    	$idprod     =  $array[0];  
		
		$this->data['titulo']= $url;
    	//var_dump($url);
    	//var_dump($idprod);
		
		$limit=2;

    	//$this->data['breadcrumb']     = $this->productos_model->sp_getBreadcrumbs($idprod,'producto');
		$this->data['site']       		= $this->contenidos_model->sp_getSiteOffline();
        //$this->data['breadcrumb']       = $this->productos_model->sp_getBreadcrumbs($idprod,'productos');

		//$this->data['estados']    	= $this->estados_model->get_estados();	
		$this->data['menus']		= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();
		
		
		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();	
		//$this->data['categoriaslimit'] = $this->productos_model->sp_getCategoriasLimit($limit);	
		
		$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
		//$this->data['features']    	 = $this->productos_model->sp_getProductsFeatures($limit);	
		//$this->data['promotions']    	 = $this->productos_model->sp_getProductsPromotions();	
	
	
    	$this->data['producto']   = $this->productos_model->sp_getProducto($idprod);	
    	$this->data['images']     = $this->productos_model->sp_getProductoImages($idprod);
        //$this->data['filesprod']   = $this->productos_model->sp_getProductosFile('producto',$idprod);	
				
       //var_dump($this->data['producto']);
	   
    	//var_dump($this->data['producto']);
		$this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();
        $this->data['latests']    	 = $this->productos_model->sp_getProductsLatest();		
			
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();
		

		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		
		$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
		//$this->data['catmenu']   	= 'home/menucat';	
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
		$this->data['catmenu']   	= 'home/menu-acordeon';
      	$this->data['view']   	= 'shopping/shopping_view';		
        $this->data['footer'] 	= 'home/footer'; 
		$this->data['featuresmod']= 'home/features';	
		$this->data['latestsmod']= 'home/latest';	
		
        $this->load->view('layout/layout',  $this->data);	
		
		
    }
	


    public function carrito(){
		//$id = $this->input->post('id');
    	//$this->data['tipos'] = $this->user_model->get_users_tipos();
		$this->data['site']    = $this->contenidos_model->sp_getSiteOffline();
		
    	$this->data['categorias']      = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']   = $this->productos_model->sp_getSubCategorias();
    	$this->data['menus']    	  = $this->menus_model->sp_getMenus();
    	$this->data['marcas']     	   = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
    	$this->data['menus']    	 	 = $this->menus_model->sp_getMenus();
		$this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();	
		
		/*
		$this->mathcaptcha->init(); 
        $this->data['math_captcha_question'] = $this->mathcaptcha->get_question();

    	//pasamos a la vista el título y el captcha que hemos creado
		//$this->data = array('titulo' => 'Titulo','captcha' => $this->captcha());
		
		$this->data['captcha'] = $this->captcha();
 		//creamos una sesión con el string del captcha que hemos creado
		//para utilizarlo en la función callback
		$this->session->set_userdata('captcha', $this->rand);
		*/
 	
      /*  $this->load->view('header',$this->data);
		//$this->load->view('user/register',$this->data);
		$this->load->view('shopping/shopping_view',$this->data);
		$this->load->view('footer');*/
		
		$this->data['header'] 	= 'home/header';	
		//$this->data['catmenu']   	= 'home/menucat';
        $this->data['catmenu']   	= 'home/menu-acordeon';		
		$this->data['slider'] 	= 'home/slider';
        $this->data['view']   	= 'shopping/shopping_view';
        $this->data['footer'] 	= 'home/footer';
       
        $this->load->view('layout/layout',  $this->data);	
    }

    public function removes() {

		$id   =$this->input->post('idprod');
		$rowid=$this->input->post('rowid');
		
                    // Check rowid value.
		if ($rowid==="all"){
                       // Destroy data which store in  session.
			$this->cart->destroy();
		}else{
                    // Destroy selected rowid in session.
			$this->data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
                     // Update cart data, after cancle.
			$this->cart->update($this->data);
		}
		
          // This will show cancle data in cart.
		//redirect('shopping');
	}
	
	public function delete() {
		$message = 'El carrito se ha eliminado satisfactoriamente';
		$this ->cart->destroy();
		$this ->cart($message);
	}
    //manioperu
	public function update_cart_OK(){      
		$jsondata = array();          
         // Recieve post values,calcute them and update
        $cart_info =  $_POST['cart'] ;
 		foreach( $cart_info as $id => $cart)
		{	
                $rowid = $cart['rowid'];
                $price = $cart['price'];
                $messa = $cart['message'];
                $amount = $price * $cart['qty'];
                $qty = $cart['qty'];
                    
                $this->data = array(
						'rowid'   => $rowid,
                		'price'   => $price,
                		'message' => $messa,
                		'amount'  =>  $amount,
						'qty'     => $qty
				);
             
			$this->cart->update($this->data);
		}
		//redirect('shopping'); 

		/*
		$jsondata['success']=true; 
		header('Content-type: application/json; charset=utf-8');
  		echo json_encode($jsondata, JSON_FORCE_OBJECT);
  		*/
	}

	///// Actualizar carro de compras //////////////////////////
	public function update_cart(){                
			// Recieve post values,calcute them and update
			$cart_info =  $_POST['cart'] ;
			foreach( $cart_info as $id => $cart){	
													
				$rowid  = $cart['rowid'];
				$image  = $cart['image'];
				$name   = $cart['name'];
				$price  = $cart['price'];						
				$amount = $price * $cart['qty'];
				$qty    = $cart['qty'];
						
				$this->data = array(
					'rowid'   => $rowid,
					'image'   => $image,
					'name'   => $name,
					'price'   => $price,				
				    'amount' =>  $amount,
					'qty'     => $qty
				);
				 
				$this->cart->update($this->data);
			}
			redirect('shopping');        
	}

	//actualizar todo el carrito
	public function update_cart_ok_ok(){                
			// Recieve post values,calcute them and update
			$data   =$this->input->post('idprod');				 
			$this->cart->update($data);	

			redirect('shopping');        
	}
		
	public function update_cart_txt(){                
                // Recieve post values,calcute them and update
                $rowid  =  $_POST['pk'] ;
                $messa  = $_POST['message']; // $_POST['name'] catches the data-name value
                $value  = $_POST['value']; // the new value after you use the inline edit
 	                    
                $this->data = array(
						'rowid'   => $rowid,     
                		'message' => $value
				);             
			$this->cart->update($this->data);
		//}
		redirect('shopping');        
	}	



	public function billing_view_ok(){
		$this->data['categorias']      = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']   = $this->productos_model->sp_getSubCategorias();
    	$this->data['menus']    	 	 = $this->menus_model->sp_getMenus();
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
    	$this->data['menus']    	 	 = $this->menus_model->sp_getMenus();	
        $this->load->view('header',$this->data);  
		$this->load->view('shopping/billing_view');
		$this->load->view('footer');
    }
	
	
	////////////// Mostrar  proceso de pago //////////////////////
	public function checkout(){
		$iduser = $this->session->userdata('id');
		
		if(!$this->session->userdata('logado')){
			//redirect('cuenta');  
			redirect('cuenta/login');  			
        }else{
			
			//$id = $this->input->post('id');
			//$this->data['tipos'] = $this->user_model->get_users_tipos();
			$this->data['site']          = $this->contenidos_model->sp_getSiteOffline();
			
			$this->data['menus']	     = $this->menus_model->sp_getMenus();
			$this->data['submenus']		 = $this->menus_model->sp_getSubMenus();
		
				
			$this->data['categorias']    = $this->productos_model->sp_getCategorias();
			$this->data['subcategorias'] = $this->productos_model->sp_getSubCategorias();
		
			$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
			$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
		
			$this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
			$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();


			$this->data['menusup']   	= 'home/menu-superior';		
		    $this->data['menucat']   	= 'home/menu-categorias';

			
			$this->data['departamentos'] = $this->generales_model->getUbigeo('wsoft_ubigeos','','CodProv="0" and CodDist="0"','','');
      		//$this->data['provincias']  	 = $this->generales_model->getUbigeo('wsoft_ubigeos','','CodDpto="'.$pacientes->CodDpto.'" and CodProv!="0" and CodDist="0"','','');  
			//$this->data['distritos']   	 = $this->generales_model->getUbigeo('wsoft_ubigeos','','CodDpto="'.$pacientes->CodDpto.'" and CodProv="'.$pacientes->CodProv.'" and CodDist!="0"','','');
       
			//$this->data['cliente']   	 = $this->users_model->getCustomers('c.id="'.$iduser.'" AND d.predeterminado="1" ','','');
			$this->data['cliente']   	 = $this->users_model->getCustomers('c.id="'.$iduser.'" ','','');
			$cliente = $this->data['cliente'];
			
			$this->data['provincia']  	 = $this->generales_model->getUbigeo('wsoft_ubigeos','','CodDpto="'.$cliente[0]->CodDpto.'" and CodProv="'.$cliente[0]->CodProv.'" and CodDist="0"','','');  
			$this->data['departamento']  = $this->generales_model->getUbigeo('wsoft_ubigeos','','CodDpto="'.$cliente[0]->CodDpto.'" and CodProv="0" and CodDist="0"','','');
		
			$this->data['direcciones']   = $this->generales_model->get('wsoft_clientes_direcciones','','id_cliente="'.$iduser.'"','','');
				
			/*
			$this->mathcaptcha->init(); 
			$this->data['math_captcha_question'] = $this->mathcaptcha->get_question();
			//pasamos a la vista el título y el captcha que hemos creado
			//$this->data = array('titulo' => 'Titulo','captcha' => $this->captcha());		
			$this->data['captcha'] = $this->captcha();
			//creamos una sesión con el string del captcha que hemos creado
			//para utilizarlo en la función callback
			$this->session->set_userdata('captcha', $this->rand);		
			*/
		
			/*  
			$this->load->view('header',$this->data);
			//$this->load->view('user/register',$this->data);
			$this->load->view('shopping/shopping_view',$this->data);
			$this->load->view('footer');
			*/

						
			
			$this->data['breadcrumbs']  = 'home/breadcrumbs';		
			$this->data['header'] 		= 'home/header';	
		
			$this->data['slider'] 		= 'home/slider';
			$this->data['view']   		= 'shopping/checkout';
			$this->data['footer'] 		= 'home/footer';       
			$this->load->view('layout/layout',  $this->data);	
		}
	}

	////////// Registrar Pedido   ///////////////////////////////
	public function registerShopping(){		
		$iduser = $this->session->userdata('id');		
		$this->data = array();			
		$tipopago	= $this->input->post('optPago');
		$iddirec	= $this->input->post('txtIdDireccion');		    		
		$order = array(					
			'id_cliente' 	=> $iduser,
			'id_direccion' 	=> $iddirec,
			'pago_codigo' 	=> $tipopago
		);	
				
		//insertamos el pedido a la base de datos
		$ord_id = $this->shopping_model->insert_order($order);		
		if ($cart = $this->cart->contents()){								
				$this->table->set_heading('Item', 'Producto', 'Cantidad', 'Observacion'); // la tabla que irá en el correo
				$items=0;			
				foreach ($cart as $item){
					/*
					if ($this->cart->has_options($item['rowid'])){
	                	foreach ($this->cart->product_options($item['rowid']) as $opcion => $value){
	                		$opcion  = $opcion;
	                		$valor   = $value;
	                		$opciones = $opcion."-".$value;	              
	                    }
	                }*/

					$order_detail = array(
						'id_pedido' 	=> $ord_id,
						'id_producto' 	=> $item['id'],
						//'opciones' 		=> $opciones,
						'cantidad' 		=> $item['qty'],
						'precio_unit' 	=> $item['price']					
					);					
					//insertamos detalle del pedido a la base de datos
					$cust_id = $this->shopping_model->insert_order_detail($order_detail);
					$items++;					
					$this->table->add_row($items, $item['name'], $item['qty'], $item['price']);			
				}				
			//$this->table->add_row('Total', '', '', '', $this->cart->format_number($this->cart->total()));
			$this->table->add_row('Total', '', $items);
		}	
		
				/*
				if ($this->email->send()){	
					$this->data['success'] = 1;
					$this->data['respuesta'] = "Pedido enviado con Exito.";			
				}else{		
					$this->data['success'] = 0;			
					$this->data['respuesta'] = $this->email->print_debugger(array('headers'));
				}
				*/
				
		$this->data['success'] = 1;
		$this->data['respuesta'] = "Pedido enviado con Exito.";	
		$this->data['paymentype'] = $tipopago;
					
		//$this->data['success'] = 1;
		//$this->data['respuesta'] = $cust_id;
		//$this->data['respuesta'] = "Solicitud enviada con Exito.";	
		echo json_encode($this->data);		
		//destruimos el carrito
		//$this->cart->destroy(); 
		if($tipopago != 'MP'){
			$this->cart->destroy(); 
		}
		    	
	}


    //PAGAR PEDIDO
    public function payment(){
  		$iduser = $this->session->userdata('id');	//id del cliente 
        $email  = $this->session->userdata('email');	//email del cliente 
        $name   = $this->session->userdata('nombres');	//email del cliente
        $surname= $this->session->userdata('apellidos');	//email del cliente 
  		try{ 			
  			//load order
  			//$this->load->library('Mercadopago');	 			
  			/// Aquí algunos datos ex: validación, agregar orden a la base de datos, enviar correo ...
  			$ultimoId = $this->generales_model->getByMaxId('wsoft_pedidos','id');

  			// canasta de artículos
  			$products_mp   = array();
  			$items_carrito = $this->cart->contents();  			
			foreach($items_carrito as $item){		
				$products_mp[] = array(
						"id" => $item['id'],	
						"title" =>'Productos',
						"quantity" => $item['qty'],
						"currency_id" => "PEN",
						"unit_price" => $item['price']
				);			
			}
			
			//options to SDK mercadopago....
			$external_reference = $ultimoId->id;

			$preference_data = array(
				"payer_email" => $email, //correo electronico del comprador
				"payer_name"  => $name, //nombre del comprador
				"payer_surname"  => $surname, //nombre del comprador
				"payer_datecreated"  => date("Y-m-d H:i:s"), //fecha compra
				"external_reference" => $external_reference,   // referencia externa
				"back_urls"=> array (
							"success"=> base_url('shopping/checkout_success'),
							"failure"=> base_url('shopping/checkout_failure'),
							"pending"=> base_url('shopping/checkout_pending')
						),						
				"items" => $products_mp,
				"auto_return"=>"approved",	//retornar automaticente a la pagina si el pago salio ok			
			);
							
			$preference = $this->mercadopago->create_preference($preference_data);	
			//var_dump($preference);
			//link pay gateway MP
			if(isset($preference->init_point)){				
				$this->data['MP_Checkout'] = $preference->init_point;
			}else{
				throw new Exception("Algunos errores en la pasarela de MercadoPago");	 	
			}	
			
			// una funcion que me crea un codigo de referencia que guardo en mi BD  
     		//$external_reference = $this->external_reference();
     		/*
			$ultimoId = $this->generales_model->getByMaxId('wsoft_pedidos','id');
     		$external_reference = $ultimoId->id;
     		*/
			// inicia la creación de la preferencia  
		    //$preference = new MercadoPago\Preference();  
		    // del artículo vendido 
		    /*
		    //$item = new MercadoPago\Item(); 
		    foreach($items_carrito as $car){		    	 
		    	$item->title       = 'Producto';  
		    	$item->quantity    = $car['qty'];  
		    	$item->currency_id = "PEN";
		   	 	$item->unit_price  = $car['price'];	
		   	 	$preference->items = array($item);  	
			}*/	
			/*	    
		    foreach($items_carrito as $cart){		
				$products_mp[] = array(
					"id" => $cart['id'],	
					"title" =>'Productos',
					"quantity" => $cart['qty'],
					"currency_id" => "PEN",
					"unit_price" => $cart['price']
				);			
			}

						
			$preference->items = $products_mp; 
		    //del comprador  
		    $payer = new MercadoPago\Payer();  
		    $payer->name = $name;  
		    $payer->email = $email;  
		    $preference->payer = $payer;  
		     // las url de retorno a donde mercadolibre nos redigirá despues de terminar el proceso de pago  
		     // IMPORTANTE: No utilizar IPs en las url como 127.0.0.1 o 10.1.1.10 porque el SDK marcará un error       
		    $preference->back_urls = array(  
		       "success"=> base_url('shopping/checkout_success'),
				"failure"=> base_url('shopping/checkout_failure'),
				"pending"=> base_url('shopping/checkout_pending')  
		    );
		    $preference->auto_return = "approved";

		    $preference->external_reference= $external_reference;  
		    $preference->save(); 
		    */

		    //var_dump($preference);

		    /*
		    // se guarda el pago en la BD en espera de las notificaciones por IPN  
		     $payment = new Payment;  
		     $payment->external_reference = $external_reference;  
		     $payment->amount = $total;  
		     $payment->name = $name;  
		     $payment->email = $email;  
		     $payment->estatus = 0;  
		     $payment->save(); 
		     */ 
		     /*
		    $this->data['MP_Checkout'] = $preference->init_point;
		    $this->data['preference']  = $preference;
		    */

			$this->data['menus']			= $this->menus_model->sp_getMenus();
			$this->data['submenus']			= $this->menus_model->sp_getSubMenus();		
			
			$this->data['categorias']       = $this->productos_model->sp_getCategorias();
			$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();

			$this->data['menusup']   	= 'home/menu-superior';		
			$this->data['menucat']   	= 'home/menu-categorias';			
			
			$this->data['breadcrumbs']  = 'home/breadcrumbs';		
			$this->data['header'] 		= 'home/header';	
		
			$this->data['slider'] 		= 'home/slider';
			$this->data['view']   		= 'shopping/checkout_payment';
			$this->data['footer'] 		= 'home/footer';       
			$this->load->view('layout/layout',  $this->data);	
		
		}catch (Exception $e) {
			//atendemos la excepcion....			
		}
   }

  
   public function paymentt(){	
	
		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();
		
		
		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();

		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		
		
		$this->data['breadcrumbs']  = 'home/breadcrumbs';		
		$this->data['header'] 		= 'home/header';	
	
		$this->data['slider'] 		= 'home/slider';
		$this->data['view']   		= 'shopping/checkout_success';
		$this->data['footer'] 		= 'home/footer';       
		$this->load->view('layout/layout',  $this->data);				
	
    }
	


	public function checkout_success(){	
	
		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();
		
		
		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();

		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		
		
		$this->data['breadcrumbs']  = 'home/breadcrumbs';		
		$this->data['header'] 		= 'home/header';	
	
		$this->data['slider'] 		= 'home/slider';
		$this->data['view']   		= 'shopping/checkout_success';
		$this->data['footer'] 		= 'home/footer';       
		$this->load->view('layout/layout',  $this->data);				
	
    }

	
    public function checkout_ok(){
	
	//$id = $this->input->post('id');
    	//$this->data['tipos'] = $this->user_model->get_users_tipos();
	$this->data['site']    = $this->contenidos_model->sp_getSiteOffline();
		
    $this->data['categorias']      = $this->productos_model->sp_getCategorias();
	$this->data['subcategorias']   = $this->productos_model->sp_getSubCategorias();
    $this->data['menus']    	 = $this->menus_model->sp_getMenus();
    $this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
	$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
    $this->data['menus']    	 = $this->menus_model->sp_getMenus();
	$this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
	$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();
       // $this->data['breadcrumb']      = $this->productos_model->sp_getBreadcrumbs($idprod,'productos');
		
		/*
		$this->mathcaptcha->init(); 
        $this->data['math_captcha_question'] = $this->mathcaptcha->get_question();

    	//pasamos a la vista el título y el captcha que hemos creado
		//$this->data = array('titulo' => 'Titulo','captcha' => $this->captcha());
		
		$this->data['captcha'] = $this->captcha();
 		//creamos una sesión con el string del captcha que hemos creado
		//para utilizarlo en la función callback
		$this->session->set_userdata('captcha', $this->rand);
		
		*/
 	
		/*  
	    $this->load->view('header',$this->data);
		//$this->load->view('user/register',$this->data);
		$this->load->view('shopping/shopping_view',$this->data);
		$this->load->view('footer');
		*/
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
		
		$this->data['header'] 	= 'home/header';	
		$this->data['catmenu']   	= 'home/menucat';	
		$this->data['slider'] 	= 'home/slider';
        $this->data['view']   	= 'shopping/checkout';
        $this->data['footer'] 	= 'home/footer';
       
        $this->load->view('layout/layout',  $this->data);	
	}

	public function save_order_OK(){
		
		$this->data = array();

    	$this->form_validation->set_rules('math_captcha', 'Captcha', 'callback_check_math_captcha');
    	if($this->form_validation->run() == false)
		{
 
			//$this->index();
			//echo 'Error de captcha';
			$this->data['success'] =2 ;
			$this->data['respuesta'] ="Error de Captcha" ;
			echo json_encode($this->data);
 
		}else{
				//echo 'Validación pasada correctamente';

				$customer = array(
					'nombre' 	=> $this->input->post('nombre'),
					'ruc' 		=> $this->input->post('ruc'),
					'email' 	=> $this->input->post('correo'),
					'telefono' 	=> $this->input->post('telefono')
				);		
				//guardamos al cliente a la base de datos
				$cust_id = $this->productos_model->insert_customer($customer);

				$order = array(
					'date' 			=> date('Y-m-d'),
					'customerid' 	=> $cust_id
				);		
				//insertamos el pedido a la base de datos
				$ord_id = $this->productos_model->insert_order($order);
		
				if ($cart = $this->cart->contents()){
					
					//var_dump($cart);
					
					$this->table->set_heading('Item', 'Producto','Observacion'); // la tabla que irá en el correo
						$items=0;
						foreach ($cart as $item){
							$order_detail = array(
								'orderid' 		=> $ord_id,
								'productid' 	=> $item['id'],
								'quantity' 		=> $item['qty'],
								//'price' 		=> $item['price']
								'observation' 	=> $item['message']
							);	

							//insertamos detalle del pedido a la base de datos
							$cust_id = $this->productos_model->insert_order_detail($order_detail);
							$items++;
							$this->table->add_row($items, $item['name'], $item['message']);
					
						}
					 //$this->table->add_row('Total', '', '', '', $this->cart->format_number($this->cart->total()));
					   $this->table->add_row('Total', '', $items);
				}
				//enviamos info del pedido al correo

				$nombre      = $this->input->post('nombre');
				$from_email  = $this->input->post('correo');
				$telefono    = $this->input->post('telefono');


				$message = 'Se&ntilde;or(a): '.$nombre.br(1).'Telefono: '.$telefono.br(1).'Email: '.$from_email.br(2).'Detalles del pedido'; 
				$this->table->function = 'htmlspecialchars';		
				$pedido = $message.$this->table->generate();  // concatenamos el mensaje con la tabla que contiene el pedido

				$subject    = "Requerimiento del Cliente";
			
	  
			 //set to_email id to which you want to receive mails
				$to_email = 'ventas@manioperu.com';  
				
				//configure email settings     
				//$config['protocol'] = 'smtp';
				$config['protocol'] = 'mail';
				//$config['smtp_host'] = 'ssl://smtp.gmail.com'; // change this to yours
				$config['smtp_host'] = 'gator4131.hostgator.com'; // change this to yours
				$config['smtp_port'] = '465';
				$config['smtp_user'] = 'ventas@maniobrasarequipa.com'; // change this to yours
				$config['smtp_pass'] = 'PERU2015'; // change this to yours
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['newline'] = "\r\n"; //use double quotes       
 
           
				$this->email->initialize($config);
				$this->email->from($from_email, $nombre);
				$this->email->to($to_email);
				$this->email->subject($subject);
				$this->email->message($pedido);
			
				if ($this->email->send()){	
					$this->data['success'] = 1;
					$this->data['respuesta'] = "Solicitud enviada con Exito.";			
				}else{
				
					$this->data['success'] = 0;
					//$this->data = array('success' => 0);
					$this->data['respuesta'] = $this->email->print_debugger(array('headers'));
				}
				echo json_encode($this->data);
			
				//echo "<pre>";
				//print_r($this->data);
				//echo "</pre>";	

				//destruimos el carrito
				$this->cart->destroy();  
		}	    	
	}
	
	
	//con el primer captcha
    public function save_order(){
		
		$this->data = array();
		
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
    	if($this->form_validation->run() == false)
		{ 
			//$this->index();
			//echo 'Error de captcha';
			$this->data['success'] =2 ;
			$this->data['respuesta'] ="Ingrese correo valido" ;
			echo json_encode($this->data);
 
		}else{ 		
				//echo 'Validación pasada correctamente';
				$customer = array(
					'nombre' 	=> $this->input->post('nombre'),
					'ruc' 		=> $this->input->post('ruc'),
					'email' 	=> $this->input->post('correo'),
					'telefono' 	=> $this->input->post('telefono')
				);	
				
				//guardamos al cliente a la base de datos
				$cust_id = $this->productos_model->insert_customer($customer);

				$order = array(
					'date' 			=> date('Y-m-d'),
					'customerid' 	=> $cust_id
				);		
				//insertamos el pedido a la base de datos
				$ord_id = $this->productos_model->insert_order($order);
		
				if ($cart = $this->cart->contents()){					
					//var_dump($cart);					
					$this->table->set_heading('Item', 'Producto','Observacion'); // la tabla que irá en el correo
						$items=0;
						foreach ($cart as $item){
							$order_detail = array(
								'orderid' 		=> $ord_id,
								'productid' 	=> $item['id'],
								'quantity' 		=> $item['qty'],
								//'price' 		=> $item['price']
								'observation' 	=> $item['message']
							);
							//insertamos detalle del pedido a la base de datos
							$cust_id = $this->productos_model->insert_order_detail($order_detail);
							$items++;
							$this->table->add_row($items, $item['name'], $item['message']);
					
						}
					 //$this->table->add_row('Total', '', '', '', $this->cart->format_number($this->cart->total()));
					   $this->table->add_row('Total', '', $items);
				}
				//enviamos info del pedido al correo

				$nombre      = $this->input->post('nombre');
				$from_email  = $this->input->post('correo');
				$telefono    = $this->input->post('telefono');

				$message = 'Se&ntilde;or(a): '.$nombre.br(1).'Telefono: '.$telefono.br(1).'Email: '.$from_email.br(2).'Detalles del pedido'; 
				$this->table->function = 'htmlspecialchars';		
				$pedido = $message.$this->table->generate();  // concatenamos el mensaje con la tabla que contiene el pedido

				$subject    = "Requerimiento del Cliente";			
	  
			 //set to_email id to which you want to receive mails
				$to_email = 'ventas@manioperu.com';  
				
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
				$this->email->from($from_email, $nombre);
				$this->email->to($to_email);
				$this->email->subject($subject);
				$this->email->message($pedido);
			
				if ($this->email->send()){
	
					$this->data['success'] = 1;
					$this->data['respuesta'] = "Solicitud enviada con Exito.";			
				}else{
		
					$this->data['success'] = 0;
					//$this->data = array('success' => 0);
					$this->data['respuesta'] = $this->email->print_debugger(array('headers'));
				}
				echo json_encode($this->data);			
			

				//destruimos el carrito
				$this->cart->destroy(); 
	 
		}	    	
	}
	
	
    public function save_pedido(){
		
		$this->data = array();
		
		$this->form_validation->set_rules('txtEmail', 'Correo', 'trim|required|valid_email');
    	if($this->form_validation->run() == false)
		{ 
			//$this->index();
			//echo 'Error de captcha';
			$this->data['success'] =2 ;
			$this->data['respuesta'] ="Ingrese correo valido" ;
			echo json_encode($this->data);
 
		}else{ 		
			$ruc       = $this->input->post('txtRuc');
		    $datos['resultado'] = $this->productos_model->getExistCustomer($ruc);
			//var_dump($this->data['resultado']);
			$resultado = $datos['resultado'];
		    if($resultado==NULL){
				//echo 'Validación pasada correctamente';
				$customer = array(
					'nombre' 	=> $this->input->post('txtNombres'),
					'ruc' 		=> $this->input->post('txtRuc'),
					'direccion' 	=> $this->input->post('txtDireccion'),					
					'email' 	=> $this->input->post('txtEmail'),
					'telefono' 	=> $this->input->post('txtTelefono')
				);	
				
				//guardamos al cliente a la base de datos
				$cust_id = $this->productos_model->insert_customer($customer);
		    }else{
				$id = $resultado->id;
				$cust_id =$id;
				//echo $id;
			}

			
				$order = array(
					'date' 			=> date('Y-m-d'),
					'id_customer' 	=> $cust_id
				);	
				
				//insertamos el pedido a la base de datos
				$ord_id = $this->productos_model->insert_order($order);
		
				if ($cart = $this->cart->contents()){								
					$this->table->set_heading('Item', 'Producto', 'Cantidad', 'Observacion'); // la tabla que irá en el correo
						$items=0;
						foreach ($cart as $item){
							$order_detail = array(
								'id_order' 		=> $ord_id,
								'id_product' 	=> $item['id'],
								'quantity' 		=> $item['qty'],
								//'price' 		=> $item['price']
								'observation' 	=> $item['message']
							);
							//insertamos detalle del pedido a la base de datos
							$cust_id = $this->productos_model->insert_order_detail($order_detail);
							$items++;
							
							$this->table->add_row($items, $item['name'], $item['qty'], $item['message']);
					
						}
					 //$this->table->add_row('Total', '', '', '', $this->cart->format_number($this->cart->total()));
					   $this->table->add_row('Total', '', $items);
				}
				
			
				
				
				//enviamos info del pedido al correo
		
				$nombre      = $this->input->post('txtNombres');
				$ruc         = $this->input->post('txtRuc');
				$from_email  = $this->input->post('txtEmail');
				$telefono    = $this->input->post('txtTelefono');

				$message = 'Se&ntilde;or(a): '.$nombre.br(1).'Telefono: '.$telefono.br(1).'RUC: '.$ruc.br(1).'Email: '.$from_email.br(2).'Detalles del pedido'; 
				$this->table->function = 'htmlspecialchars';		
				$pedido = $message.$this->table->generate();  // concatenamos el mensaje con la tabla que contiene el pedido

				$subject    = "Requerimiento del Cliente";			
	  
			   //set to_email id to which you want to receive mails
				//$to_email = 'wilmer_1981@hotmail.com'; 
				$to_email = 'ventas@escalerasymaniobras.com'; 

				$cc_email = 'wilmer_1981@hotmail.com'; 				
				
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
				$this->email->from($from_email, $nombre);
				$this->email->to($to_email);
				$this->email->cc($cc_email);
				$this->email->subject($subject);
				$this->email->message($pedido);
			
				if ($this->email->send()){
	
					$this->data['success'] = 1;
					$this->data['respuesta'] = "Solicitud enviada con Exito.";			
				}else{
		
					$this->data['success'] = 0;
					//$this->data = array('success' => 0);
					$this->data['respuesta'] = $this->email->print_debugger(array('headers'));
				}
				

				//$this->data['success'] = 1;
				//$this->data['respuesta'] = $cust_id;
				//$this->data['respuesta'] = "Solicitud enviada con Exito.";	

				echo json_encode($this->data);			
			

				//destruimos el carrito
				$this->cart->destroy(); 
	 
		}	    	
	}
	


		//con el primer captcha
    public function save_order1_okok(){
		
		$this->data = array();

    	$this->form_validation->set_rules('captcha', 'Captcha', 'callback_validate_captcha');
    	if($this->form_validation->run() == false)
		{
 
			//$this->index();
			//echo 'Error de captcha';
			$this->data['success'] =2 ;
			$this->data['respuesta'] ="Error de Captcha" ;
			echo json_encode($this->data);
 
		}else{
 
			$expiration = time()-600; // Límite de 10 minutos 
			$ip         = $this->input->ip_address();//ip del usuario
			$captcha    = $this->input->post('captcha');//captcha introducido por el usuario
 
			//eliminamos los captcha con más de 2 minutos de vida
			$this->productos_model->remove_old_captcha($expiration);
			
 
			//comprobamos si es correcta la imagen introducida
			$check = $this->productos_model->check($ip,$expiration,$captcha);
 
			/*
			|si el número de filas devuelto por la consulta es igual a 1
			|es decir, si el captcha ingresado en el campo de texto es igual
			|al que hay en la base de datos, junto con la ip del usuario 
			|entonces dejamos continuar porque todo es correcto
			*/
			if($check == 1)
			{
				//echo 'Validación pasada correctamente';

				$customer = array(
					'nombre' 	=> $this->input->post('nombre'),
					'ruc' 		=> $this->input->post('ruc'),
					'email' 	=> $this->input->post('correo'),
					'telefono' 	=> $this->input->post('telefono')
				);		
				//guardamos al cliente a la base de datos
				$cust_id = $this->productos_model->insert_customer($customer);

				$order = array(
					'date' 			=> date('Y-m-d'),
					'customerid' 	=> $cust_id
				);		
				//insertamos el pedido a la base de datos
				$ord_id = $this->productos_model->insert_order($order);
		
				if ($cart = $this->cart->contents()){
					
					//var_dump($cart);
					
					$this->table->set_heading('Item', 'Producto','Observacion'); // la tabla que irá en el correo
						$items=0;
						foreach ($cart as $item){
							$order_detail = array(
								'orderid' 		=> $ord_id,
								'productid' 	=> $item['id'],
								'quantity' 		=> $item['qty'],
								//'price' 		=> $item['price']
								'observation' 	=> $item['message']
							);	

							//insertamos detalle del pedido a la base de datos
							$cust_id = $this->productos_model->insert_order_detail($order_detail);
							$items++;
							$this->table->add_row($items, $item['name'], $item['message']);
					
						}
					 //$this->table->add_row('Total', '', '', '', $this->cart->format_number($this->cart->total()));
					   $this->table->add_row('Total', '', $items);
				}
				//enviamos info del pedido al correo

				$nombre      = $this->input->post('nombre');
				$from_email  = $this->input->post('correo');
				$telefono    = $this->input->post('telefono');


				$message = 'Se&ntilde;or(a): '.$nombre.br(1).'Telefono: '.$telefono.br(1).'Email: '.$from_email.br(2).'Detalles del pedido'; 
				$this->table->function = 'htmlspecialchars';		
				$pedido = $message.$this->table->generate();  // concatenamos el mensaje con la tabla que contiene el pedido

				$subject    = "Requerimiento del Cliente";
			
	  
			   //set to_email id to which you want to receive mails
				$to_email = 'ventas@manioperu.com';  
				
				//configure email settings     
				$config['protocol'] = 'mail';
				//$config['smtp_host'] = 'ssl://smtp.gmail.com'; // change this to yours
				$config['smtp_host'] = 'gator4131.hostgator.com'; // change this to yours
				$config['smtp_port'] = '465';
				$config['smtp_user'] = 'ventas@maniobrasarequipa.com'; // change this to yours
				$config['smtp_pass'] = 'PERU2015'; // change this to yours
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['newline'] = "\r\n"; //use double quotes

                      
				$this->email->initialize($config);
				$this->email->from($from_email, $nombre);
				$this->email->to($to_email);
				$this->email->subject($subject);
				$this->email->message($pedido);
			
				if ($this->email->send()){
					// mail sent			
					$this->data['success'] = 1;
					$this->data['respuesta'] = "Solicitud enviada con Exito.";
					//echo $this->email->print_debugger(array('headers'));
				}else{
					//error
					$this->data['success'] = 0;
					//$this->data = array('success' => 0);
					$this->data['respuesta'] = $this->email->print_debugger(array('headers'));
				}
				echo json_encode($this->data);
			
				//echo "<pre>";
				//print_r($this->data);
				//echo "</pre>";

				//destruimos el carrito
				$this->cart->destroy(); 
		      
				// After storing all imformation in database load "billing_success".
			}
 
		}	    	
	}

	public function send_email($ord_id){
    	
    	          
            //set to_email id to which you want to receive mails
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
            $this->email->initialize($config);
            
            //send mail
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);
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

    public function notificacionesMercadoPago() {	

		//MercadoPago\SDK::setAccessToken("ENV_ACCESS_TOKEN");

			$merchant_order = null;
			switch($_GET["topic"]) {
				case "payment":
					$payment = MercadoPago\Payment::find_by_id($_GET["id"]);
					// Get the payment and the corresponding merchant_order reported by the IPN.
					$merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
					break;
				case "merchant_order":
					$merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
					break;
			}

			$paid_amount = 0;
			foreach ($merchant_order->payments as $payment) {
				if ($payment['status'] == 'approved'){
					$paid_amount += $payment['transaction_amount'];
				}
			}

			// If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
			if($paid_amount >= $merchant_order->total_amount){
				if (count($merchant_order->shipments)>0) { // The merchant_order has shipments
					if($merchant_order->shipments[0]->status == "ready_to_ship") {
						print_r("Totally paid. Print the label and release your item.");
					}
				} else { // The merchant_order don't has any shipments
					print_r("Totally paid. Release your item.");
				}
			} else {
				print_r("Not paid yet. Do not release your item.");
			}

            //add the header here
		   // header('Content-Type: application/json');
		    //echo json_encode(['HTTP/1.1 200 OK'], 200);
		    
		    $response = array('status' => 'OKOK');
		    return $this->output
					    	->set_status_header(200)
					        ->set_content_type('application/json')
					        ->set_output(json_encode($response));
		    

		    /*
		    $response = array('status' => 'OK');
			$this->output
			        ->set_status_header(200)
			        ->set_content_type('application/json', 'utf-8')
			        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			        ->_display();
			exit;
			*/
	}




}
