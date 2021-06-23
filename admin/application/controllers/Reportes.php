<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

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
        /*if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('home/login');
        }*/

        $this->load->helper(array('codegen_helper','url'));
        $this->load->model('empleados_model','',TRUE);
        $this->load->model('usuarios_model','',TRUE);
		$this->load->model('documentos_model','',TRUE);
        $this->load->model('productos_model','',TRUE);
        $this->load->model('clientes_model','',TRUE);
        $this->load->model('pedidos_model','',TRUE);
        $this->load->model('compras_model','',TRUE);
        $this->load->model('inventarios_model','',TRUE);
        $this->load->library('fpdf/fpdf'); 

        $this->data['menuReportes'] = 'Reportes';  
		

       
    }

	public function index() {   
	

       // $user_id= $this->session->userdata('id');   
        
        $this->data['pedidos'] = $this->pedidos_model->getPedidos('','','','','');

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';    

        $this->data['menuReporteVG'] = 'Pedidos';
        $this->data['menuReportesVentas'] = 'Reportes'; 
         

        // cargamos  la interfaz
        $this->data['view']   = 'ventas/pedidos/pedidos';  
        $this->load->view('layout/template',  $this->data);
    
    }



    public function exportarVentasFpdf(){

        // $search1 = $this->input->post("txtFechaInicial");
        //$search2 = $this->input->post("txtFechaFinal");
        //$search3 = $this->input->post("cboTipoPedidos");

        
        $fecha1  = ($this->input->post("txtFechaInicial"))? fentrada_mysql($this->input->post("txtFechaInicial")) : "";
        $fecha2  = ($this->input->post("txtFechaFinal"))? fentrada_mysql($this->input->post("txtFechaFinal")) : "";
        $search3 = ($this->input->post("cboTipoPedidos"))? $this->input->post("cboTipoPedidos") : "";


        //$fecha1=fentrada_mysql($search1);
        //$fecha2=fentrada_mysql($search2);


        $this->data['pedidos'] = $this->pedidos_model->getPedidosReporte($fecha1, $fecha2, $search3, '', '');
        $this->data['fechini'] = $fecha1;
        $this->data['fechfin'] = $fecha2;
        $this->data['usuario'] = $this->session->userdata('nome');

        //var_dump($this->data['pagos']);
        $this->load->view('constant');    
        $this->load->view('reportes/ventas/ventasFPDF',$this->data);  
        
    }

    ////////////////////////////ALMACEN//////////////

    public function almacenkardex() {   
        $mes1  = date('m');
        $anio1 = date('Y');

          // get search string
        $mes    = ($this->input->post("cboMes"))? $this->input->post("cboMes") : $mes1;
        $anio   = ($this->input->post("cboAnio"))? $this->input->post("cboAnio") : $anio1;

             
        $this->data['saldos']  = $this->inventarios_model->getKardexReporte($mes,$anio,'','');
  

        $this->data['menuReportesAlmacen'] = 'Reportes'; 
        $this->data['menuReportesKardex'] = 'Pedidos';

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';            

        // cargamos  la interfaz
        $this->data['view']   = 'reportes/almacen/kardexReporte';  
        $this->load->view('layout/template',  $this->data);
    
    }

    public function almacenstock() {   

          // get search string      
        $categoria = ($this->input->post("cboCategoria"))? $this->input->post("cboCategoria") : "";
            
        //var_dump($fecha1);  
        
 
        $this->data['productos']  = $this->productos_model->getProductosReporte($categoria,'','');  

        $this->data['categorias']  = $this->productos_model->get('categorias','','','','');  

     

        $this->data['menuReportesAlmacen'] = 'Reportes'; 
        $this->data['menuReportesStock'] = 'Pedidos';

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';            

        // cargamos  la interfaz
        $this->data['view']   = 'reportes/almacen/stockReporte';  
        $this->load->view('layout/template',  $this->data);
    
    }

    public function exportarKardexFpdf(){ 

        $mes1  = date('m');
        $anio1 = date('Y');
   
        $mes    = ($this->input->post("cboMes"))? $this->input->post("cboMes") : "";
        $anio   = ($this->input->post("cboAnio"))? $this->input->post("cboAnio") : "";


        //$fecha1=fentrada_mysql($search1);
        //$fecha2=fentrada_mysql($search2);

              
        $this->data['saldos']  = $this->inventarios_model->getKardexReporte($mes,$anio,'','');

        $this->data['mes'] = $mes;
        $this->data['anio'] = $anio;
        $this->data['usuario'] = $this->session->userdata('nome');

        //var_dump($this->data['pagos']);
        $this->load->view('constant');    
        $this->load->view('reportes/almacen/kardexFPDF',$this->data);  
        
    }

    public function exportarStockFpdf(){ 

        
        $categoria    = ($this->input->post("cboCategoria"))? $this->input->post("cboCategoria") : "";
     
              
        $this->data['productos']  = $this->productos_model->getProductosReporte($categoria,'','');  

      
        $this->data['usuario'] = $this->session->userdata('nome');

        //var_dump($this->data['pagos']);
        $this->load->view('constant');    
        $this->load->view('reportes/almacen/stockFPDF',$this->data);  
        
    }






    /////////////////// REPORTE DE VENTAS /////////////////////////////////////////////////
    public function ventas() {   

          // get search string
        $fecha1  = ($this->input->post("txtFechaInicial"))? fentrada_mysql($this->input->post("txtFechaInicial")) : "";
        $fecha2  = ($this->input->post("txtFechaFinal"))? fentrada_mysql($this->input->post("txtFechaFinal")) : "";
        $search3 = ($this->input->post("cboTipoPedidos"))? $this->input->post("cboTipoPedidos") : "";
            
        //var_dump($fecha1);    
        
        //$this->data['pedidos'] = $this->pedidos_model->getPedidos('','','','','');
        $this->data['pedidos']     = $this->pedidos_model->getPedidosReporte($fecha1, $fecha2, $search3, '', '');
        $this->data['pedidostipo'] = $this->pedidos_model->get('pedidos_tipo','','estado="1"','','');
           
  

        $this->data['menuReportesVentas'] = 'Reportes'; 
        $this->data['menuReportesVG'] = 'Pedidos';

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';            

        // cargamos  la interfaz
        $this->data['view']   = 'reportes/ventas/ventasReporte';  
        $this->load->view('layout/template',  $this->data);
    
    }



    public function search(){


        // get search string
        $search1 = ($this->input->post("txtFechaInicial"))? $this->input->post("txtFechaInicial") : "";
        $search2 = ($this->input->post("txtFechaFinal"))? $this->input->post("txtFechaFinal") : "";
        $search3 = ($this->input->post("cboTipoPedidos"))? $this->input->post("cboTipoPedidos") : "";

        $search1 = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search1;
        $search2 = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search2;
        $search3 = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search3;
        
        $search =$search1." - ".$search2." - ".$search3;
        
        //echo $search."<br>";
        //echo fentrada_mysql($search1)."<br><br>";
        //echo fentrada_mysql($search2);
        $fecha1=fentrada_mysql($search1);
        $fecha2=fentrada_mysql($search2);

 
     
       // $this->data['pagos'] = $this->pagos_model->get_pagos_turno($config['per_page'], $data['page'], $fecha1,$fecha2,$search3);

        $this->data['pedidos'] = $this->pedidos_model->getPedidosReporte($fecha1, $fecha2, $search3, '', '');
        $this->data['pedidostipo'] = $this->pedidos_model->get('pedidos_tipo','','estado="1"','','');
       // var_dump($this->data['pedidos']);

  
        $this->data['menuReporteVG'] = 'Pedidos';
        $this->data['menuReportesVentas'] = 'Reportes'; 
     
        //load view
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';  
    

        // cargamos  la interfaz
         $this->data['view']   = 'reportes/ventas/ventasReporte';  
        $this->load->view('layout/template',  $this->data);
        
    }

    public function ventaproductos() {   
        $mes1  = date('m');
        $anio1 = date('Y');

        //si no ha seleccionado combo, por default selecciona es mes y año actual
        //$mes    = ($this->input->post("cboMes"))? $this->input->post("cboMes") : $mes1;
       //$anio   = ($this->input->post("cboAnio"))? $this->input->post("cboAnio") : $anio1;

        //si no ha seleccionado combo, por default selecciona es mes y año actual
        $mes    = ($this->input->post("cboMes"))? $this->input->post("cboMes") : '';
        $anio   = ($this->input->post("cboAnio"))? $this->input->post("cboAnio") : '';

             
        $this->data['ventas']  = $this->inventarios_model->getVentasProducto($mes,$anio,'','');
  

        $this->data['menuReportesVP'] = 'Reportes'; 
        $this->data['menuReportesVentas'] = 'Pedidos';

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';            

        // cargamos  la interfaz
        $this->data['view']   = 'reportes/ventas/ventasProducto';  
        $this->load->view('layout/template',  $this->data);
    
    }




    public function buscarproductos(){
        $filtro    = $this->input->get("term");
        $productos = $this->ordencompra_model->listarproducto($filtro);
        echo json_encode($productos);
    }



    public function ImprimeVenta($numOrder){
        $numOrder          = base64_decode($numOrder);
        $data["NumOrder"]  = $numOrder;
        $data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        $this->load->view('constant');
        $this->load->view('ventas/pedidos/view_print_venta',$data);
    }

    public function ImprimeOrden($numOrder){
        $data["NumOrder"]  = $numOrder;
        $data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        $this->load->view('constant');
        $this->load->view('ventas/pedidos/view_print_venta',$data);
    }

    public function visualizar() {


         $numOrder = $this->uri->segment(3);
        
        $this->data["NumOrder"]  = $numOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $this->data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
 
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/pedidosVisualizar';
        $this->load->view('layout/template',  $this->data);

    }

    public function vistapreliminar() {
        $numOrder = $this->uri->segment(3);
        
        $this->data["NumOrder"]  = $numOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $this->data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        //$this->load->view('constant');
       // $this->load->view('ventas/pedidos/view_print_pedido',$data);

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/view_print_pedido';
        $this->load->view('constant');
        $this->load->view('layout/template',  $this->data);


    }

    //////////////////////////// COMPRAS ///////////////////////

     public function compras() {   

          // get search string
        $fecha1  = ($this->input->post("txtFechaInicial"))? fentrada_mysql($this->input->post("txtFechaInicial")) : "";
        $fecha2  = ($this->input->post("txtFechaFinal"))? fentrada_mysql($this->input->post("txtFechaFinal")) : "";
        $search3 = ($this->input->post("cboTipoPedidos"))? $this->input->post("cboTipoPedidos") : "";
            
        //var_dump($fecha1);    
        
        //$this->data['pedidos'] = $this->pedidos_model->getPedidos('','','','','');
        $this->data['pedidos']     = $this->compras_model->getIngresosReporte($fecha1, $fecha2, $search3, '', '');
        //$this->data['ingresos']    = $this->compras_model->getIngresos('','','','','');
        $this->data['pedidostipo'] = $this->pedidos_model->get('pedidos_tipo','','estado="1"','','');
           
  

        $this->data['menuReportesCompras'] = 'Reportes'; 
        $this->data['menuReportesCG'] = 'Compras';

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';            

        // cargamos  la interfaz
        $this->data['view']   = 'reportes/compras/comprasReporte';  
        $this->load->view('layout/template',  $this->data);
    
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
    




}
