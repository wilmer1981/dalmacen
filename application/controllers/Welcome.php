<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {		
		parent::__construct();
		$this->load->library(array('session'));	
		$this->load->library('cart');
		//$this->load->helper('url');
		$this->load->helper(array('counter','url','google_helper'));
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
		$this->count_visitor = count_visitor();		
		//echo initGA('UA-88236979-1');	//google analitics
	} 
	public function index(){	

		if ($this->uri->segment(1) === FALSE)
		{
		    $product_id = 0;
		}
		else
		{
		    $product_id = $this->uri->segment(1);
		}


		//var_dump($product_id);
		$limit=8;
		$data['estados']    	 = $this->estado_model->get_estados();	
		$data['menus']    	 	 = $this->menu_model->sp_getMenus();
			
		$data['categorias']      = $this->maquina_model->sp_getCategorias();
		$data['subcategorias']   = $this->maquina_model->sp_getSubCategorias();	

		$data['categoriaslimit'] = $this->maquina_model->sp_getCategoriasLimit($limit);		
		$data['marcas']     	 = $this->marca_model->sp_getMarcasAll();	
		$data['modelos']    	 = $this->modelo_model->sp_getModelosAll();	
		$data['features']    	 = $this->producto_model->sp_getProductsFeatures();	
		$data['banners']    	 = $this->contenido_model->sp_getBanners();	
		
		$this->load->view('header',$data);	
		$this->load->view('vhome',$data);	
		$this->load->view('footer',$data);
		
		//$data['header'] 	= 'header';		
       // $data['view']   	= 'vhome';
       // $data['footer'] 	= 'footer';
        //$data['slider'] 	= 'slider';
        //$this->load->view('layout/layout',  $data);

	}

	
	public function sp_getMarcas(){
		$options = "";
		if($this->input->post('idcategoria')){
			$idcategoria = $this->input->post('idcategoria');
			//$marcas = $this->maquina_model->get_marcas($idcategoria);
			$marcas = $this->maquina_model->sp_getMarcas($idcategoria);
		?>
		  <option value="">Escoje tu marca</option>
		  <?php
			foreach($marcas as $fila)
			{
			?>
			<option value="<?php echo $fila->id; ?>"><?php echo $fila->descripcion; ?></option>
			<?php
			}
		}
	}
	
	public function get_modelos(){
		$options = "";
		if($this->input->post('idmarca')){
			$idmarca = $this->input->post('idmarca');
			$modelos = $this->maquina_model->get_modelos($idmarca);
		?>
		  <option value="">Escoje el modelo</option>
		  <?php
			foreach($modelos as $fila)
			{
			?>
			<option value="<?php echo $fila->id; ?>"><?php echo $fila->descripcion; ?></option>
			<?php
			}
		}
	}
	
	public function sp_getModelos(){
		$options = "";
		if($this->input->post('idmarca')){
			$idmarca = $this->input->post('idmarca');	
			$marcas = $this->maquina_model->sp_getModelos($idmarca);
		?>
		  <option value="">Escoje tu marca</option>
		  <?php
			foreach($marcas as $fila)
			{
			?>
			<option value="<?php echo $fila->id; ?>"><?php echo $fila->descripcion; ?></option>
			<?php
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
