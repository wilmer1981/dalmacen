<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Catalogo extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {		
		parent::__construct();
		$this->load->model('estados_model','',TRUE);
		$this->load->model('menus_model','',TRUE);
		$this->load->model('contenidos_model','',TRUE);
		$this->load->model('categorias_model','',TRUE);
		$this->load->model('maquinas_model','',TRUE);	
		$this->load->model('marcas_model','',TRUE);
		$this->load->model('modelos_model','',TRUE);
		$this->load->model('productos_model','',TRUE);
		$this->load->model('generales_model','',TRUE);
		$this->load->library('funciones');	
	}
	
	
	public function index() {	

		$this->categories();
		
	}

    public function preview(){
		//$id = $this->input->post('id');
    	//$this->data['tipos'] = $this->user_model->get_users_tipos();
    	$this->data['menus']	= $this->menus_model->sp_getMenus();	
        $this->load->view('header',$this->data);
		//$this->load->view('user/register',$this->data);
		$this->load->view('productos/preview');
		$this->load->view('footer');
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
		//$id = $this->input->post('id');
    	//$this->data['tipos'] = $this->user_model->get_users_tipos();		
		$this->data['features'] = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']  = $this->contenidos_model->sp_getBanners();		
    	$this->data['menus']    = $this->menus_model->sp_getMenus();	     
		
     	$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
        $this->data['catmenu']  = 'home/menu-acordeon';		
        $this->data['view']   	= 'productos/productos';
		//$this->data['view']   	= 'productos/productosLista';
        $this->data['footer'] 	= 'home/footer';  			
        $this->load->view('layout/layout',  $this->data);	
    }

    public function subcategories(){
		//$id = $this->input->post('id');
       	$this->data['menus']    	 = $this->menus_model->sp_getMenus();
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();		
        $this->load->view('header',$this->data);
		$this->load->view('productos/subcategories');
		$this->load->view('footer',$this->data);
    }

    public function productos(){	
    	$this->data['site']				= $this->contenidos_model->sp_getSiteOffline();
		$limit=8;
		$this->data['estados']			= $this->estados_model->get_estados();
		
		$this->data['menus']			= $this->menus_model->sp_getMenus();
		$this->data['submenus']			= $this->menus_model->sp_getSubMenus();
			
		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();	
		//var_dump($data['categorias']);
		//var_dump($this->data['subcategorias']);   

		$this->data['categoriaslimit'] = $this->productos_model->sp_getCategoriasLimit($limit);		
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
        $this->data['view']			= 'productos/productos';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';	
       
        $this->load->view('layout/layout',  $this->data);	
		
    }

    public function productoss(){	
    	$url       =  $this->uri->segment(3); 		
		$categoria = $this->generales_model->get('wsoft_categorias','','url="'.$url.'"','','');
		var_dump($categoria);
		if(!empty($categoria)){			
			$id        = $categoria[0]->id;
			$idsub     = $categoria[0]->id_categoria;
			$this->data['titulo']= $categoria[0]->titulo;
		}else{
			$id        = 0;
			$idsub     = 0;
			$this->data['titulo']=$url;
		}

		//echo "categoria:".$id;	
		//echo "\nsub_categoria:".$idsub;				
		
		if($idsub == 0){
			$opcion= "categoria";
		}else{
			$opcion= "subcategoria";
		}
		
		$config['base_url']   = base_url().'catalogo/productos/'.$url.'/';

		echo "<br>Opcon: ".$opcion;
		echo "<br>ID: ".$id;

		$total_records        = $this->generales_model->count_products($opcion,$id);

		echo "<br>Total: ".$total_records;
		$config['total_rows'] = $total_records;
        $config['per_page']   = 6;
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
		$this->data['site']          = $this->contenidos_model->sp_getSiteOffline();    	
    	$this->data['breadcrumb']    = $this->contenidos_model->sp_getBreadcrumbs($opcion,$url);
		
		$this->data['categorias']    = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias'] = $this->productos_model->sp_getSubCategorias();
    	$this->data['menus']    	 = $this->menus_model->sp_getMenus();
		$this->data['submenus']		 = $this->menus_model->sp_getSubMenus();	
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
			
		$this->data['productos']     = $this->productos_model->sp_getProductosLis($opcion,$id,$config['per_page'],$config['per_star']);
		//$this->data['productos']     = $this->productos_model->sp_getProductosLis($opcion,$id,'3','1');
		//$this->data['filesprod']       	= $this->productos_model->sp_getProductosFile($opcion,$id);	
		//var_dump($this->data['productos']);	
		//var_dump($this->data['filesprod']);	
        $this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();			
        
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
	
     	$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
	    $this->data['catmenu']   	= 'home/menu-acordeon';
        $this->data['menusup']   	= 'home/menu-superior';
		
			
        //$this->data['view']   	= 'productos/productos';
		$this->data['view']   	    = 'productos/catalogo_productos';
		//$this->data['view']   	= 'productos/productosLista';
        $this->data['footer'] 	= 'home/footer';  			
        $this->load->view('layout/layout',  $this->data);	
		
    }
	
	public function ofertas(){	
    	$url       =  $this->uri->segment(3); 		
		$categoria = $this->generales_model->get('wsoft_categorias','','url="'.$url.'"','','');
		if(!empty($categoria)){			
			$id        = $categoria[0]->id;
			$idsub     = $categoria[0]->id_categoria;
			$this->data['titulo']= $categoria[0]->titulo;
		}else{
			$id        = 0;
			$idsub     = 0;
			$this->data['titulo']=$url;
		}	
		
		if($idsub == 0){
			$opcion= "categoria";
		}else{
			$opcion= "subcategoria";
		}
		
			
		$config['base_url']   = base_url().'catalogo/ofertas/'.$url.'/';
		$total_records        = $this->generales_model->count_products($opcion,$id);
		$config['total_rows'] = $total_records;
        $config['per_page']   = 6;
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
		$this->data['site']          = $this->contenidos_model->sp_getSiteOffline();    	
    	$this->data['breadcrumb']    = $this->contenidos_model->sp_getBreadcrumbs($opcion,$url);
		
		$this->data['categorias']    = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias'] = $this->productos_model->sp_getSubCategorias();
    	$this->data['menus']    	 = $this->menus_model->sp_getMenus();
		$this->data['submenus']		 = $this->menus_model->sp_getSubMenus();	
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();

		//echo "opcion:".$opcion."\n ID:".$id;
			
		$this->data['productos']     = $this->productos_model->sp_getProductosLis($opcion,$id,$config['per_page'],$config['per_star']);
		//$this->data['filesprod']       	= $this->productos_model->sp_getProductosFile($opcion,$id);	
		//var_dump($this->data['productos']);	
		//var_dump($this->data['filesprod']);	
        $this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();			
        
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
	
     	$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
	    $this->data['catmenu']  = 'home/menu-acordeon';
        $this->data['menusup']  = 'home/menu-superior';
		
			
        //$this->data['view']   	= 'productos/productos';
		$this->data['view']   	    = 'productos/catalogo_productos';
		//$this->data['view']   	= 'productos/productosLista';
        $this->data['footer'] 	= 'home/footer';  			
        $this->load->view('layout/layout',  $this->data);	
		
    }
	
	public function novedades(){	
    	$url       =  $this->uri->segment(3); 		
		$categoria = $this->generales_model->get('wsoft_categorias','','url="'.$url.'"','','');
		if(!empty($categoria)){			
			$id        = $categoria[0]->id;
			$idsub     = $categoria[0]->id_categoria;
			$this->data['titulo']= $categoria[0]->titulo;
		}else{
			$id        = 0;
			$idsub     = 0;
			$this->data['titulo']=$url;
		}	
		
		if($idsub == 0){
			$opcion= "categoria";
		}else{
			$opcion= "subcategoria";
		}
		
		
		$config['base_url']   = base_url().'catalogo/novedades/'.$url.'/';
		$total_records        = $this->generales_model->count_products($opcion,$id);
		$config['total_rows'] = $total_records;
        $config['per_page']   = 6;
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
	
		$this->data['site']          = $this->contenidos_model->sp_getSiteOffline();    	
    	$this->data['breadcrumb']    = $this->contenidos_model->sp_getBreadcrumbs($opcion,$url);
		
		$this->data['categorias']    = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias'] = $this->productos_model->sp_getSubCategorias();
    	$this->data['menus']    	 = $this->menus_model->sp_getMenus();
		$this->data['submenus']		 = $this->menus_model->sp_getSubMenus();	
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
			
		$this->data['productos']     = $this->productos_model->sp_getProductosLis($opcion,$id,$config['per_page'],$config['per_star']);
		//$this->data['filesprod']       	= $this->productos_model->sp_getProductosFile($opcion,$id);	
		//var_dump($this->data['productos']);	
		//var_dump($this->data['filesprod']);	
        $this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();			
        
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
	
     	$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
	    $this->data['catmenu']   	= 'home/menu-acordeon';
        $this->data['menusup']   	= 'home/menu-superior';
		
			
        //$this->data['view']   	= 'productos/productos';
		$this->data['view']   	    = 'productos/catalogo_productos';
		//$this->data['view']   	= 'productos/productosLista';
        $this->data['footer'] 	= 'home/footer';  			
        $this->load->view('layout/layout',  $this->data);	
		
    }
	
	public function accesorios(){	
    	$url       =  $this->uri->segment(3); 		
		$categoria = $this->generales_model->get('wsoft_categorias','','url="'.$url.'"','','');
		if(!empty($categoria)){			
			$id        = $categoria[0]->id;
			$idsub     = $categoria[0]->id_categoria;
			$this->data['titulo']= $categoria[0]->titulo;
		}else{
			$id        = 0;
			$idsub     = 0;
			$this->data['titulo']=$url;
		}	
		
		if($idsub == 0){
			$opcion= "categoria";
		}else{
			$opcion= "subcategoria";
		}
    	
	   	/* Se obtienen los registros a mostrar*/
   		//$this->data['users'] = $this->user_model->get_usuarios($config['per_page'], $this->uri->segment(3)); 
		$this->data['site']          = $this->contenidos_model->sp_getSiteOffline();    	
    	$this->data['breadcrumb']    = $this->contenidos_model->sp_getBreadcrumbs($opcion,$url);
		
		$this->data['categorias']    = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias'] = $this->productos_model->sp_getSubCategorias();
    	$this->data['menus']    	 = $this->menus_model->sp_getMenus();
		$this->data['submenus']		 = $this->menus_model->sp_getSubMenus();	
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
			
		$this->data['productos']     = $this->productos_model->sp_getProductosLis($opcion,$id,'','');
		//$this->data['filesprod']       	= $this->productos_model->sp_getProductosFile($opcion,$id);	
		//var_dump($this->data['productos']);	
		//var_dump($this->data['filesprod']);	
        $this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();			
        
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
	
     	$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
	    $this->data['catmenu']   	= 'home/menu-acordeon';
        $this->data['menusup']   	= 'home/menu-superior';
		
			
        //$this->data['view']   	= 'productos/productos';
		$this->data['view']   	    = 'productos/catalogo_productos';
		//$this->data['view']   	= 'productos/productosLista';
        $this->data['footer'] 	= 'home/footer';  			
        $this->load->view('layout/layout',  $this->data);	
		
    }
	
		
	public function busqueda(){
		
		/*
		$config['base_url']   = base_url().'catalogo/novedades/'.$url.'/';
		$total_records        = $this->generales_model->count_products($opcion,$id);
		$config['total_rows'] = $total_records;
        $config['per_page']   = 6;
		if($this->uri->segment(4)){
			$config['per_star'] = $this->uri->segment(4);
		}else{
			$config['per_star'] = 0;
		}*/
		$this->data['titulo']= $this->input->post("product_name");
	
		//echo $this->uri->segment(3);
	    //get search string
        $search = ($this->input->post("product_name"))? $this->input->post("product_name") : "NIL";
        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
		
		//pagination settings
        //$config = array();
		
		
		/*
        $config['total_rows']  = $this->productos_model->get_products_count($search);
        $config['per_page']    = 6;
        $config["uri_segment"] = 4;
        $choice                = $config["total_rows"]/$config["per_page"];
        //$config["num_links"] = floor($choice);
        $config['num_links']   =5;
		*/
		
		
		
		$config['base_url']    = base_url('catalogo/busqueda/'.$search.'/');
		$config['total_rows']  = $this->productos_model->get_products_count($search);
        $config['per_page']    = 6;
		
		if($this->uri->segment(3)){
			$config['per_star'] = $this->uri->segment(4);
		}else{
			$config['per_star'] = 0;
		}
		
		
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
  
        $config['first_link'] = 'Primera';  
        $config['last_link'] = '&Uacute;ltima';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Anterior';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Siguiente';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        //$this->data['page']          = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //$this->data['pagination']    = $this->pagination->create_links();

		$this->data['site']          = $this->contenidos_model->sp_getSiteOffline();    	
    	//$this->data['breadcrumb']    = $this->contenidos_model->sp_getBreadcrumbs($opcion,$url);
		
		$this->data['categorias']    = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias'] = $this->productos_model->sp_getSubCategorias();
    	$this->data['menus']    	 = $this->menus_model->sp_getMenus();
		$this->data['submenus']		 = $this->menus_model->sp_getSubMenus();	
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();
		
		//$this->data['productos']    	 = $this->productos_model->sp_getProductosLis($idsub,$config['per_page'],$config['per_star']);
	    $this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();	
		
		
		
		//$this->data['productos']      = $this->productos_model->get_products($config['per_page'], $this->data['page'], $search);
		$this->data['productos']      = $this->productos_model->get_products($config['per_page'], $config['per_star'], $search);
		$this->data['linkurl']        =  $this->input->post("product_name");


		 $this->data['features']     = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();			
        
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
	
     	$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
	    $this->data['catmenu']  = 'home/menu-acordeon';
        $this->data['menusup']  = 'home/menu-superior';

		$this->data['view']   	    = 'productos/catalogo_productos';
	    $this->data['footer'] 	= 'home/footer';  			
        $this->load->view('layout/layout',  $this->data);	
		

    }
	
	public function busquedasss(){
		
		/*
		$config['base_url']   = base_url().'catalogo/novedades/'.$url.'/';
		$total_records        = $this->generales_model->count_products($opcion,$id);
		$config['total_rows'] = $total_records;
        $config['per_page']   = 6;
		if($this->uri->segment(4)){
			$config['per_star'] = $this->uri->segment(4);
		}else{
			$config['per_star'] = 0;
		}*/
		$this->data['titulo']= $this->input->post("product_name");
	
		echo $this->uri->segment(3);
	    //get search string
        $search = ($this->input->post("product_name"))? $this->input->post("product_name") : "NIL";
        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
		
		

        //pagination settings
        $config = array();
        $config['base_url']    = base_url("catalogos/busqueda/$search");
        $config['total_rows']  = $this->productos_model->get_products_count($search);
        $config['per_page']    = 6;
        $config["uri_segment"] = 4;
        $choice                = $config["total_rows"]/$config["per_page"];
        //$config["num_links"] = floor($choice);
        $config['num_links']   =5;

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        //$config['first_link'] = false;
        //$config['last_link'] = false;
        $config['first_link'] = 'Primera';  
        $config['last_link'] = '&Uacute;ltima';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Anterior';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Siguiente';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $this->data['page']          = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['pagination']    = $this->pagination->create_links();

		$this->data['site']          = $this->contenidos_model->sp_getSiteOffline();    	
    	//$this->data['breadcrumb']    = $this->contenidos_model->sp_getBreadcrumbs($opcion,$url);
		
		$this->data['categorias']    = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias'] = $this->productos_model->sp_getSubCategorias();
    	$this->data['menus']    	 = $this->menus_model->sp_getMenus();
		$this->data['submenus']		 = $this->menus_model->sp_getSubMenus();	
    	$this->data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();
		
		//$this->data['productos']    	 = $this->productos_model->sp_getProductosLis($idsub,$config['per_page'],$config['per_star']);
	    $this->data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();	
		
		
		
		$this->data['productos']      = $this->productos_model->get_products($config['per_page'], $this->data['page'], $search);
		$this->data['linkurl']        =  $this->input->post("product_name");


		 $this->data['features']     = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 = $this->contenidos_model->sp_getBanners();			
        
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
	
     	$this->data['header'] 	= 'home/header';
		$this->data['slider'] 	= 'home/slider';
	    $this->data['catmenu']  = 'home/menu-acordeon';
        $this->data['menusup']  = 'home/menu-superior';

		$this->data['view']   	    = 'productos/catalogo_productos';
	    $this->data['footer'] 	= 'home/footer';  			
        $this->load->view('layout/layout',  $this->data);	
		

    }


    public function categoria(){
	
    	$url       =  $this->uri->segment(3);  
    	//$idcat     = substr($url, 0, 1);  
    	//$array 		= explode("-", $url);
    	//$idcat     =  $array[0];    
		$idcat     =  $url; 
    	/* Se obtienen los registros a mostrar*/
   		//$this->data['users'] = $this->user_model->get_usuarios($config['per_page'], $this->uri->segment(3));
		
		$this->data['site']              = $this->contenidos_model->sp_getSiteOffline();
    	$this->data['breadcrumb']        = $this->maquinas_model->sp_getBreadcrumbs($idcat,'categorias');
		
    	$this->data['categorias']        = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	 = $this->productos_model->sp_getSubCategorias();	
		
		//var_dump($this->data['categorias']);
		
    	$this->data['menus']    	 	 = $this->menus_model->sp_getMenus();
    	$this->data['marcas']     	 	 = $this->marcas_model->sp_getMarcasAll();	
		
		//$this->data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
		
		$this->data['features']    	 	 = $this->productos_model->sp_getProductsFeatures();	
		$this->data['banners']    	 	 = $this->contenidos_model->sp_getBanners();	
		$this->data['productos']         = $this->productos_model->sp_getProductos($url);	
       var_dump($this->data['productos']);		
		
		//$this->data['catalogosubcat']  = $this->maquinas_model->sp_getSubcategoriasCatalogo($idcat);	

     	$this->data['menusup']   	= 'home/menu-superior';
		$this->data['catmenu']   	= 'home/menu-acordeon';

		$this->data['header']		= 'home/header';        	
		$this->data['slider']		= 'home/slider';
		$this->data['view']   	    = 'productos/catalogo_productos';
		//$this->data['view']   	    = 'productos/catalogo_subcategorias';
		//$this->data['view']			= 'home/panel';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';
		
        $this->load->view('layout/layout',  $this->data);	
		
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


	public function add()
	{
              // Set array for send data.
		$insert_data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'qty' => 1
		);		

                 // This function add items into cart.
		$this->cart->insert($insert_data);
	      
                // This will show insert data in cart.
		redirect('shopping');
		//redirect($this->productos());
		//redirect(base_url('/'), 'refresh');
	}
	
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




}
