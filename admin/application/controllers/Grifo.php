<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grifo extends CI_Controller {

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
   // private $db_grifo;
		
	public function __construct() {
        parent::__construct();
		
	
		
        if((!$this->session->userdata('logado'))){
            redirect('home/login');
        }
        /*if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('home/login');
        }*/

        $this->load->helper(array('sistema_helper','url'));
        $this->load->model('empleados_model','',TRUE);
        $this->load->model('usuarios_model','',TRUE);
		$this->load->model('documentos_model','',TRUE);
		$this->load->model('permisos_model','',TRUE);	
		$this->load->model('grifo_model','',TRUE);	
		
        $this->data['menuGrifo'] = 'Aplicacion Grifo';
       // $this->data['menuMantenimiento'] = 'Mantenimiento';  
	   
	   //nos conectamos a la base de datos grifo
	    $CI = &get_instance();
		//$this->db_grifo = $CI->load->database('grifo', true);
		$this->db_grifo = $this->load->database('grifo', true);
		//$this->db_grifo->load->model('grifo_model','',TRUE);
       
    }

	public function index() {   
	        
        $this->data['empleados'] = $this->grifo_model->getImportaciones('','','');
		//$this->data['empleados'] = $db_grifo->getImportaciones('','','');

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'grifo/grifo';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
	public function items() {  
	
	    $id = $this->uri->segment(3);
	        
        $this->data['empleados'] = $this->grifo_model->getImportacionesItems('i.id="'.$id.'"','','');

				
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'grifo/grifo_items';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
	public function items_detalle() {  
	
	    $id     = $this->input->post('id');
	        
        $this->data['factura'] = $this->grifo_model->getImportacionesItemsDetalle('d.id="'.$id.'"','','');
		//$this->data["pedidoitems"] = $this->pedidos_model->TraePedidoDetalle($id);
				
               // cargamos  la interfaz
    		
		//$this->data['itemsdetalle'] = $this->grifo_model->getImportacionesId('','','');
        $this->load->view('grifo/grifo_items_detalle',  $this->data);
    
    }


    public function adicionar() {
		$this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
			
			  //si no se ha seleccionado imagen
            if($_FILES['imagenUser']['error'] == UPLOAD_ERR_NO_FILE){ 
                $url_imagen  = '';                        
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('imagenUser')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                     $upload_data = $this->upload->data();
                     $url_imagen  = $upload_data['file_name'];
                }           
            }      
          
		  
            $data = array(
                'nombres' => set_value('txtNombre'),
                'apellidos' => set_value('txtApellidos'),
                'tipo_documento' => set_value('cboTipo_Documento'),
                'num_documento' => set_value('txtNum_Documento'),
                'telefono' => set_value('txtTelefono'),               
                'email' => set_value('txtEmail'),
                'direccion' => set_value('txtDireccion'),
                'fech_nac' => set_value('txtFecha_Nac'),
				//'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac')),
				'url_imagen' => $url_imagen                   
            );

            if ($this->empleados_model->add('empleados', $data) == TRUE) {				
								
				$empleado = $this->empleados_model->getByMaxId('empleados', 'id');
                $empleado_id=$empleado->id;

                $password = $this->input->post('txtPassword');  
				$password = $this->encrypt->sha1($password);
				$data = array(
					'id_empleado' => $empleado_id,
					'login' => set_value('txtLogin'),
					'password' => $password,
					'nivel' => set_value('cboIdTipo'),
					'permisos_id' => set_value('cboIdPermiso'),
					'estado' => '1'   
					  
				);

                $this->usuarios_model->add('usuarios', $data);
				
                $this->session->set_flashdata('success','Usuario agregado con éxito!');
                redirect(base_url() . 'usuarios/adicionar/');
			   
			   
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
		
		$this->data['documentos'] = $this->documentos_model->getDocumentos('documentos','','operacion="P"','','');
		//var_dump($this->data['documentos']);
	    $this->data['permisos']  = $this->permisos_model->getActive('permisos','permisos.idpermiso,permisos.nombre'); 
        $this->data['tipousers'] = $this->usuarios_model->getAllTipo('usuarios_tipo','usuarios_tipo.idtipo,usuarios_tipo.nombre'); 		
	
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'mantenimiento/empleados/empleadosAdicionar';
        $this->load->view('layout/template',  $this->data);

    }

    public function editar() {

         $id = $this->uri->segment(3);
		// echo "Id user: ".$id;
		$this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empleados') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
			$ruta=$this->input->post('txtRutaImg');
			// si no hay imagen seleccionada y existe la ruta           
			if ( ($_FILES['imagenUser']['error'] == UPLOAD_ERR_NO_FILE) && !empty($ruta)  ) {              
				  $url_imagen = $this->input->post('txtRutaImg');			
			// si no hay imagen seleccionada y no existe la ruta
            }else if ( ($_FILES['imagenUser']['error'] == UPLOAD_ERR_NO_FILE) && empty($ruta) ) { 
				 $url_imagen = '';  
			
            }else{ //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['max_size']      = "50000";
                $config['max_width']     = "3000";
                $config['max_height']    = "3000";
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('imagenUser')) {
                     //*** ocurrio un error
                    $this->data['custom_error'] = $this->upload->display_errors();            
                }else{
                     $upload_data = $this->upload->data();
                     $url_imagen  = $upload_data['file_name'];
                }           
            }   
			
            $data = array(
                'nombres' => set_value('txtNombre'),
                'apellidos' => set_value('txtApellidos'),
                'tipo_documento' => set_value('cboTipo_Documento'),
                'num_documento' => set_value('txtNum_Documento'),
                'telefono' => set_value('txtTelefono'),               
                'email' => set_value('txtEmail'),
                'direccion' => set_value('txtDireccion'),
               // 'fech_nac' => fentrada_mysql($this->input->post('txtFecha_Nac')),
				'fech_nac' => set_value('txtFecha_Nac'),
				'url_imagen' => $url_imagen ,
                'fech_act'=>date('Y-m-d H:m:s')       
            );

            if ($this->empleados_model->edit('empleados', $data,'id',$id) == TRUE) {
				
				    if($this->input->post('txtPassword')==""){
						 $data = array(					
							//'id_empleado' => $id,
							'login' => set_value('txtLogin'),         
							'nivel' => set_value('cboIdTipo'),
							'permisos_id' => set_value('cboIdPermiso'),
							'estado' => '1',
							'fech_act'=>date('Y-m-d H:m:s')
						);
					}else{

						$password = $this->input->post('txtPassword');  
						$password = $this->encrypt->sha1($password);
						$data = array(					
							//'id_empleado' => $id,
							'login' => set_value('txtLogin'),
							'password' => $password,
							'nivel' => set_value('cboIdTipo'),
							'permisos_id' => set_value('cboIdPermiso'),
							'estado' => '1',                
							'fech_act'=>date('Y-m-d H:m:s')  
						  
						);
					}
				$this->usuarios_model->edit('usuarios', $data,'id_empleado',$id); 
					   
			    $this->session->set_flashdata('success','Usuario editado con éxito!');
                redirect(base_url() . 'usuarios/editar/'.$id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
        
        $this->data['documentos'] = $this->documentos_model->getDocumentos('documentos','','operacion="P"','','');
        $this->data['empleados']  = $this->empleados_model->getEmpleados('e.id="'.$id.'"','','');
       // var_dump($this->data['empleados']);
	   
	    $this->data['permisos']  = $this->permisos_model->getActive('permisos','permisos.idpermiso,permisos.nombre'); 
        $this->data['tipousers'] = $this->usuarios_model->getAllTipo('usuarios_tipo','usuarios_tipo.idtipo,usuarios_tipo.nombre');   
        $this->data['usuarios']  = $this->usuarios_model->getUsers('u.id="'.$id.'"','','');  
 
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'mantenimiento/empleados/empleadosEditar';
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

        public function listas() {
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
              
        $this->load->view('mantenimiento/empleados/empleadosListas',  $this->data);
    
    }

        public function delete(){

           /* if(!$this->permission->checkPermission($this->session->userdata('permiso'),'dMarca')){
               $this->session->set_flashdata('error','No tiene permiso para eliminar Marcas.');
               redirect(base_url());
            }*/

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
	
	    //Importar desde Excel con libreria de PHPExcel
		 public function importarUpdateExcel(){
        //Cargar PHPExcel library
        $this->load->library('excel');
		$this->data['custom_error'] = '';

          //si no se ha seleccionado imagen
            if($_FILES['imagenProd']['error'] == UPLOAD_ERR_NO_FILE){  
                // $this->data['custom_error'] = $this->upload->display_errors(); 
                $result['valid'] = false;
                $result['message'] = 'Porfavor Carga un archivo Excell...';//$this->upload->                      
            }else{  //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "txt|xlsx|xls";
                $config['max_size']      = "80000";           
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('imagenProd')) {   
						
                   // $result['message'] = 'Porfavor revisar el archivo Excell'; 
					$result['message'] = $this->upload->display_errors(); 					
                    $result['valid'] = false;
                         
                }else{
                       $upload_data = $this->upload->data();
                       $tname  = $upload_data['file_name'];
           
                        $objPHPExcel = PHPExcel_IOFactory::load('uploads/'.$tname);    
                       // $sheetDatas   = $objPHPExcel->getActiveSheet(0);

                        /*try {
                            $objPHPExcel = PHPExcel_IOFactory::load('uploads/'.$tname);   
                        } catch (Exception $e) {
                            show_error($e->getMessage());
                        }*/
                        
                        $sheetData   = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                       // $result['valid'] = false;                 
                        //$result['message'] = $cant_update.' Productos actualizados...'.$cant_insert.' insertados...';

                        //consultamos productos para recorrer la lista
                       // $this->data['productos'] = $this->productos_model->get('productos','','','','');
                        //$productos=$this->data['productos'];
					$arrayData= array( 				
						"Descripcion"  =>$this->input->post('txtDescripcion'),//"Venta / Cotizacion",  
						"IdUsuario"   =>$this->session->userdata('id') 
					);
					$idImport = $this->grifo_model->saveImportacion('Grifo_Import',$arrayData);
					
					if($idImport!=0){  
                        $arr_datos = array();                                   

                        $cant_update= 0;
                        $cant_insert= 0;
                        
                        foreach ($sheetData as $index => $value) {            
                            if ( $index != 1 ){                           

                              // if($value['B']=='PZA') $unidad=3;
                               //if($value['B']=='MTS') $unidad=2;						   
									
							    $delimiter = ' ';
								$string1 = $value['A'];
								//$string = '24/02/2017  08:40:27 a.m.';
								//$result = explode ($delimiter, $string);

							    $datos 	= explode($delimiter, $string1);
								$fecha  = $datos[0];
								$hora   = $datos[1];
								//$hora   = $datos[2];a.m.
							   //var_dump($fecha);								
								//$oDate  = strtotime($fecha);
                               // $fecha1 = date("Y-m-d",$oDate);
								$fecha1 = fentrada_mysql($fecha);
								$oHora  = strtotime($hora);
                                $hora1  = date("H:i:s",$oHora);							
							 							
								$fechass      = $fecha1.' '.$hora1;
								
								//$dato2 		= $value['B'];
								$string2    = $value['B'];
								$fechas 	= explode($delimiter, $string2);
								$fecha      = $fechas[0];
								$hora       = $fechas[1];
								$fecha2     = fentrada_mysql($fecha);															
								$oHora      = strtotime($hora);
                                $hora2      = date("H:i:s",$oHora);	
						var_dump($fechass);								
								
							    //$fecha2 	= date('Y/m/d',strtotime($dato2));
								//$hora2  	= date('H:i:s',strtotime($dato2));
								//$fechaini  	= fentrada_mysql($fecha2);
								
								$fecha_ini	= $fecha2.' '.$hora2;	
						var_dump($fecha_ini);					
								$precio  =  substr($value['M'], 2);	
								$pdinero =  quitarComa(substr($value['P'], 2));	
								$dinero  =  quitarComa(substr($value['S'], 2));	
								$dd      =  substr($value['T'], 2);	
								$df      =  substr($value['U'], 2);	
								$td      =  quitarComa(substr($value['V'], 2));	
								$di      =  quitarComa(substr($value['W'], 2));	
								$ddi     =  substr($value['X'], 2);	
								$dfi     =  substr($value['Y'], 2);	
								$dti     =  quitarComa(substr($value['Z'], 2));

								$hran    =  quitarComa($value['AP']);
								$hrac    =  quitarComa($value['AQ']);								
								//var_dump(substr($value['P'],2));
								//var_dump(parseFloat(substr($value['P'], 2)));	
								//var_dump(tofloat(substr($value['P'], 2)));

								//var_dump(floatval(str_replace(',', '', str_replace('.', '', substr($value['P'], 2)))));
								//var_dump(floatval(str_replace(',', '', $value['AP'])));
				
                                         //date_format($date,"Y/m/d H:i:s")   
										//convert(datetime,'2017-02-24 08:59:48')										 
                                $arr_datos = array(	
								'Fecha'			=> $fechass, 
								'FechaInicial'	=> $fecha_ini,								
								//'Fecha'			=> date('Y-m-d H:i:s',$fechass), 
								//'FechaInicial'	=> date('Y-m-d H:i:s',$fecha_ini),
								//'Fecha'			=> convert(datetime,$fechass), 
								//'FechaInicial'	=> convert(datetime,$fecha_ini),
								'Duracion'		=> $value['C'],
								'TipoFactura'	=> $value['D'],
								'Factura'		=> $value['E'], 
								'Region'		=> $value['F'], 
								'Ciudad'		=> $value['G'], 
								'Estacion'		=> $value['H'],
								'Caja'			=> $value['I'],
								'Surtidor'		=> $value['J'],
								'Manguera'		=> $value['K'],
								'Producto'		=> $value['L'],
								'Precio'		=> $precio, 
								'Cantidad'		=> $value['N'], 
								'FormaDePago'	=> $value['O'],
								'PagoDinero'	=> $pdinero, 
								'Referencia1'	=> $value['Q'],
								'CantidadNeta'	=> $value['R'], 
								'Dinero'		=> $dinero, 
								'DineroDescuento'	=> $dd, 
								'DineroFinanciacion'=> $df, 
								'TotalDinero'	=> $td, 
								'DineroItem'	=> $di, 
								'DineroDescuentoItem'=> $ddi, 
								'DineroFinanciacionItem'=> $dfi, 
								'DineroTotalItem'=> $dti, 
								'NombreCliente1'=> $value['AA'],
								'DocumentoCliente1'=> $value['AB'], 
								'IdentificadorCliente1'=> $value['AC'], 
								'PuntosCliente1Item'=> $value['AD'], 
								'PuntosCliente1Total'=> $value['AE'], 
								'ProgramaCliente1'=> $value['AF'], 
								'NombreCliente2'=> $value['AG'],
								'DocumentoCliente2'=> $value['AH'], 
								'IdentificadorCliente2'=> $value['AI'],
								'PuntosCliente2Item'=> $value['AJ'], 
								'PuntosCliente2Total'=> $value['AK'], 
								'ProgramaCliente2'=> $value['AL'], 
								'NombreFlota'	=> $value['AM'], 
								'DocumentoFlota'=> $value['AN'], 
								'Placa'			=> $value['AO'], 
								//'hr_anterior'	=> quitarComa($value['AP']),
								//'hr_actual'		=> quitarComa($value['AQ']), 
								'hrAnterior'	=> $hran,
								'hrActual'		=> $hrac, 
								'Galhr'		    => $value['AR'], 
								'NombreVendedor'=> $value['AS'], 
								'DocumentoVendedor'=> $value['AT'], 
								'IdentificadorVendedor'=> $value['AU'], 
								'PUMPInfo1'		=> $value['AV'], 
								'PUMPInfo2'		=> $value['AW'],
								'PUMPInfo3'		=> $value['AX'], 
								'PUMPGPSLat'	=> $value['AY'], 
								'PUMPGPSLog'	=> $value['AZ'], 
								'PUMPGPSAlt'	=> $value['BA'], 
								'FrenteDeObra'	=> $value['BB'], 
								'Contrato'		=> $value['BC'], 
								'Destino'		=> $value['BD'], 
								'Chofer'		=> $value['BE'], 
								'PorDefinir01'	=> $value['BF'], 
								//'pordefinir_02'	=> $value['BG'], 
								//'pordefinir_03'	=> $value['BH'],
								'Id_Import'		=> $idImport, 								
								'Id_Usuario'	=> $this->session->userdata('id') 							                                                                       
                                );
                           
                                //$this->data['resultado'] = $this->productos_model->addProductoEdit($arr_datos);
								/*$this->data['resultado'] = $this->grifo->add('importacion',$arr_datos);								
                                $resultado=$this->data['resultado'];   
									if($resultado > 0){
										
                                        $cant_update++;  
                                    }else{
                                        $cant_insert++; 
                                    }*/
									
                                if ($this->grifo_model->add('Grifo_Surtidor01', $arr_datos) == TRUE) {                                
									$cant_insert++; 	                                        
                                }else{
                                    $cant_update++; 
									$result['valid'] = false; 
									$result['message'] = ' Error al Insertar a la Base de Datos';
 									
                                }
                                                                                                      
                            } 
                        }
                    $result['valid'] = true;                 
                    $result['message'] = $cant_update.' Errores...'.$cant_insert.' insertados...';
					}
                       //$this->output
                        //     ->set_content_type('application/json')
                        //     ->set_output(json_encode($result));       
                } 

               // $result['message'] = 'Otro error...';  
               // $result['valid'] = false;

            }     
          
          $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));    
    }
	
    public function importarUpdateExcelMYSQL(){
        //Cargar PHPExcel library
        $this->load->library('excel');
		$this->data['custom_error'] = '';

          //si no se ha seleccionado imagen
            if($_FILES['imagenProd']['error'] == UPLOAD_ERR_NO_FILE){  
                // $this->data['custom_error'] = $this->upload->display_errors(); 
                $result['valid'] = false;
                $result['message'] = 'Porfavor Carga un archivo Excell...';//$this->upload->                      
            }else{  //si se ha seleccionada                      
                $config['upload_path']   = "uploads/";
                $config['allowed_types'] = "txt|xlsx|xls";
                $config['max_size']      = "80000";           
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('imagenProd')) {   
						
                   // $result['message'] = 'Porfavor revisar el archivo Excell'; 
					$result['message'] = $this->upload->display_errors(); 					
                    $result['valid'] = false;
                         
                }else{
                       $upload_data = $this->upload->data();
                       $tname  = $upload_data['file_name'];
           
                        $objPHPExcel = PHPExcel_IOFactory::load('uploads/'.$tname);    
                       // $sheetDatas   = $objPHPExcel->getActiveSheet(0);

                        /*try {
                            $objPHPExcel = PHPExcel_IOFactory::load('uploads/'.$tname);   
                        } catch (Exception $e) {
                            show_error($e->getMessage());
                        }*/
                        
                        $sheetData   = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                       // $result['valid'] = false;                 
                        //$result['message'] = $cant_update.' Productos actualizados...'.$cant_insert.' insertados...';

                        //consultamos productos para recorrer la lista
                       // $this->data['productos'] = $this->productos_model->get('productos','','','','');
                        //$productos=$this->data['productos'];
					$arrayData= array( 				
						"descripcion"  =>$this->input->post('txtDescripcion'),//"Venta / Cotizacion",  
						"id_usuario"   =>$this->session->userdata('id') 
					);
					$idImport = $this->grifo_model->saveImportacion($arrayData);
					
					if($idImport!=0){  
                        $arr_datos = array();                                   

                        $cant_update= 0;
                        $cant_insert= 0;
                        
                        foreach ($sheetData as $index => $value) {            
                            if ( $index != 1 ){                           

                              // if($value['B']=='PZA') $unidad=3;
                               //if($value['B']=='MTS') $unidad=2;						   
									
							    $delimiter = ' ';
								$string1 = $value['A'];
								//$string = '24/02/2017  08:40:27 a.m.';
								//$result = explode ($delimiter, $string);

							    $datos 	= explode($delimiter, $string1);
								$fecha  = $datos[0];
								$hora   = $datos[1];
								//$hora   = $datos[2];a.m.
							   //var_dump($fecha);								
								//$oDate  = strtotime($fecha);
                               // $fecha1 = date("Y-m-d",$oDate);
								$fecha1     = fentrada_mysql($fecha);
								 //var_dump($fecha1);								
								$oHora  = strtotime($hora);
                                $hora1  = date("H:i:s",$oHora);							
							 							
								$fechass      = $fecha1.' '.$hora1;
								
								//$dato2 		= $value['B'];
								$string2    = $value['B'];
								$fechas 	= explode($delimiter, $string2);
								$fecha      = $fechas[0];
								$hora       = $fechas[1];
								$fecha2     = fentrada_mysql($fecha);															
								$oHora      = strtotime($hora);
                                $hora2      = date("H:i:s",$oHora);		
								
							    //$fecha2 	= date('Y/m/d',strtotime($dato2));
								//$hora2  	= date('H:i:s',strtotime($dato2));
								//$fechaini  	= fentrada_mysql($fecha2);
								
								$fecha_ini	= $fecha2.' '.$hora2;	
								
								$precio  =  substr($value['M'], 2);	
								$pdinero =  quitarComa(substr($value['P'], 2));	
								$dinero  =  quitarComa(substr($value['S'], 2));	
								$dd      =  substr($value['T'], 2);	
								$df      =  substr($value['U'], 2);	
								$td      =  quitarComa(substr($value['V'], 2));	
								$di      =  quitarComa(substr($value['W'], 2));	
								$ddi     =  substr($value['X'], 2);	
								$dfi     =  substr($value['Y'], 2);	
								$dti     =  quitarComa(substr($value['Z'], 2));

								$hran    =  quitarComa($value['AP']);
								$hrac    =  quitarComa($value['AQ']);								
//var_dump(substr($value['P'],2));
//var_dump(parseFloat(substr($value['P'], 2)));	
//var_dump(tofloat(substr($value['P'], 2)));

//var_dump(floatval(str_replace(',', '', str_replace('.', '', substr($value['P'], 2)))));
//var_dump(floatval(str_replace(',', '', $value['AP'])));

						
                                                                 
                                $arr_datos = array(
								'id_import'		=> $idImport, 
								'fecha'			=> $fechass, 
								'fecha_inicial'	=> $fecha_ini,
								'duracion'		=> $value['C'],
								'tipo_factura'	=> $value['D'],
								'factura'		=> $value['E'], 
								'region'		=> $value['F'], 
								'ciudad'		=> $value['G'], 
								'estacion'		=> $value['H'],
								'caja'			=> $value['I'],
								'surtidor'		=> $value['J'],
								'manguera'		=> $value['K'],
								'producto'		=> $value['L'],
								'precio'		=> $precio, 
								'cantidad'		=> $value['N'], 
								'forma_pago'	=> $value['O'],
								'pago_dinero'	=> $pdinero, 
								'referencia1'	=> $value['Q'],
								'cantidad_neta'	=> $value['R'], 
								'dinero'		=> $dinero, 
								'dinero_dscto'	=> $dd, 
								'dinero_financiacion'=> $df, 
								'total_dinero'	=> $td, 
								'dinero_item'	=> $di, 
								'dinero_dscto_item'=> $ddi, 
								'dinero_financiacion_item'=> $dfi, 
								'dinero_total_item'=> $dti, 
								'nombre_cliente_1'=> $value['AA'],
								'documento_cliente_1'=> $value['AB'], 
								'identificador_cliente_1'=> $value['AC'], 
								'puntos_cliente_1_item'=> $value['AD'], 
								'puntos_cliente_1_total'=> $value['AE'], 
								'programa_cliente_1'=> $value['AF'], 
								'nombre_cliente_2'=> $value['AG'],
								'documento_cliente_2'=> $value['AH'], 
								'identificador_cliente_2'=> $value['AI'],
								'puntos_cliente_2_item'=> $value['AJ'], 
								'puntos_cliente_2_total'=> $value['AK'], 
								'programa_cliente_2'=> $value['AL'], 
								'nombre_flota'	=> $value['AM'], 
								'documento_flota'=> $value['AN'], 
								'placa'			=> $value['AO'], 
								//'hr_anterior'	=> quitarComa($value['AP']),
								//'hr_actual'		=> quitarComa($value['AQ']), 
								'hr_anterior'	=> $hran,
								'hr_actual'		=> $hrac, 
								'gal_hr'		=> $value['AR'], 
								'nombre_vendedor'=> $value['AS'], 
								'documento_vendedor'=> $value['AT'], 
								'identificador_vendedor'=> $value['AU'], 
								'pump_Info_1'	=> $value['AV'], 
								'pump_Info_2'	=> $value['AW'],
								'pump_Info_3'	=> $value['AX'], 
								'pump_gps_lat'	=> $value['AY'], 
								'pump_gps_log'	=> $value['AZ'], 
								'pump_gps_alt'	=> $value['BA'], 
								'frente_obra'	=> $value['BB'], 
								'contrato'		=> $value['BC'], 
								'destino'		=> $value['BD'], 
								'chofer'		=> $value['BE'], 
								'pordefinir_01'	=> $value['BF'], 
								'pordefinir_02'	=> $value['BG'], 
								'pordefinir_03'	=> $value['BH'], 							
								'id_usuario'	=> $this->session->userdata('id') 							                                                                       
                                );
                           
                                //$this->data['resultado'] = $this->productos_model->addProductoEdit($arr_datos);
								/*$this->data['resultado'] = $this->grifo->add('importacion',$arr_datos);								
                                $resultado=$this->data['resultado'];   
									if($resultado > 0){
										
                                        $cant_update++;  
                                    }else{
                                        $cant_insert++; 
                                    }*/
									
                                if ($this->grifo_model->add('importacion_detalle', $arr_datos) == TRUE) {                                
									$cant_insert++; 	                                        
                                }else{
                                    $cant_update++; 
									$result['valid'] = false; 
									$result['message'] = ' Error al Insertar a la Base de Datos';
 									
                                }
                                                                                                      
                            } 
                        }
                    $result['valid'] = true;                 
                    $result['message'] = $cant_update.' Errores...'.$cant_insert.' insertados...';
					}
                       //$this->output
                        //     ->set_content_type('application/json')
                        //     ->set_output(json_encode($result));       
                } 

               // $result['message'] = 'Otro error...';  
               // $result['valid'] = false;

            }     
          
          $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));    
    }



}
