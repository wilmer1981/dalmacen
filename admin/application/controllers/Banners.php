<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {

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
	public function __construct() {
        parent::__construct();
        if((!$this->session->userdata('logado'))){
            redirect('home/login');
        }     

       // $this->load->helper(array('codegen_helper','url'));
       // $this->load->library('fpdf/fpdf');
        //$this->load->library('excel');
       // $this->load->library('phpexcel/PHPExcel');
        $this->load->library(array('session','cart'));
        //$this->load->library('cart');      
        $this->load->model('empleados_model','',TRUE);
		$this->load->model('articulos_model','',TRUE);
		$this->load->model('banners_model','',TRUE);
		
        $this->load->model('usuarios_model','',TRUE);
	    $this->load->model('productos_model','',TRUE);
        $this->load->model('generales_model','',TRUE);  
	 
       
    }

	public function index() { 
	
		$this->data['categorias']       = $this->productos_model->sp_getCategorias();
		$this->data['subcategorias']	= $this->productos_model->sp_getSubCategorias();

       $this->data['banners']      = $this->banners_model->getBanners('','','','');

        $this->data['header']      = 'home/header';    
        $this->data['footer']      = 'home/footer';
        $this->data['menu']        = 'home/menu';  
		$this->data['breadcrumbs'] = 'home/breadcrumbs';	

		$this->data['menuContenido'] = 'Contenido'; 
        $this->data['menuBanners'] = 'Banners';		

        // cargamos  la interfaz
        $this->data['view']   = 'contenido/banners/banners';  
        $this->load->view('layout/template',  $this->data);
    
    }



    public function adicionar(){
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		
		$this->form_validation->set_rules('txtNombre', 'Nombre', 'trim|required'); 

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
			
			
			  //si no se ha seleccionado imagen
            if($_FILES['imagenBanner']['error'] == UPLOAD_ERR_NO_FILE){ 
                $url_imagen  = '';                        
            }else{ //si se ha seleccionada
				$targetFolder = "uploads/banners/";// Relative to the root
                $config['upload_path']   = $targetFolder;
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('imagenBanner')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                     $upload_data = $this->upload->data();
                     $url_imagen  = $targetFolder.''.$upload_data['file_name'];
                }           
            }      
			
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$sContent = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);
            //$sContent = strip_tags(stripslashes(set_value('txtDescrip')),$allowedTags);
			$alias = urls_amigables($this->input->post('txtTitulo'));

			$data = array(
                'titulo' => set_value('txtTitulo'),           
                'descripcion' => $sContent,
				'url_imagen' => $url_imagen,
                'id_categoria' => set_value('cboCategoria'),
				'alias' => $alias,				
                'estado' => set_value('cboStatus'),
				'fech_ini' => set_value('txtFechIni'), 
				'fech_fin' => set_value('txtFechFin')						        
            );

            if ($this->banners_model->add('wsoft_banners', $data) == TRUE) {
                $this->session->set_flashdata('success','Banner agregado con éxito!');
     			redirect(base_url('banners'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }	
		$this->data['artstatus']    = $this->generales_model->get('wsoft_estados','','','','');
        $this->data['categorias']   = $this->generales_model->get('wsoft_categorias','','','','');		
	
        $this->data['menuContenido'] = 'Contenido';
        $this->data['menuBanners'] = 'Banners';   
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';	
        $this->data['view']   = 'contenido/banners/bannersAdicionar';
        $this->load->view('layout/template',  $this->data);

    }

    public function editar(){
		$id = $this->uri->segment(3);
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|required'); 

        if($this->form_validation->run() == false){
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{			
			$ruta=$this->input->post('txtRutaImg');
			// si no hay imagen seleccionada y existe la ruta           
			if( ($_FILES['imagenBanner']['error'] == UPLOAD_ERR_NO_FILE) && !empty($ruta) ){              
				  $url_imagen = $this->input->post('txtRutaImg');			
			// si no hay imagen seleccionada y no existe la ruta
            }else if( ($_FILES['imagenBanner']['error'] == UPLOAD_ERR_NO_FILE) && empty($ruta) ){ 
				 $url_imagen = '';			
            }else{ //si se ha seleccionada  
				$targetFolder = "uploads/banners/";// Relative to the root
                $config['upload_path']   = $targetFolder;
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('imagenBanner')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                    $upload_data = $this->upload->data();
                    $url_imagen  = $targetFolder.''.$upload_data['file_name'];
                }           
            }
			
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$sContent = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);
            //$sContent = strip_tags(stripslashes(set_value('txtDescrip')),$allowedTags);
			
			$alias = urls_amigables($this->input->post('txtTitulo'));

			$data = array(
                'titulo' => $this->input->post('txtTitulo'),           
                'descripcion' => $sContent,
				'url_imagen' => $url_imagen,
                'id_categoria' => $this->input->post('cboCategoria'),
				'alias' => $alias,				
                'estado' => $this->input->post('cboStatus'),
				'fech_ini' => $this->input->post('txtFechIni'), 
				'fech_fin' => $this->input->post('txtFechFin'),  
				'fech_act' => date('Y-m-d H:i:s') 				
            );
            if($this->generales_model->edit('wsoft_banners', $data,'id',$id) == TRUE){
                $this->session->set_flashdata('success','Banner editado con éxito!');
     			redirect(base_url('banners/editar/'.$id));
            }else{
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }	

		$this->data['banners']       = $this->banners_model->getBanners('','a.id="'.$id.'"','','');		
		$this->data['artstatus']     = $this->generales_model->get('wsoft_estados','','','','');
         $this->data['categorias']   = $this->generales_model->get('wsoft_categorias','','','','');
        
        $this->data['menuContenido'] = 'Contenido';
        $this->data['menuBanners'] = 'Banners';   
 
        $this->data['header'] = 'home/header';
        $this->data['breadcrumbs'] = 'home/breadcrumbs';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';  

        $this->data['view']   = 'contenido/banners/bannersEditar';
        $this->load->view('layout/template',  $this->data);
    }

	
     public function autoCompleteProductos(){
        
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->productos_model->autoCompleteProduto($q);
        }

    }

    /////  OK OK ////////////

    public function autoCompleteProducto(){
        /*
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->productos_model->autoCompleteProduto($q);
        }*/

        $filtro    = $this->input->get("term");
        //$tipo      = $this->input->get("cboTipoPago");
  
    
        $productos = $this->productos_model->autoCompleteProducto($filtro);
        //$productos = $this->productos_model->autoCompleteProductoD($filtro,$tipo);
        echo json_encode($productos);

    }


    public function autoCorrelativo(){       
       if (isset($_GET['idtipopedido'])){
            $data = array();
        //if($this->input->post('idtipopedido')){
            $idtipopedido = $_GET['idtipopedido'];
           //$idtipopedido = $this->input->post('idtipopedido');    
           //$data['correlativo'] = $this->pedidos_model->autoCorrelativo($idtipopedido);
           $data = $this->pedidos_model->autoCorrelativo($idtipopedido);
        
            echo json_encode($data);
        }
    }
    //correlativo de comprobantes
    public function autoCorrelativoComprobante(){       
       if (isset($_GET['idtipocomp'])){
            $data = array();
        //if($this->input->post('idtipopedido')){
            $idtipocomp = $_GET['idtipocomp'];
           //$idtipopedido = $this->input->post('idtipopedido');    
           //$data['correlativo'] = $this->pedidos_model->autoCorrelativo($idtipopedido);
           $data = $this->pedidos_model->autoCorrelativoComprobante($idtipocomp);
        
            echo json_encode($data);
        }
    }

    public function getTipoComp(){
   
        if($this->input->post('idtipo')){
            $idtipo    = $this->input->post('idtipo');

            //if($idtipo=='100' || $idtipo=='200') $tipo="C";
            $tipo="C"; //comprobante de pago
            $id="10"; //proforma

            if($idtipo=='100'){             
                $documentos = $this->documentos_model->get('documentos','','id="'.$id.'" AND operacion="'.$tipo.'"','','');
            }else{
                $documentos = $this->documentos_model->get('documentos','','(id!="3" AND id!="4" AND id!="10") AND operacion="'.$tipo.'"','',''); 
            }           
            
            echo '<option value="">-- TIPO COMPROBANTE --</option>';
            foreach($documentos as $fila){         
                echo '<option value="'.$fila->id .'">'.mb_strtoupper($fila->documento, 'UTF-8').'</option>';
            }      
        }
    }

        //////////////////////////REPORTES //////////////
    public function exportarFpdf(){
    
         $numPedido = $this->uri->segment(3);
        
        $this->data["NumPedido"]   = $numPedido;
        $this->data["pedido"]      = $this->pedidos_model->TraePedido($numPedido);
        $this->data["pedidoitems"] = $this->pedidos_model->TraePedidoDetalle($numPedido);


       // $this->data['pedido']      = $this->pedidos_model->getComprasById($id);
        //$this->data['pedidoitems'] = $this->pedidos_model->getComprasDetallesById($id);
        $this->load->view('constant');
        $this->load->view('ventas/pedidos/pedidosFPDF',$this->data);    
        
    }


    ////////////////////////////////////////////////////////////////////////////////////////////
    public function generarDocVentaExcelTemplate(){    
       // if ($_POST){
            $id          = $this->input->post('id');
            $idtipocomp  = $this->input->post('idtipo'); //tipo comprobante            
            
            $this->data["pedido"]      = $this->pedidos_model->TraePedido($id);
            $this->data["pedidoitems"] = $this->pedidos_model->TraePedidoDetalle($id);
            $this->data['usuario']     = $this->session->userdata('nome');    
            $this->load->view('constant');

            switch ($idtipocomp) {
                case '1':{  
                    $this->load->view('ventas/pedidos/boletaPHPExceLoad',$this->data);  
                    break;
                }
                case '2':{  
                    $this->load->view('ventas/pedidos/facturaPHPExceLoad',$this->data);     
                    break;
                }
                case '3':{ 
                    $this->data["traslado"]  = $this->pedidos_model->TraeTraslado($id); 
                    $this->data['empresa']   = $this->home_model->get('configuraciones','','','','');
                    $this->load->view('traslado/guiaPHPExceLoad',$this->data);  
                    break;
                }
                default:{
                     $this->load->view('ventas/pedidos/proformaFPDF',$this->data); 
                    break;
                }
            }              
       //}        
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function generarDocVentaTxt(){
    
       // if ($_POST){
          //  $id         = $_POST['id'];     //id venta
            $id          = $this->input->post('id');
            $idtipocomp  = $this->input->post('idtipo'); //tipo comprobante
            
            
            $this->data["pedido"]      = $this->pedidos_model->TraePedido($id);
            $this->data["pedidoitems"] = $this->pedidos_model->TraePedidoDetalle($id);
            $this->data['usuario']     = $this->session->userdata('nome');

          // var_dump($this->data["pedido"]);


           // $this->data['pedido']      = $this->pedidos_model->getComprasById($id);
            //$this->data['pedidoitems'] = $this->pedidos_model->getComprasDetallesById($id);
            $this->load->view('constant');
            switch ($idtipocomp) {
                case '1':{  
                    $this->load->view('ventas/pedidos/boletaFPDF',$this->data);  
                    break;
                }
                case '2':{  
                    $this->load->view('ventas/pedidos/facturaTXT',$this->data); 
                    break;
                }
                case '3':{ 
                    $this->data["traslado"]  = $this->pedidos_model->TraeTraslado($id); 
                    $this->data['empresa']   = $this->home_model->get('configuraciones','','','','');
                    $this->load->view('traslado/guiaFPDF',$this->data);  
                    break;
                }
                default:{
                     $this->load->view('ventas/pedidos/proformaFPDF',$this->data); 
                    break;
                }
            } 
             
       //}
        
    }

     




}
