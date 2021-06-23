<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		
		$this->load->model('estados_model','',TRUE);
		$this->load->model('menus_model','',TRUE);
		$this->load->model('contenidos_model','',TRUE);
		$this->load->model('categorias_model','',TRUE);
		$this->load->model('productos_model','',TRUE);	
		$this->load->model('marcas_model','',TRUE);
		$this->load->model('modelos_model','',TRUE);
		$this->load->model('generales_model','',TRUE);		
		$this->load->library('funciones');	
		$this->count_visitor = count_visitor();		
		//echo initGA('UA-88236979-1');	//google analitics
	} 
	public function index(){	

		$data['site']    = $this->contenidos_model->sp_getSiteOffline();
		$sites=$data['site'];
		//var_dump($sites->offline_site);
		if($sites->offline_site!=1){
			$this->online();
		}else{
			$this->offline();
		}
	}
	
	public function online()
	{
			//var_dump($product_id);
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
		$this->data['offerts']    	   = $this->productos_model->sp_getProductsOffert();

		//var_dump($this->data['offerts'] );
	
		$this->data['menusup']   	= 'home/menu-superior';		
		$this->data['menucat']   	= 'home/menu-categorias';
		$this->data['breadcrumbs']  = 'home/breadcrumbs';
		$this->data['ofertas']      = 'home/ofertas';

		$this->data['header']		= 'home/header';        	
		$this->data['slider']		= 'home/slider';
        $this->data['view']			= 'home/panel';
        $this->data['footer']		= 'home/footer';
		$this->data['featuresmod']	= 'home/features';	
		$this->data['latestsmod']	= 'home/latest';	
       
        $this->load->view('layout/layout',  $this->data);				
	
	}
	
	public function offline()
	{
	
		$data['site']           = $this->contenidos_model->sp_getSiteOffline();
	
	//var_dump($product_id);
		$limit=8;
		$data['estados']    	 = $this->estados_model->get_estados();	
		$data['menus']    	 	 = $this->menus_model->sp_getMenus();
			
		$data['categorias']      = $this->productos_model->sp_getCategorias();
		$data['subcategorias']   = $this->productos_model->sp_getSubCategorias();	

		$data['categoriaslimit'] = $this->productos_model->sp_getCategoriasLimit($limit);		
		$data['marcas']     	 = $this->marcas_model->sp_getMarcasAll();	
		$data['modelos']    	 = $this->modelos_model->sp_getModelosAll();	
		$data['features']    	 = $this->productos_model->sp_getProductsFeatures();	
		$data['banners']    	 = $this->contenidos_model->sp_getBanners();	
		$data['latests']    	 = $this->productos_model->sp_getProductsLatest();		
	
			
		$data['header'] 	= 'home/header';	
		//$data['catmenu']   	= 'home/menucat';
		$data['catmenu']   	= 'home/menu-acordeon';
        	
		$data['slider'] 	= 'home/slider';
        $data['view']   	= 'home/panel-off';
        $data['footer'] 	= 'home/footer';
		$data['featuresmod']= 'home/features';	
		$data['latestsmod']= 'home/latest';		
		
		$this->load->view('layout/layout',  $data);	
	
	}
	

	
	public function sp_getMarcas(){
		$options = "";
		if($this->input->post('idcategoria')){
			$idcategoria = $this->input->post('idcategoria');
			//$marcas = $this->productos_model->get_marcas($idcategoria);
			$marcas = $this->productos_model->sp_getMarcas($idcategoria);
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
			$modelos = $this->productos_model->get_modelos($idmarca);
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
			$marcas = $this->productos_model->sp_getModelos($idmarca);
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
	
		public function getProvincias(){
        $options = "";
        if($this->input->post('iddpto')){
            $iddpto   = $this->input->post('iddpto');
            //$provincias  = $this->paises_model->getUbigeo('ubigeo2006','','CodDpto="'.$iddpto.'" and CodProv!="0" and CodDist="0"','','');
             $provincias  = $this->generales_model->getUbigeo('wsoft_ubigeos','','CodDpto="'.$iddpto.'" and CodProv!="0" and CodDist="0"','','');
        ?>
          <option value="" disabled selected>-- Seleccione Provincia --</option>
          <?php
            foreach($provincias as $fila)
            {
            ?>
            <option value="<?php echo $fila->CodProv; ?>"><?php echo $fila->Nombre; ?></option>
            <?php
            }
        }
    }

    public function getDistritos(){
        $options = "";
        if($this->input->post('idprov')){
            $iddpto   = $this->input->post('iddpto');
            $idprov   = $this->input->post('idprov');
            
            //$distritos  = $this->paises_model->getUbigeo('ubigeo2006','','CodDpto="'.$iddpto.'" and CodProv!="0" and CodDist!="0"','','');
           $distritos  = $this->generales_model->getUbigeo('wsoft_ubigeos','','CodDpto="'.$iddpto.'" and CodProv="'.$idprov.'" and CodDist!="0"','','');
        ?>
          <option value="" disabled selected>-- Seleccione Distrito --</option>
          <?php
            foreach($distritos as $fila)
            {
            ?>
            <option value="<?php echo $fila->CodUbigeo; ?>"><?php echo $fila->Nombre; ?></option>
            <?php
            }
        }
    }
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
