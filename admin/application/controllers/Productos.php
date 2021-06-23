<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

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
	public function __construct(){
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
		$this->load->model('generales_model','',TRUE);	
        $this->load->model('productos_model','',TRUE);  
		$this->load->model('categorias_model','',TRUE);  		
		
        $this->data['menuProductos'] = 'Productos';        
    }

	public function index(){ 
		
		$this->data['productos'] = $this->productos_model->getProductos('');
		//var_dump($this->data['productos']);
		
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';   
        $this->data['breadcrumbs'] = 'home/breadcrumbs';   
        $this->data['menuGestorProductos'] = 'Mantenimiento';  
		
        //cargamos  la interfaz
        $this->data['view']   = 'almacen/productos/productos';  
        $this->load->view('layout/template',  $this->data);
    }


    public function adicionar(){
		
	    $this->load->library('form_validation');
        $this->data['custom_error'] = '';		
		$this->form_validation->set_rules('txtNombre', 'Nombre', 'required');

		if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{	
		
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$descripcion = strip_tags(stripslashes($this->input->post('txtDescripcion1')),$allowedTags);
            $url         = urls_amigables(normaliza($this->input->post('txtNombre')));
						
            $data = array(
			    'codigo'          => $this->input->post('txtCodigo'),
				'id_categoria'    => $this->input->post('cboCategorias'),
                'id_subcategoria' => $this->input->post('cboSubcategoria'),
                'nombre'          => $this->input->post('txtNombre'),
                'descripcion'     => $descripcion,    
                'url'             => $url,                 
                'stock'      => $this->input->post('txtStock'),               
                'stock_min'  => $this->input->post('txtStockMin'),
                'precio'     => $this->input->post('txtPrecio'), 
				'orden'      => $this->input->post('txtOrden'),
				'destacado'  => $this->input->post('rdoFeatured'), 				
				'url_imagen' => $this->input->post('txtImage'),
				'estado'     => $this->input->post('cboEstado'),
                'fech_act'   => date('Y-m-d H:i:s')       
            );
			
		    if($this->productos_model->add('wsoft_productos', $data) == TRUE){
				$prod   = $this->productos_model->getByMaxId('wsoft_productos','id');
				$idprod = $prod->id;				
				$array  = $this->input->post('product_image');
				if(is_array($array) || !empty($array) ) {
					foreach ($array as $k => $valor ) {
						$data = array(
							'url_imagen' => $array[$k]["image"],
							'id_producto' => $idprod,
							'sort_order' => $array[$k]["sort_order"]
						);
						$this->productos_model->add('wsoft_productos_images', $data);
				    }					
				}
                
                $array  = $this->input->post('product_discount');
                if(is_array($array) || !empty($array)){
                    foreach($array as $k => $valor ){
                        $data  = array(
                            'id_tipocliente' => $array[$k]["customer_group_id"],
                            'id_producto'    => $idprod,
                            'cantidad'       => $array[$k]["quantity"],
                            'prioridad'      => $array[$k]["priority"],
                            'precio'         => $array[$k]["price"],
                            'fech_ini'       => $array[$k]["date_start"],
                            'fech_fin'       => $array[$k]["date_end"]
                        );
                        $this->productos_model->add('wsoft_productos_descuentos', $data);
                    }                                       
                }
			    $this->session->set_flashdata('success','Producto editado con éxito!');
                redirect(base_url() . 'productos/adicionar');
            }else{
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
		
		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();
		$this->data['estados']	        = $this->productos_model->get('wsoft_estados','','','','');
		$this->data['unidades']	        = $this->productos_model->get('wsoft_unidadmedida','','','','');
        $this->data['marcas']           = $this->productos_model->get('wsoft_marcas','','','','');
        //var_dump($this->data['estados']);
    
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['breadcrumbs'] = 'home/breadcrumbs';		
		$this->data['menuGestorProductos'] = 'Mantenimiento';  
		
        $this->data['view']   = 'almacen/productos/productosAdicionar';
        $this->load->view('layout/template',  $this->data);

    }

    public function editar() {
        $idprod = $this->uri->segment(3);		
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';		
		$this->form_validation->set_rules('txtNombre', 'Nombre', 'required');
		if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{		
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$descripcion = strip_tags(stripslashes($this->input->post('txtDescripcion1')),$allowedTags);
            $url         = urls_amigables(normaliza($this->input->post('txtNombre')));

            $data = array(
			    'codigo'          => $this->input->post('txtCodigo'),
				'id_categoria'    => $this->input->post('cboCategoria'),
                'id_subcategoria' => $this->input->post('cboSubcategoria1'),
                'nombre'          => $this->input->post('txtNombre'),
                'descripcion'  => $descripcion, 
                'url'          => $url,               
                'stock'        => $this->input->post('txtStock'),               
                'stock_min'    => $this->input->post('txtStockMin'),
                'precio'       => $this->input->post('txtPrecio'), 
				'orden'        => $this->input->post('txtOrden'), 
				'destacado'    => $this->input->post('rdoFeatured'),
				'url_imagen'   => $this->input->post('txtImage'),
				'estado'       => $this->input->post('cboEstado'),
				'id_marca'     => $this->input->post('cboMarca'),
                'fech_act'     => date('Y-m-d H:i:s')       
            );
			
			//var_dump($data);
            if($this->productos_model->edit('wsoft_productos', $data,'id',$idprod) == TRUE){
				$array  = $this->input->post('product_image');
				if(is_array($array) || !empty($array)){
					foreach($array as $k => $valor ){
					//$existe = $this->generales_model->getValidationById('wsoft_productos_images','id_producto',$idimg);  
                        //consultamos si existe la variable
                        if(isset($array[$k]["id"])){
                            $idimg = $array[$k]["id"];                         
                            $data  = array(
                                'url_imagen' => $array[$k]["image"],
                                'sort_order' => $array[$k]["sort_order"]
                            );
                            $this->productos_model->edit('wsoft_productos_images',$data,'id',$idimg); 
                        }else{
                            $data = array(
                                'url_imagen' => $array[$k]["image"],
                                'id_producto'=> $idprod,
                                'sort_order' => $array[$k]["sort_order"]
                            );
                            $this->productos_model->add('wsoft_productos_images', $data);
                        }						
				    }					
				}

                $arrays  = $this->input->post('product_discount');
                if(is_array($arrays) || !empty($arrays)){
                    foreach($arrays as $k => $valor ){
                        if(isset($arrays[$k]["id"])){
                            $iddis = $arrays[$k]["id"];                         
                            $data  = array(
                                'id_tipocliente' => $arrays[$k]["customer_group_id"],
                                'cantidad'       => $arrays[$k]["quantity"],
                                'prioridad'      => $arrays[$k]["priority"],
                                'precio'         => $arrays[$k]["price"],
                                'fech_ini'       => $arrays[$k]["date_start"],
                                'fech_fin'       => $arrays[$k]["date_end"]
                            );
                           $this->productos_model->edit('wsoft_productos_descuentos',$data,'id',$iddis);
                        }else{                            
                            $data  = array(
                                'id_tipocliente' => $arrays[$k]["customer_group_id"],
                                'id_producto'    => $idprod,
                                'cantidad'       => $arrays[$k]["quantity"],
                                'prioridad'      => $arrays[$k]["priority"],
                                'precio'         => $arrays[$k]["price"],
                                'fech_ini'       => $arrays[$k]["date_start"],
                                'fech_fin'       => $arrays[$k]["date_end"]
                            );
                            $this->productos_model->add('wsoft_productos_descuentos', $data);
                        }                       
                    }                   
                }
			    $this->session->set_flashdata('success','Producto editado con éxito!');
                //redirect(base_url() . 'productos/editar/'.$id);
            }else{
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
		
		$this->data['categorias']    = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias'] = $this->productos_model->sp_getSubCategorias();
		$this->data['estados']	     = $this->productos_model->get('wsoft_estados','','','','');
		$this->data['unidades']	     = $this->productos_model->get('wsoft_unidadmedida','','','','');
		$this->data['marcas']	     = $this->productos_model->get('wsoft_marcas','','','','');
        //var_dump($this->data['empleados']);		
        
        $this->data['result']     = $this->productos_model->getProductos('p.id="'.$idprod.'"');
		$this->data['imagenes']   = $this->productos_model->get('wsoft_productos_images','','id_producto="'.$idprod.'"','','');
        $this->data['descuentos'] = $this->productos_model->get('wsoft_productos_descuentos','','id_producto="'.$idprod.'"','','');
        //var_dump($this->data['result']);
   	   
		$this->data['menuGestorProductos'] = 'Mantenimiento'; 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['breadcrumbs'] = 'home/breadcrumbs';
		
        $this->data['view']  = 'almacen/productos/productosEditar';
        $this->load->view('layout/template',  $this->data);
    }
      
    public function delete(){
            /* 
			if(!$this->permission->checkPermission($this->session->userdata('permiso'),'dMarca')){
               $this->session->set_flashdata('error','No tiene permiso para eliminar Marcas.');
               redirect(base_url());
            }
			
			*/

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

    public function uploadImage(){             
              //si no se ha seleccionado imagen
            if($_FILES['image-input']['error'] == UPLOAD_ERR_NO_FILE){ 
                $url_imagen  = ''; 
                $result['valid'] = false;
                $result['message'] = 'Porfavor Carga un archivo..';// 
                $result['urlimage'] = '';                    
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/productos/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('image-input')) {
                    $result['message'] = $this->upload->display_errors();                   
                    $result['valid']   = false; 
                    $semaforo = 0;

                }else{                                  
                    $upload_data = $this->upload->data();
                    $url_imagen  = $upload_data['file_name'];
                    $tamanio     = $upload_data['file_size'];
                    $extension   = $upload_data['file_ext'];
                    $semaforo = 1;
                }           
            }   
          
          if($semaforo ==1){
            $result['valid']    = true;             
            $result['message']  = 'Archivo cargado correctamente.';
            $result['urlimage'] = 'uploads/productos/'.$url_imagen;
          }else{
            $result['valid']   = 'error';             
            $result['message'] = 'Archivo no se ha cargado.';  
            $result['urlimage'] = '';
          }

           $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));   
      

    }

     public function uploadImages(){
            //$imagen = $_POST["archivos"];
			//$id       = $_POST["id"];
			//$imagen   = $_POST["images-input"];
			//echo $id;
            //echo "<br>".$imagen;
            //si no se ha seleccionado imagen
            if($_FILES['images-input']['error'] == UPLOAD_ERR_NO_FILE){ 
			//if($_FILES[$imagen]['error'] == UPLOAD_ERR_NO_FILE){ 
                $url_imagen  = ''; 
                $result['valid'] = false;
                $result['message'] = 'Porfavor Carga un archivo..';// 
                $result['urlimage'] = '';                    
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/productos/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";                
                $this->load->library('upload', $config);
                
                //if(!$this->upload->do_upload($imagen)) {
				if(!$this->upload->do_upload('images-input')) {
                    $result['message'] = $this->upload->display_errors();                   
                    $result['valid']   = false; 
                    $semaforo = 0;

                }else{                                  
                    $upload_data = $this->upload->data();
                    $url_imagen  = $upload_data['file_name'];
                    $tamanio     = $upload_data['file_size'];
                    $extension   = $upload_data['file_ext'];
                    $semaforo = 1;
                }           
            }   
          
          if($semaforo ==1){
            $result['valid']    = true;             
            $result['message']  = 'Archivo cargado correctamente.';
            $result['urlimage'] = 'uploads/productos/'.$url_imagen;
          }else{
            $result['valid']   = 'error';             
            $result['message'] = 'Archivo no se ha cargado.';  
            $result['urlimage'] = '';
          }

           $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));   
      

    }
	
	//Listar Categorias
	public function categorias(){
		
		$idcat = $this->uri->segment(3);
		if(empty($idcat)){
			$this->data['categorias'] = $this->categorias_model->getCategorias('','','c.id_categoria=0','','');
		}else{
			$this->data['categorias'] = $this->categorias_model->getCategorias('','','c.id_categoria="'.$idcat.'"','','');	
		}
   
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
		
		$this->data['menuCategoriasProducto'] = 'Mantenimiento'; 
		
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'almacen/categorias/categorias';  
        $this->load->view('layout/template',  $this->data);    
    }
	
	public function addcategory() {		
	
		$idcat = $this->uri->segment(3);		
		if(empty($idcat)){
			$idcat=0;
		}
		
	
		//echo "Cat:".$idcat;
		 
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'required');

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {	
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$Content = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);		
			
			$url     = urls_amigables($this->input->post('txtTitulo'));
			
            $data = array(
                'titulo' => $this->input->post('txtTitulo'),
                'descripcion' => $Content,
				'id_categoria' => $idcat,
				'url' => $url,
                'orden' => $this->input->post('txtOrden')

            );

            if ($this->productos_model->add('wsoft_categorias', $data) == TRUE){				
                $this->session->set_flashdata('success','Categoria de productos agregado con éxito!');
             	
				if(empty($idcat)){
					redirect(base_url('productos/addcategory/'));	
				}else{
					redirect(base_url('productos/addcategory/'.$idcat));
				}				
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }		
	
		$this->data['menuCategoriasProducto'] = 'Roles'; 
        $this->data['header'] 		= 'home/header';
        $this->data['footer'] 		= 'home/footer';
        $this->data['menu']   		= 'home/menu';
		$this->data['breadcrumbs']  = 'home/breadcrumbs';   
		
		$this->data['view']   		= 'almacen/productos/productosCategoryAdd';       
        $this->load->view('layout/template',  $this->data);
    }
	
	
	public function updatecategory(){	
		$id = $this->uri->segment(3);	
        //echo $id;

        $categoria     = $this->productos_model->get('wsoft_categorias','','id="'.$id.'"','',''); 
        $idpad         = $categoria[0]->id_categoria; 

         //$subcategoria = getSubcategoria($idpad);
            //var_dump($subcategoria);
        $categoriapad  = $this->productos_model->get('wsoft_categorias','','id="'.$idpad.'"','',''); 
              
       //var_dump($categoriapad);

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'required');

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

			$allowedTags ='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$Content     = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);		
			$url         = urls_amigables($this->input->post('txtTitulo'));

            if($categoriapad){
                $urlpad        = $categoriapad[0]->url; 
                $urls =    $urlpad.'-'.$url;
            }else{
                $urls =    $url;
            }
		  
			$data = array(
                'titulo' => $this->input->post('txtTitulo'),
                'descripcion' => $Content,
				'estado' => $this->input->post('rdoStatus'),
				'url' => $urls,
                'orden' => $this->input->post('txtOrden'),
				'fech_act' => date('Y-m-d H:i:s')
            );

            if ($this->productos_model->edit('wsoft_categorias', $data,'id',$id) == TRUE){				
                $this->session->set_flashdata('success','Categoria de productos editado con éxito!');
                redirect(base_url('productos/updatecategory/'.$id));		   
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }	

			
	    $this->data['registro'] = $this->productos_model->get('wsoft_categorias','','id="'.$id.'"','',''); 
		//var_dump($this->data['registro']);
		
		$this->data['menuCategoriasProducto'] = 'Roles'; 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
        $this->data['view']   = 'almacen/productos/productosCategoryEdit';
        $this->load->view('layout/template',  $this->data);
    }


	public function subcategorias(){
		$idcat = $this->uri->segment(3);
        
        $this->data['categorias'] = $this->categorias_model->getCategorias('','','c.id_categoria="'.$idcat.'"','','');
        // $this->data['empleados'] = $this->categorias_model->get('categorias','','',$config['per_page'],$config['per_star']);
			
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
		
		$this->data['menuCategoriasProducto'] = 'Mantenimiento'; 
		
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'almacen/categorias/categorias';  
        $this->load->view('layout/template',  $this->data);    
    }
	
	
	
	//Listar Categorias
	public function marcas(){
		
		$this->data['registros'] = $this->generales_model->get('wsoft_marcas','','','','');
		
   
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
		
		$this->data['menuMarcasProducto'] = 'Mantenimiento'; 
		
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'almacen/marcas/marcas';  
        $this->load->view('layout/template',  $this->data);    
    }
	
	public function addmarca() {		
	
		$idcat = $this->uri->segment(3);		
		if(empty($idcat)){
			$idcat=0;
		}
		
	
		//echo "Cat:".$idcat;
		 
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'required');

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {	
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$Content = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);		
			
			$url     = urls_amigables($this->input->post('txtTitulo'));
			
            $data = array(
                'titulo' => $this->input->post('txtTitulo'),
                'descripcion' => $Content,
				'id_categoria' => $idcat,
				'url' => $url,
                'orden' => $this->input->post('txtOrden')
            );

            if ($this->usuarios_model->add('wsoft_marcas', $data) == TRUE){				
                $this->session->set_flashdata('success','Marca de productos agregado con éxito!');
             	
				if(empty($idcat)){
					redirect(base_url() . 'productos/addmarca/');	
				}else{
					redirect(base_url() . 'productos/addmarca/'.$icat);
				}				
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }

        $this->data['categorias']    = $this->productos_model->sp_getCategorias();		
	
		$this->data['menuMarcasProducto'] = 'Roles'; 
        $this->data['header'] 		= 'home/header';
        $this->data['footer'] 		= 'home/footer';
        $this->data['menu']   		= 'home/menu';
		$this->data['breadcrumbs']  = 'home/breadcrumbs';   
		
		$this->data['view']   		= 'almacen/marcas/marcasAdd';       
        $this->load->view('layout/template',  $this->data);
    }
	
	public function updatemarca() {	
		$id = $this->uri->segment(3);	
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'required');

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {	
			$allowedTags ='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$Content     = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);		
			$url         = urls_amigables($this->input->post('txtTitulo'));
		  
			$data = array(
                'titulo' => $this->input->post('txtTitulo'),
                'descripcion' => $Content,
				'url' => $url,
                'orden' => $this->input->post('txtOrden'),
				'fech_act' => date('Y-m-d H:i:s')
            );

            if ($this->usuarios_model->edit('wsoft_marcas', $data,'id',$id) == TRUE){				
                $this->session->set_flashdata('success','Marca de productos editado con éxito!');
                redirect(base_url('productos/updatemarca/'.$id));		   
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }	

		$this->data['registro'] = $this->generales_model->get('wsoft_marcas','','id="'.$id.'"','','');		
	
		//var_dump($this->data['registro']);
		
		$this->data['menuMarcasProducto'] = 'Roles'; 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
        $this->data['view']   = 'almacen/marcas/marcasEdit';
        $this->load->view('layout/template',  $this->data);
    }

	



}
