<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

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

        /*
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('home/login');
        }
        */

       // $this->load->helper(array('codegen_helper','url'));
       // $this->load->library('fpdf/fpdf');
        $this->load->library('excel');
       // $this->load->library('phpexcel/PHPExcel');
        $this->load->library(array('session','cart'));
        //$this->load->library('cart');      
        $this->load->model('empleados_model','',TRUE);
        $this->load->model('usuarios_model','',TRUE);
		$this->load->model('documentos_model','',TRUE);
        $this->load->model('productos_model','',TRUE);
        $this->load->model('clientes_model','',TRUE);
        $this->load->model('pedidos_model','',TRUE);
        $this->load->model('home_model','',TRUE);
        //$this->load->model('inventarios_model','',TRUE);
        $this->load->model('paises_model','',TRUE);
        $this->load->model('generales_model','',TRUE); 
	 
       
    }

	public function index() {   
	

       // $user_id= $this->session->userdata('id'); 

        //$this->data['ventas'] = $this->pedidos_model->getPedidod('','p.id_tipocomprobante=1 OR p.id_tipocomprobante=2','','','');
  
        //proformas
        //$this->data['proformas'] = $this->pedidos_model->getPedidos('p.id_tipocomprobante=10');    
        //orden de compra
        //$this->data['pedidos']   = $this->pedidos_model->getPedidos('p.id_tipocomprobante=9'); 
		$this->data['pedidos']   = $this->pedidos_model->getPedidos(''); 		
        //ventas
       // $this->data['ventas']    = $this->pedidos_model->getVentas('v.id_tipocomprobante=1 OR v.id_tipocomprobante=2');


        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu'; 
		$this->data['breadcrumbs'] = 'home/breadcrumbs';		

        // cargamos  la interfaz
        $this->data['view']   = 'ventas/pedidos/pedidos';  
        $this->load->view('layout/template',  $this->data);
    
    }



    public function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nombres' => set_value('txtNombre'),
                'apellidos' => set_value('txtApellidos'),
                'tipo_documento' => set_value('cboTipo_Documento'),
                'num_documento' => set_value('txtNum_Documento'),
                'telefono' => set_value('txtTelefono'),               
                'email' => set_value('txtEmail'),
                'direccion' => set_value('txtDireccion'),
                'fech_nac' => set_value('txtFecH_Nac'),
                'estado' => set_value('txtEstado')        
            );

            if ($this->empleados_model->add('empleados', $data) == TRUE) {
                $this->session->set_flashdata('success','Empleado agregado con éxito!');
                redirect(base_url() . 'empleados/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
		
		$this->data['documentos']  = $this->documentos_model->getDocumentos('documentos','','operacion="C"','','');
        $this->data['pedidostipo'] = $this->pedidos_model->get('pedidos_tipo','','estado="1"','','');
        $this->data['pagostipo'] = $this->pedidos_model->get('pagos_tipo','','estado="1"','','');
		//var_dump($this->data['documentos']);




        ///////////////////////////////////////////////////////////////////////////////////
        $this->data['documentosper'] = $this->documentos_model->getDocumentos('documentos','','operacion="P"','','');

        //$this->data['paises']     = $this->paises_model->get('pais','','','','');
        //consultamos departamentos
        //$this->data['dptos']     = $this->paises_model->getUbigeo('ubigeo2006','','CodProv="0" and CodDist="0"','','');
        $this->data['dptos']     = $this->paises_model->getUbigeo('ubigeos','','CodProv="0" and CodDist="0"','','');


        /// Correlativo Clienets  
        $this->data['correlativos']  = $this->clientes_model->getMaxId('clientes','id');      
        $correlativo = $this->data['correlativos'];     
        $this->data['correlativo'] = generarCodigo($correlativo->id+1, 5);    
        //var_dump($this->data['correlativo']);
            //////////////////////////////////////////////////////////////////////////////////



        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/pedidosAdicionar';
        $this->load->view('layout/template',  $this->data);

    }

    public function editar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nombres' => set_value('txtNombre'),
                'apellidos' => set_value('txtApellidos'),
                'tipo_documento' => set_value('cboTipo_Documento'),
                'num_documento' => set_value('txtNum_Documento'),
                'telefono' => set_value('txtTelefono'),               
                'email' => set_value('txtEmail'),
                'direccion' => set_value('txtDireccion'),
                'fech_nac' => set_value('txtFecH_Nac'),
                'estado' => set_value('txtEstado')        
            );

            if ($this->empleados_model->add('empleados', $data) == TRUE) {
                $this->session->set_flashdata('success','Empleado agregado con éxito!');
                redirect(base_url() . 'empleados/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
        
        $this->data['documentos']  = $this->documentos_model->getDocumentos('documentos_tipo','','operacion="C"','','');
        $this->data['pedidostipo'] = $this->pedidos_model->get('pedidos_tipo','','estado="1"','','');
        //var_dump($this->data['documentos']);

        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/pedidosEditar';
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


 public function autoCompleteProductoCompra(){
        $filtro     = $this->input->get("term");
        //$tipo      = $this->input->get("cboTipoPago");
        
        //$filtro    = $this->input->post("q");
        //$tipo      = $this->input->post("t"); //tipopago
    
        $productos = $this->productos_model->autoCompleteProducto($filtro);
        //$productos = $this->productos_model->autoCompleteProductoD($filtro,$tipo);
        echo json_encode($productos);

    }

    //buscar producto pára vender
    public function busquedaProducto(){
        /*
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->productos_model->autoCompleteProduto($q);
        }*/

        //$filtro    = $this->input->get("term");
        //$tipo      = $this->input->get("cboTipoPago");
        $filtro    = $this->input->post("q");
        $tipo      = $this->input->post("t"); //tipopago
       
        $productos = $this->productos_model->busquedaProductoD($filtro,$tipo);
        echo json_encode($productos);

    }




    public function buscarproductos(){
        $filtro    = $this->input->get("term");
        $productos = $this->ordencompra_model->listarproducto($filtro);
        echo json_encode($productos);
    }

    public function autoCompleteCliente(){

        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->clientes_model->autoCompleteCliente($q);
        }

    }

    public function addCarrito(){
        $CarritoNewVenta   = json_decode($this->input->post('MiCarrito'));
        if(isset($_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession])){
                $carrito_orderventa=$_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession];

                if(isset($CarritoNewVenta->CodProducto)){
                    $codproducto  = $CarritoNewVenta->CodProducto;
                    $precio       = $CarritoNewVenta->Pventa;
                    $cantidad     = $CarritoNewVenta->Cantidad;
                    $descripcion  = $CarritoNewVenta->Descripcion;   
                    $descuento    = $CarritoNewVenta->Dscto;         
                              
                    $donde     = -1;
                    for($i=0;$i<=count($carrito_orderventa)-1;$i ++){
                    if($codproducto==$carrito_orderventa[$i]['codproducto']){
                        $donde=$i;
                    }
                    }
                    if($donde != -1){
                        $cuanto=$carrito_orderventa[$donde]['cantidad'] + $cantidad;                
                        $carrito_orderventa[$donde]=array("codproducto"=>$codproducto,"precio"=>$precio,"cantidad"=>$cuanto,"descripcion"=>$descripcion,"descuento"=>$descuento);
                    }else{             
                        $carrito_orderventa[]=array("codproducto"=>$codproducto,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcion,"descuento"=>$descuento);                        
                    }
                }
        }else{
                $codproducto   = $CarritoNewVenta->CodProducto;
                $precio        = $CarritoNewVenta->Pventa;
                $cantidad      = $CarritoNewVenta->Cantidad;
                $descripcion   = $CarritoNewVenta->Descripcion;  
                $descuento     = $CarritoNewVenta->Dscto;  

                $carrito_orderventa[]=array("codproducto"=>$codproducto,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcion,"descuento"=>$descuento); 
        }
        $_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession]=$carrito_orderventa;
        echo json_encode($_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession]);
    }

    //Guardar VENTA/PROFORMA
    public function saveOrder(){
        $arrayResponse = array("NumOrden"=>"0","Msg"=>"Error: Ocurrio Un Error Intente de Nuevo", "TipoMsg"=>"Error");

        $OrderVenta    = json_decode($this->input->post('MiCarrito'));
        $RecuperaOrder = $_SESSION["CarritoVenta".$OrderVenta->IdSession];
      
        $impuesto      = 18;

        $tipopedido  = $OrderVenta->TipoPedido;

        if($tipopedido=="200"){ //si es venta
            $serie  =$OrderVenta->Serie;
            $numero =$OrderVenta->NumComp;
            $tipoc  =$OrderVenta->TipoComp; 
           // $tipod  =$OrderVenta->TipoDscto; 

            $tipocomp  =$OrderVenta->TipoComp;
        }else{
            $serie  ="000";
           // $numero =$OrderVenta->NumPedido;  
            $numero =$OrderVenta->NumComp;  
            $tipoc  ='10';   //Proforma
           //$tipod  =$OrderVenta->TipoDscto; 
        }

       
        $idcli  = $OrderVenta->IdCliente; 
       // $cliente= $OrderVenta->Cliente;
        if($idcli==""){ // si no existe cliente registrar

                $ultimoId  = $this->generales_model->getByMaxId('clientes','id');
                //var_dump($this->data['correlativos']);
                $nuevocodigo = $ultimoId->id+1; //
               // $correlativo = $this->data['correlativos'];
                /// echo $correlativo->cantidad;
                //$this->data['correlativo'] = generarCodigo($correlativo->id+1, 5);  
                $codigo = generarCodigo($nuevocodigo, 5);    

                    $data = array(    
                        //'codigo' => $this->input->post('txtCodigo'),  
                        'codigo' => "C".$codigo,  
                        'id_tipocliente' => '2',       //empresa   
                        'razon_social' =>$OrderVenta->Cliente,                  
                        'id_tipodoc' => '8', //ruc
                        'num_documento' => $OrderVenta->NumDoc,                      
                        'ubigeo' => $OrderVenta->Ubigeo,  
                        'direccion' => $OrderVenta->Direccion                        
                    );
                    $this->clientes_model->add('clientes', $data);   
                   // $maximo       = $this->generales_model->getByMaxId('clientes','id');
                   // $idCliente    = $maximo->id;
                   $idCliente  = $nuevocodigo;//$ultimoId->id+1; //id despues de registrar 

                     //Insertamos Contacto del cliente
                    $data = array(                                             
                            'tipo_contacto' => 'C', //contacto del cliente    
                            'id_tipocontacto' => $idCliente //id del iente                                             
                    );
                    $this->clientes_model->add('contactos', $data);          

        }else{
            $idCliente  = $OrderVenta->IdCliente; 
        }

        $arrayPedido= array(              
               // "id_cliente"          =>$OrderVenta->IdCliente,
                "id_cliente"          =>$idCliente,
                "id_tipopedido"       =>$OrderVenta->TipoPedido,//"Venta / Cotizacion",  
                "id_tipocomprobante"  =>$tipoc,  
                "serie_comprobante"   =>$serie,  
                "num_pedido"          =>$numero, 
                "tipo_pago"           =>$OrderVenta->TipoPago, 
                "id_dscto"            =>$OrderVenta->TipoDscto,                 
                "impuesto_base"       =>$impuesto,
                "impuesto_total"      =>$OrderVenta->IVA,
                "bruto"               =>$OrderVenta->Subtotal,
                "total"               =>$OrderVenta->Total,
                "id_usuario"          =>$this->session->userdata('id')
                );

        //guarda la cabecera/pedido
        $saveOrderPedido = $this->pedidos_model->saveOrderPedido($arrayPedido);

        if($saveOrderPedido!=0){
            foreach ($RecuperaOrder as $key => $value) {
                $arrayDetalle = array(
                    "id_pedido"         => $saveOrderPedido, 
                    "cod_producto"      => $value["codproducto"],         
                    "cantidad"          => $value["cantidad"],       
                    "precio_venta"      => $value["precio"],
                    "descripcion"       => $value["descripcion"],
                    "descuento"         => $OrderVenta->Dscto                   
                    );

                # code...
                $this->pedidos_model->saveOrderDetalle($arrayDetalle);
                
                if($tipopedido=="200" AND $tipocomp!=9 ){ // si tipo pedido = VENTA y tipocomp!=ORDEN COMPRA, actualizamos STOCK
                    $this->pedidos_model->UpdateExistenciasProducto($value["codproducto"],$value["cantidad"]);
                      //actualizamos Inventario
                    $this->inventarios_model->UpdateSalidaProducto($value["codproducto"],$value["cantidad"]);

                }
            }

             //guardamos VENTA, si comprobante es FACTURA o BOLETA
            if($tipopedido=="200" AND $tipocomp!=9){ // si tipo pedido = VENTA           
                 $arrayVenta= array(              
                    "id_pedido"          =>$saveOrderPedido,
                    "id_tipocomprobante"  =>$tipoc,  
                    "serie_comprobante"   =>$serie,  
                    "num_comprobante"     =>$numero, 
                    "tipo_pago"           =>$OrderVenta->TipoPago, 
                    "id_usuario"          =>$this->session->userdata('id')
                );
                $this->pedidos_model->saveOrderVenta($arrayVenta);
            }

            //actualizamos CORRELATIVO
            if($tipopedido=="200"){ // si tipo pedido = VENTA
               // $this->pedidos_model->UpdateCorrelativo($OrderVenta->TipoComp);
               $this->pedidos_model->UpdateNumeroDoc($OrderVenta->TipoComp); // Id Tipo Comprobante        
            }else{
                //$this->pedidos_model->UpdateCorrelativo($OrderVenta->TipoPedido);
                $this->pedidos_model->UpdateNumeroDoc($OrderVenta->TipoComp);
            }            
            // $this->session->set_flashdata('success','Pedido guardado con éxito!');
            // redirect(base_url() . 'pedidos/adicionar');
            $arrayResponse = array("NumOrden"=>base64_encode($saveOrderPedido),"Msg"=>"<strong>Folio: ".$numero."</strong>, La Venta se Guardado Correctamente", "TipoMsg"=>"Sucefull");
            //$arrayResponse = array("NumOrden"=>base64_encode($saveOrderPedido),"Msg"=>"<strong>Folio: ".$saveOrderPedido."</strong>, La Venta se Guardado Correctamente", "TipoMsg"=>"Sucefull");
        }
       echo json_encode($arrayResponse);
        
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

    public function ImprimeBoleta($numOrder){
        $data["NumOrder"]  = $numOrder;
        $data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        $this->load->view('constant');
        $this->load->view('ventas/pedidos/view_print_boleta',$data);
    }

   /* public function ImprimeBoleta($numOrder){
        $data["NumOrder"]  = $numOrder;
        $data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        $this->load->view('constant');
        $this->load->view('ventas/pedidos/view_print_boleta',$data);
    }*/

    public function visualizar() {


        $idOrder = $this->uri->segment(3);
        
        $this->data["NumOrder"]  = $idOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->getPedidos('p.id="'.$idOrder.'"');
		//var_dump( $this->data["DocOrder"]);
        $this->data["ListOrder"] = $this->pedidos_model->getPedidosDetalle('p.id="'.$idOrder.'"');


    
        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';		
        $this->data['view']   = 'ventas/pedidos/pedidosVisualizar';
        $this->load->view('layout/template',  $this->data);

    }

     public function visualizarorden() {

         $numOrder = $this->uri->segment(3);
        
        $this->data["NumOrder"]  = $numOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $this->data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);

        //var_dump($this->data["DocOrder"]);
    
        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/ordenesVisualizar';
        $this->load->view('layout/template',  $this->data);

    }

     public function visualizarproforma() {

         $numOrder = $this->uri->segment(3);
        
        $this->data["NumOrder"]  = $numOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $this->data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);

        //var_dump($this->data["DocOrder"]);
    
        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/proformaVisualizar';
        $this->load->view('layout/template',  $this->data);

    }

    public function generarguia() {


        $numOrder = $this->uri->segment(3);

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtPlaca', 'Placa', 'trim|required');  

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'id_pedido' => $numOrder,
               // 'id_pedido' => set_value('txtId'),
                'serie_guia' => set_value('txtSerie'),
                'numero_guia' => set_value('txtNumero'),
                'id_transportista' => set_value('txtIdTransportista'),
                'punto_llegada' => set_value('txtPuntoLlegada'),
                'id_motivo' => set_value('cboMotivo'),
                'fech_partida' => set_value('txtFechaPartida'),
                'id_usuario'   => $this->session->userdata('id')                  
            );

            var_dump($data);

            if ($this->pedidos_model->add('traslados', $data) == TRUE) {
               //$this->session->set_flashdata('success','GUIA DE REMISION agregado con éxito!');
                //redirect(base_url() . 'pedidos');
                echo "OK";
            } else {
                echo "Error";
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }



        
        $this->data["NumOrder"]  = $numOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $this->data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        $this->data['motivos']   = $this->pedidos_model->get('traslados_motivo','','estado="1"','','');
        $this->data['empresa']   = $this->home_model->get('configuraciones','','','','');

          /// Correlativo   
        $this->data['correlativos']  = $this->pedidos_model->getCorrelativo(3); //guia de remision
        $correlativo = $this->data['correlativos'];
        $this->data['serienumero'] = $correlativo->serie;
        $this->data['correlativo'] = generarCodigo($correlativo->numero, 6);
 


        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'traslado/trasladoRegistrar';
        $this->load->view('layout/template',  $this->data);

    }

    public function registerGuia() {


        $numOrder = $this->uri->segment(3);

        $this->load->library('form_validation');
      //  $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtPlaca', 'Placa', 'trim|required');  

        if ($this->form_validation->run() == false) {
            //$this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
            echo "Falta";
        } else {
            $data = array(
                //'id_pedido' => $numOrder,
                'id_pedido' => $this->input->post('txtId'),
                'serie_guia' => $this->input->post('txtSerie'),
                'numero_guia' => $this->input->post('txtNumero'),
                'id_transportista' => $this->input->post('txtIdTransportista'),
                'punto_llegada' => $this->input->post('txtPuntoLlegada'),
                'id_motivo' => $this->input->post('cboMotivo'),
                'fech_partida' => fentrada_mysql($this->input->post('txtFechaPartida')),
                'id_usuario'   => $this->session->userdata('id')                  
            );

           // var_dump($data);

            if ($this->pedidos_model->add('traslados', $data) == TRUE) {
               //$this->session->set_flashdata('success','GUIA DE REMISION agregado con éxito!');
                //redirect(base_url() . 'pedidos');
                $this->pedidos_model->UpdateNumeroDoc(3); // Id de Guia Remision

                echo "OK";
            } else {
                echo "Error";
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }  

    }

    public function verguia() {


        $numOrder = $this->uri->segment(3);

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtPlaca', 'Placa', 'trim|required');  

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'id_pedido' => $numOrder,
               // 'id_pedido' => set_value('txtId'),
                'serie_guia' => set_value('txtSerie'),
                'numero_guia' => set_value('txtNumero'),
                'id_transportista' => set_value('txtIdTransportista'),
                'punto_llegada' => set_value('txtPuntoLlegada'),
                'id_motivo' => set_value('cboMotivo'),
                'fech_partida' => set_value('txtFechaPartida'),
                'id_usuario'   => $this->session->userdata('id')                  
            );

            var_dump($data);

            if ($this->pedidos_model->add('traslados', $data) == TRUE) {
               //$this->session->set_flashdata('success','GUIA DE REMISION agregado con éxito!');
                //redirect(base_url() . 'pedidos');
                echo "OK";
            } else {
                echo "Error";
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }



        
        $this->data["NumOrder"]  = $numOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $this->data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        $this->data["traslado"]  = $this->pedidos_model->TraeTraslado($numOrder);

        $this->data['motivos']   = $this->pedidos_model->get('traslados_motivo','','estado="1"','','');
        $this->data['empresa']   = $this->home_model->get('configuraciones','','','','');

        //var_dump($this->data["traslado"]);
        /// Correlativo   
        $this->data['correlativos']  = $this->pedidos_model->getCorrelativo(3); //guia de remision
        $correlativo = $this->data['correlativos'];
        $this->data['serienumero'] = $correlativo->serie;
        $this->data['correlativo'] = generarCodigo($correlativo->numero, 6);
 


        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'traslado/trasladoVisualizar';
        $this->load->view('layout/template',  $this->data);

    }
	
	///////////////////////PAGOS///////////////////////////
	
    public function guardarpago() {


        $numOrder = $this->uri->segment(3);

        //echo $numOrder;
        
        $this->data["NumOrder"]  = $numOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $this->data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        $this->data['motivos']   = $this->pedidos_model->get('traslados_motivo','','estado="1"','','');
        $this->data['empresa']   = $this->home_model->get('configuraciones','','','','');

         $this->data['documentos']  = $this->documentos_model->getDocumentos('documentos','','operacion="C"','','');

         //var_dump($this->data["DocOrder"]);

          /// Correlativo   
        $this->data['correlativos']  = $this->pedidos_model->getCorrelativo(3); //guia de remision
        $correlativo = $this->data['correlativos'];
        $this->data['serienumero'] = $correlativo->serie;
        $this->data['correlativo'] = generarCodigo($correlativo->numero, 6);
 


        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/pagosRegistrar';
        $this->load->view('layout/template',  $this->data);

    }
	
	public function registerPago() {


        //$numOrder = $this->uri->segment(3);

        $this->load->library('form_validation');
      //  $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtEfectivo', 'Ingresar Efectivo', 'trim|required');  

        if ($this->form_validation->run() == false) {
            //$this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
            echo "Falta";
        } else {
			$numOrder = $this->input->post('txtNumOrden');
            $data = array(          
                'importe' => $this->input->post('txtTotal'),
                'efectivo' => $this->input->post('txtEfectivo'),             
                'vuelto' => $this->input->post('txtVuelto'),  
				'estado' => '2',  				
                'user_reg_pago'   => $this->session->userdata('id'),
				'fech_act'   => date('Y-m-d H:m:s')	
            );

            // var_dump($data);
            if ($this->pedidos_model->edit('ventas', $data, 'id_pedido', $numOrder) == TRUE) {               
               // $this->pedidos_model->UpdateNumeroDoc($idcomp); // Id de documento de venta
                echo "OK";
            } else {
                echo "Error";
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }  

    }

	
    //////////////////////VENTAS/////////////////////////////////

    public function generarventa() {


        $numOrder = $this->uri->segment(3);

        //echo $numOrder;
        
        $this->data["NumOrder"]  = $numOrder;
        $this->data["DocOrder"]  = $this->pedidos_model->TraePedido($numOrder);
        $this->data["ListOrder"] = $this->pedidos_model->TraePedidoDetalle($numOrder);
        $this->data['motivos']   = $this->pedidos_model->get('traslados_motivo','','estado="1"','','');
        $this->data['empresa']   = $this->home_model->get('configuraciones','','','','');

         $this->data['documentos']  = $this->documentos_model->getDocumentos('documentos','','operacion="C"','','');

         //var_dump($this->data["DocOrder"]);

          /// Correlativo   
        $this->data['correlativos']  = $this->pedidos_model->getCorrelativo(3); //guia de remision
        $correlativo = $this->data['correlativos'];
        $this->data['serienumero'] = $correlativo->serie;
        $this->data['correlativo'] = generarCodigo($correlativo->numero, 6);
 


        $this->data['menuPedidos'] = 'Pedidos';
        $this->data['menuVentas'] = 'Ventas';   

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/ventasRegistrar';
        $this->load->view('layout/template',  $this->data);

    }

    public function registerVenta() {


        $numOrder = $this->uri->segment(3);

        $this->load->library('form_validation');
      //  $this->data['custom_error'] = '';

        $this->form_validation->set_rules('cboTipoComp', 'Tipo Comprobante', 'trim|required');  

        if ($this->form_validation->run() == false) {
            //$this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
            echo "Falta";
        } else {
            $idcomp = $this->input->post('cboTipoComp');
            $data = array(
                //'id_pedido' => $numOrder,
                'id_pedido' => $this->input->post('txtId'),
                'id_tipocomprobante' => $idcomp,
                'serie_comprobante' => $this->input->post('txtSerie'),
                'num_comprobante' => $this->input->post('txtNumComp'),
                'tipo_pago' => $this->input->post('tipopago'),                
                'id_usuario'   => $this->session->userdata('id')                  
            );

            // var_dump($data);
            if ($this->pedidos_model->add('ventas', $data) == TRUE) {               
                $this->pedidos_model->UpdateNumeroDoc($idcomp); // Id de documento de venta
                echo "OK";
            } else {
                echo "Error";
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }  

    }

    //////////////////////////////////////////////////////



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



    public function getPedidoCorrelativo(){
        $options = "";
        if($this->input->post('idtipopedido')){
            $idtipopedido = $this->input->post('idtipopedido');   
            $this->data['correlativos']  = $this->pedidos_model->get('correlativos','',$where='id_tipopedido="'.$idtipopedido.'"','','');
            var_dump($this->data['correlativos']);

            ///////////////////////////////////////////////////////////
            $correlativo = $this->data['correlativos'];
                   
              echo '<input id="txtNumero" type="text" class="form-control" required="" maxlength="50" name="txtNumero" autofocus="" value="'.$correlativo->cantidad.'">';   


        }
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


    public function generarDocVentaFpdf(){
    
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
                    $this->load->view('ventas/pedidos/facturaFPDF',$this->data);  
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


    public function generarDocVentaExcel(){
    
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
                    $this->load->view('ventas/pedidos/facturaPHPExcell',$this->data);  

                 /*

                    //Asumiendo que ya hayamos solicitado la libreria iniciamos la primera hoja
                    $this->excel->setActiveSheetIndex(0);

                    //Le colocamos el nombre a la primera hoja o pestaña
                    $this->excel->getActiveSheet()->setTitle('Hola de Prueba');

                    //Ingresamo el X's texto en la celda A1
                    $this->excel->getActiveSheet()->setCellValue('A1', 'Este es mi gran texto...');

                    //Cambiamos el tamaño de letra para la Celda A1
                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);

                    //Le colocamos negrilla a la Celda A1
                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

                    //Unimos las Celdas desde la A1 hasta la D1
                    $this->excel->getActiveSheet()->mergeCells('A1:D1');

                    //Alineamos en el centro las celdas
                    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    //Aca le asignamos el nombre al archivo
                    $filename='docVenta.xls';

                    //Seteamos el mime
                    header('Content-Type: application/vnd.ms-excel');

                    //Le enviamos al navegador el nombre del archivo para su respectiva descarga
                    header('Content-Disposition: attachment;filename="'.$filename.'"');

                    //Le indicamos que no deje en cache nada
                    header('Cache-Control: max-age=0');
                                
                    //Se genera la mágia, y se construye TODO
                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  

                    //forzamos la entrega del archivo a nuestro navegador (Descarga pes...)
                    //$objWriter->save('php://output');
                    $objWriter->save('docVenta.xls');

                    */



                        /*

                    $this->excel->setActiveSheetIndex(0);
                      //name the worksheet
                      $this->excel->getActiveSheet()->setTitle('Informe');
                      //set cell A1 content with some text
                      $this->excel->getActiveSheet()->setCellValue('A1','Celda1');
                      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(10);
                      
                      $filename="nombre.xls"; //save our workbook as this file name
                      header('Content-Type: application/vnd.ms-excel'); //mime type
                      header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                      header('Cache-Control: max-age=0'); //no cache


                      */
                    
/*


                          // configuramos las propiedades del documento
                    $this->phpexcel->getProperties()->setCreator("Arkos Noem Arenom")
                                     ->setLastModifiedBy("Arkos Noem Arenom")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");
         
         
                                        // agregamos información a las celdas
                                        $this->phpexcel->setActiveSheetIndex(0)
                                                    ->setCellValue('A1', 'Hello')
                                                    ->setCellValue('B2', 'world!')
                                                    ->setCellValue('C1', 'Hello')
                                                    ->setCellValue('D2', 'world!');
                                         
                                        // La librería puede manejar la codificación de caracteres UTF-8
                                        $this->phpexcel->setActiveSheetIndex(0)
                                                    ->setCellValue('A4', 'Miscellaneous glyphs')
                                                    ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
                                         
                                        // Renombramos la hoja de trabajo
                                        $this->phpexcel->getActiveSheet()->setTitle('Simple');
                                         
                                         
                                        // configuramos el documento para que la hoja
                                        // de trabajo número 0 sera la primera en mostrarse
                                        // al abrir el documento
                                        $this->phpexcel->setActiveSheetIndex(0);
                                         
                                         
                                        // redireccionamos la salida al navegador del cliente (Excel2007)
                                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                                        header('Content-Disposition: attachment;filename="docVenta.xlsx"');
                                        header('Cache-Control: max-age=0');
                                         
                                        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
                                        //$objWriter->save('php://output');
                                        $objWriter->save('docVenta.xlsx');

                                        
                                                */
                                                  


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

    //////////////////////////////// CARRO DE COMPRA /////////////////////////
    public function carro() {

   
        $this->data['documentos']  = $this->documentos_model->getDocumentos('documentos_tipo','','operacion="C"','','');
        $this->data['pedidostipo'] = $this->pedidos_model->get('pedidos_tipo','','estado="1"','','');
        //var_dump($this->data['documentos']);  
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/pedidosCarro';
        $this->load->view('layout/template',  $this->data);

    }

    public function add()
    {
              // Set array for send data.
   
       $insert_data = array(
            'id' => $this->input->post('codigoproducto'),
            'name' => $this->input->post('descripcion'),
            //'costo' => $this->input->post('costo'),
            //'stock' => $this->input->post('existencia'),
            'price' => $this->input->post('precioventa'),
            'qty' => 1
        ); 
       

 
      /*
        $insert_data = array(
            'id' => '6786867',
            'name' => 'escripcion',
            'price' => '5',
            'qty' => 100
        ); 
        */
      
       // print_r($insert_data);  

         // This function add items into cart.
        $this->cart->insert($insert_data);
          
                // This will show insert data in cart.
       // redirect('pedidos/carro');


    /*   $cart = $this->cart->contents();
        echo '<pre>';
        echo print_r($cart);
        echo '</pre>';*/

    }

    function remove($rowid) {
                    // Check rowid value.
        if ($rowid==="all"){
                       // Destroy data which store in  session.
            $this->cart->destroy();
        }else{
                    // Destroy selected rowid in session.
            $data = array(
                'rowid'   => $rowid,
                'qty'     => 0
            );
                     // Update cart data, after cancle.
            $this->cart->update($data);
        }
        
                 // This will show cancle data in cart.
        //redirect('shopping');
    }

    public function updateOrden() {
        if(!$this->permission->checkPermission($this->session->userdata('permiso'),'aCliente')){
           $this->session->set_flashdata('error','No tiene permiso para agregar clientes.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

       
            $this->form_validation->set_rules('BuscarCliente', 'Nombre', 'trim|required|xss_clean');     
        
        if ($this->form_validation->run() == false) {   
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else { 
                    $idorder = $this->input->post('txtIdOrden');      
                    $data = array(                          
                                'id_cliente' => $this->input->post('txtIdCliente'),
                                'fech_act' => date('Y-m-d H:m:i')                         
                    );
                                                
                    if ($this->pedidos_model->edit('pedidos', $data,'id',$idorder) == TRUE) {      
                         echo "Ok";                                       
                    } else {                           
                         echo "Error";
                    }
                   
        }//fin else

    }
	
	    // 2,4,5
    public function notificacionesPedido(){  
       // $idemp   = $this->session->userdata('id_empleado');
       // $idtipo  = $this->session->userdata('id_tipo');

        $fechActual = date("Y-m-d"); 
        $fechaFin   = date("Y-m-d",strtotime($fechActual."- 1 days")); 
        $dia        = date("d", strtotime($fechaFin));
        $fechaIni   = date("Y-m-d",strtotime($fechActual."- $dia days"));
		
		$menosUnMeses = date ('Y-m-d', strtotime ('- 1 month', strtotime($fechaIni)));
		
		//1:pendiente  --- 2:Procesado  --- 3: Anulado
		$this->data['notificacion'] = $this->pedidos_model->getNotificacionesPedido('1','total'); 		
      
		//$this->data['notificacion'] = $this->pedidos_model->getNotificacionesJustificar($idtipo,$idemp,$menosUnMeses,$fechaFin); 		
        //var_dump($this->data['notificacion']);    
        $registro   = $this->data['notificacion'];
        $cantidad   = $registro[0]->cantidad;   

        $jsondata = array();
        if($cantidad!=NULL){          
            $jsondata['respuesta'] = 'OK';
            $jsondata['cantidad'] = $cantidad;                      
        }else{         
            $jsondata['respuesta'] = 'ERROR';
            $jsondata['cantidad'] = '0';      
        }
        echo json_encode($jsondata); 
    }
	
	public function notificacionesPedidoLista(){   
  


        $fechActual = date("Y-m-d"); 
        $fechaFin   = date("Y-m-d",strtotime($fechActual."- 1 days")); 
        $dia        = date("d", strtotime($fechaFin));
        $fechaIni   = date("Y-m-d",strtotime($fechActual."- $dia days"));
		
		$menosUnMeses = date ('Y-m-d', strtotime ('- 1 month', strtotime($fechaIni)));

		$this->data['notificaciones'] = $this->pedidos_model->getNotificacionesPedido('1','lista'); 
        $registros   = $this->data['notificaciones'];    
   
        foreach($registros as $fila){        
          
			$fechaIni = $fila->fech_reg;
			$url_img  = $fila->url_imagen;              
			if($url_img){
				  $imagen='uploads/users/'.$url_img;
				  $image = base_url($imagen);
			}else{                    
				  $imagen='assets/images/avatars/avatar.png';
				  $image = base_url($imagen);
			}
    
			$date1 =  new DateTime();//$fechaActual;
			$date2 =  new DateTime($fechaIni);
			$diff  =  $date1->diff($date2);

			$nombres    = mb_strtoupper($fila->nombres,'utf-8');
			$nombre     = explode(" ", $nombres);
			$apellidos  = mb_strtoupper($fila->apellidos,'utf-8');
			$cliente    = $nombre[0].' '.$apellidos;

			$codigo     = base64_encode($fila->id.'-'.$fila->id_cliente);
        
        ?>		
			<li>
			  <a href="<?php echo base_url('pedidos/visualizar/'.$fila->id); ?>" class="clearfix">
				<img src="<?php echo $image;?>" class="msg-photo" alt="<?php echo $nombres;?>" />
				<span class="msg-body">
				  <span class="msg-title">
					<span class="blue"><?php echo $cliente;?></span>
					<!--
					Ciao sociis natoque penatibus et auctor ...-->
				  </span>

				  <span class="msg-time">
					<i class="ace-icon fa fa-clock-o"></i>
					<span><?php echo get_format_date($diff);?></span>
				  </span>
				</span>
			  </a>
			</li>               
        <?php
       }        
    }
	



    




}
