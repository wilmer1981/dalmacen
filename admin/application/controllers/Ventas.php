<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

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
		
        $this->data['menuVenta'] = 'Venta';
        $this->data['menuVentas'] = 'Ventas';    
       
    }

	public function index() {   
	

       // $user_id= $this->session->userdata('id');   
        
        $this->data['pedidos'] = $this->pedidos_model->getPedidos('','','','','');

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'ventas/ventas/ventas';  
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
		
		$this->data['documentos']  = $this->documentos_model->getDocumentos('documentos_tipo','','operacion="C"','','');
        $this->data['pedidostipo'] = $this->pedidos_model->get('pedidos_tipo','','estado="1"','','');
		//var_dump($this->data['documentos']);
 
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
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/pedidosEditar';
        $this->load->view('layout/template',  $this->data);

    }

    public function visualizar() {

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
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'ventas/pedidos/pedidosVisualizar';
        $this->load->view('layout/template',  $this->data);

    }



	public function lista() {
      // $this->lista();
		$config['base_url'] = base_url().'empleados/gerenciar/';
       // $config['total_rows'] = $this->clientes_model->count('customers');
        $total_c1 = $this->empleados_model->count('empleados');
  
        $config['total_rows'] = $total_c1;
        $config['per_page'] = 10;
        if($this->uri->segment(3)){
            $config['per_star'] = $this->uri->segment(3);
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
        //$config['first_link'] = '&laquo;'; 
        $config['first_link'] = 'Primera';
        //$config['prev_link'] = '‹'; 
        $config['prev_link'] = 'Anterior';
        //$config['last_link'] = '&raquo;'; 
        $config['last_link'] = '&Uacute;ltima';
        //$config['next_link'] = '›'; 
        $config['next_link'] = 'Pr&oacute;xima';
        $config['first_tag_open'] = '<li>'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li>'; 
        $config['last_tag_close'] = '</li>'; 

       // $user_id= $this->session->userdata('id');   
        
        $this->data['empleados'] = $this->empleados_model->getEmpleados('',$config['per_page'],$config['per_star']);
		      
        $this->load->view('mantenimiento/empleados/empleadosLista',  $this->data);
    
    }

     public function autoCompleteProductos(){
        
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->productos_model->autoCompleteProduto($q);
        }

    }

    public function autoCompleteProducto(){
        /*
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->productos_model->autoCompleteProduto($q);
        }*/

        $filtro    = $this->input->get("term");
        $productos = $this->productos_model->autoCompleteProducto($filtro);
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
                              
                    $donde     = -1;
                    for($i=0;$i<=count($carrito_orderventa)-1;$i ++){
                    if($codproducto==$carrito_orderventa[$i]['codproducto']){
                        $donde=$i;
                    }
                    }
                    if($donde != -1){
                        $cuanto=$carrito_orderventa[$donde]['cantidad'] + $cantidad;                
                        $carrito_orderventa[$donde]=array("codproducto"=>$codproducto,"precio"=>$precio,"cantidad"=>$cuanto,"descripcion"=>$descripcion);
                    }else{             
                        $carrito_orderventa[]=array("codproducto"=>$codproducto,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcion);                        
                    }
                }
        }else{
                $codproducto   = $CarritoNewVenta->CodProducto;
                $precio        = $CarritoNewVenta->Pventa;
                $cantidad      = $CarritoNewVenta->Cantidad;
                $descripcion   = $CarritoNewVenta->Descripcion;        
                $carrito_orderventa[]=array("codproducto"=>$codproducto,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcion); 
        }
        $_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession]=$carrito_orderventa;
        echo json_encode($_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession]);
    }

    public function saveOrder(){
        //session_start();
        //$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
         // $this->seguridad_model->SessionActivo($url);
        $arrayResponse = array("NumOrden"=>"0","Msg"=>"Error: Ocurrio Un Error Intente de Nuevo", "TipoMsg"=>"Error");

        $OrderVenta    = json_decode($this->input->post('MiCarrito'));
        $RecuperaOrder = $_SESSION["CarritoVenta".$OrderVenta->IdSession];
      
        $impuesto      = 18;

     

        $arrayPedido= array(
                "id_cliente"        =>$OrderVenta->IdCliente,
                "id_tipopedido"     =>$OrderVenta->TipoPedido,//"Pedido / Cotizacion",                
                "impuesto_base"     =>$impuesto,
                "impuesto_total"    =>$OrderVenta->IVA,
                "bruto"             =>$OrderVenta->Subtotal,
                "total"             =>$OrderVenta->Total,
                "id_usuario"           =>$this->session->userdata('id')
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
                    "descuento"         => 0                   
                    );

                # code...
                $this->pedidos_model->saveOrderDetalle($arrayDetalle);
               // if(){

                 //    $this->pedidos_model->UpdateExistenciasProducto($value["codproducto"],$value["cantidad"]);

                //}
               
                $this->pedidos_model->UpdateCorrelativo($OrderVenta->TipoPedido,$saveOrderPedido);
               


            }

              // $this->session->set_flashdata('success','Pedido guardado con éxito!');
               // redirect(base_url() . 'pedidos/adicionar');
           $arrayResponse = array("NumOrden"=>base64_encode($saveOrderPedido),"Msg"=>"<strong>Folio: ".$saveOrderPedido."</strong>, La Venta se Guardado Correctamente", "TipoMsg"=>"Sucefull");
        }
       echo json_encode($arrayResponse);
        
    }

    public function ImprimeVenta($numOrder){
        $numOrder         = base64_decode($numOrder);
        $data["NumOrder"] = $numOrder;
        $data["ListOrder"]= $this->pedidos_model->TraeVenta($numOrder);
        $data["DocOrder"] = $this->pedidos_model->TraeDoc($numOrder);
        $this->load->view('constant');
        $this->load->view('ventas/pedidos/view_print_venta',$data);
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




}
