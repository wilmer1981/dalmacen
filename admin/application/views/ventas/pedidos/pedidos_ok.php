<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Gestion de Pedidos</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	  <div class="botones">       
        <a href="<?php echo base_url('pedidos/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Nuevo</a> 
        <!--
         <a href="<?php //echo base_url('pedidos/carro')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Nueva Venta</a> 
        -->

    </div>
  
    <div class="box-body">   
      <div class="nav-tabs-custom">       
        <ul class="nav nav-tabs pull-right">
		    <?php 
			  if($this->permission->checkPermission($this->session->userdata('permiso'),'vVenta')){
			?>
			<li><a href="#cotizacion-chart" data-toggle="tab">Cotizaciones/Proformas</a></li>
			  <?php } ?>
          <!--
		  <li><a href="#revenue-chart" data-toggle="tab">Ordenes Compra</a></li>
		  -->
          <li class="active"><a href="#ventas-chart" data-toggle="tab">Ventas</a></li>
          <li class="pull-left header"><i class="fa fa-inbox"></i> </li>
        </ul>
        <div class="tab-content no-padding">    
          <div class="chart tab-pane" id="cotizacion-chart" style="position: relative;">
                <div id="VerOrden" class="table-responsive">              
                         <table id="" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>                                
                                    <th>TipoPedido</th>
                                    <th>Documento</th>
                                    <th>TipoDoc</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($proformas as $r){

                                  if($r->estado==1){
                                    $estado="<span class='label label-success'>PROCESADO</span>";
                                  }else{
                                    $estado="<span class='label label-warning'>ANULADO</span>";
                                  }

                                  echo '<tr>';
                                  echo '<td>'.$r->id.'</td>';
                                  echo '<td>'.$r->codigo." - ".$r->cliente.'</td>';
                                  echo '<td>'.$r->tipopedido.'</td>';
                                  echo '<td>['.$r->serie_comprobante." - ".$r->num_pedido.']['.$r->comprobante.']</td>';
                                  echo '<td>'.$r->id_tipocomprobante.'</td>';
                                  echo '<td>$ '.number_format($r->total,2).'</td>';
                                  echo '<td>'.$estado.'</td>';
                                  echo '<td>';
                                   
                                   if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                      echo '<a href="'.base_url().'pedidos/visualizarproforma/'.$r->id.'" class="btn btn-default btn-xs btn-round" title="Ver detalle" data-id="'.$r->id.'"><i class="glyphicon glyphicon-eye-open"></i></a>';                           
                                    }                          

                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                      echo '<a class="btn btn-primary btn-xs btn-round btn-imprimir-b" title="Imprimir Boleta" data-id="'.$r->id.'"><i class="glyphicon glyphicon-print"></i></a>';                                      
                                    }
                    
                                   /* if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                      echo'<a class="btn btn-danger btn-xs btn-round btn_export_id" data-id="'.$r->id.'" data-tipo="'.$r->id_tipocomprobante.'" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';    

                                       echo'<a class="btn btn-danger btn-xs btn-round btn_export_idex" data-id="'.$r->id.'" data-tipo="'.$r->id_tipocomprobante.'" ><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>';   

                                                               //si la venta es PROFORMA
                                            if(!$r->idventa && ($r->id_tipocomprobante==9 || $r->id_tipocomprobante==10) ){                                       
                                                echo '<a href="'.base_url().'pedidos/generarventa/'.$r->id.'" class="btn btn-warning btn-xs btn-round" title="Generar Factura" data-id="'.$r->id.'"><i class="fa fa-money" aria-hidden="true"></i></a>'; 
                                            }
                                          
                            

                                    }*/
                          
                                  echo '</td>';
                                  echo '</tr>';
                                }
                                ?>                           
                            </tbody>
                        </table>  
                </div> 
            
          </div>      
          <div class="chart tab-pane" id="revenue-chart" style="position: relative;">
                <div id="VerOrden" class="table-responsive">              
                         <table id="" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>                                
                                    <th>TipoPedido</th>
                                    <th>Documento</th>
                                    <th>TipoDoc</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($pedidos as $r){   

                                 if($r->estado==1){
                                    $estado="<span class='label label-success'>PROCESADO</span>";
                                  }else{
                                    $estado="<span class='label label-warning'>ANULADO</span>";
                                  }

                                           
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->codigo." - ".$r->cliente.'</td>';
                                    echo '<td>'.$r->tipopedido.'</td>';
                                    echo '<td>['.$r->serie_comprobante." - ".$r->num_pedido.']['.$r->comprobante.']</td>';
                                    echo '<td>'.$r->id_tipocomprobante.'</td>';
                                    echo '<td>$ '.number_format($r->total,2).'</td>';
                                    echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                                   
                                   if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                      echo '<a href="'.base_url().'pedidos/visualizarorden/'.$r->id.'" class="btn btn-default btn-xs btn-round" title="Ver detalle" data-id="'.$r->id.'"><i class="glyphicon glyphicon-eye-open"></i></a>';                                 
                                    }                          

                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                      echo '<a class="btn btn-primary btn-xs btn-round btn-imprimir-b" title="Imprimir Boleta" data-id="'.$r->id.'"><i class="glyphicon glyphicon-print"></i></a>';                         
                                    
                                    }
                    
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                      echo'<a class="btn btn-danger btn-xs btn-round btn_export_id" data-id="'.$r->id.'" data-tipo="'.$r->id_tipocomprobante.'" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';   

                                       echo'<a class="btn btn-danger btn-xs btn-round btn_export_idex" data-id="'.$r->id.'" data-tipo="'.$r->id_tipocomprobante.'" ><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>';                            
                                                               //si la venta es PROFORMA
                                            if(!$r->idventa && ($r->id_tipocomprobante==9 || $r->id_tipocomprobante==10) ){                                       
                                                echo '<a href="'.base_url().'pedidos/generarventa/'.$r->id.'" class="btn btn-warning btn-xs btn-round" title="Generar Factura" data-id="'.$r->id.'"><i class="fa fa-money" aria-hidden="true"></i></a>'; 
                                            }
                                               //si la venta es PROFORMA
                                           /* if($r->idventa && ($r->id_tipocomprobante==9 || $r->id_tipocomprobante==10) ){                                       
                                                echo '<a href="'.base_url().'pedidos/verventa/'.$r->id.'" class="btn btn-success btn-xs btn-round" title="Detalle Factura" data-id="'.$r->id.'"><i class="fa fa-money" aria-hidden="true"></i></a>'; 
                                             }*/


                                    }
                          
                                  echo '</td>';
                                  echo '</tr>';
                                }
                                ?>                           
                            </tbody>
                        </table>  
                </div> 
            
          </div>
		  <!--
		  
          <div class="chart tab-pane active" id="ventas-chart" style="position: relative;"> 

		  
                <div id="VerListado" class="table-responsive">
                    <table id="" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>  
									<!--									
                                    <th>TipoPedido</th>
									-->
                                    <th>Documento</th>
                                    <th>TipoDoc</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ventas as $r) {   

                                 if($r->estadoventa==1){
                                   
									$estado="<span class='label label-warning'>PENDIENTE</span>";
                                  }else{
                                     $estado="<span class='label label-success'>PAGADO</span>";
                                  }

                                           
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->codigo." - ".$r->cliente.'</td>';
                                   // echo '<td>'.$r->tipopedido.'</td>';
                                    echo '<td>['.$r->seriefact." - ".$r->numfact.']['.$r->comprobante.']</td>';
                                    echo '<td>'.$r->idtipocomp.'</td>';
                                    echo '<td>$ '.number_format($r->total,2).'</td>';
                                    echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                                   
                                   if($this->permission->checkPermission($this->session->userdata('permiso'),'vVenta') ||
									   $this->permission->checkPermission($this->session->userdata('permiso'),'vPago')){
                                      echo '<a href="'.base_url().'pedidos/visualizar/'.$r->id.'" class="btn btn-default btn-xs btn-round" title="Ver detalle" data-id="'.$r->id.'"><i class="glyphicon glyphicon-eye-open"></i></a>';                                 
                                    }
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'vPago')){
                                      //echo '<a class="btn btn-primary btn-xs btn-round btn-imprimir" title="Imprimir" data-id="'.$r->id.'"><i class="glyphicon glyphicon-print"></i></a>';                                                   
                                    }

                                     if($this->permission->checkPermission($this->session->userdata('permiso'),'vPago')){
                                     // echo '<a class="btn btn-primary btn-xs btn-round btn-imprimir-b" title="Imprimir Boleta" data-id="'.$r->id.'"><i class="glyphicon glyphicon-print"></i></a>';                         
                                    
                                    }
                    
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'vPago')){
          
                                      // echo'<a class="btn btn-success btn-xs btn-round btn_export_idex" data-id="'.$r->id.'" data-tipo="'.$r->idtipocomp.'" ><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>';  

                                      
									  // echo'TXT<a class="btn btn-success btn-xs btn-round btn_export_txt" data-id="'.$r->id.'" data-tipo="'.$r->idtipocomp.'" ><i class="fa fa-file-text" aria-hidden="true"></i></a>';   

                                       // si la venta es con Factura y la Guia de Remision no existe
                                     /*if(!$r->idtraslado && $r->idtipocomp==2 ){                                                                 
                                        echo '<a href="'.base_url().'pedidos/generarguia/'.$r->id.'" class="btn btn-warning btn-xs btn-round" title="Generar Guia" data-id="'.$r->id.'"><i class="glyphicon glyphicon-send"></i></a>'; 
                                     }
                                    // si la venta es con Factura y la Guia de Remision Existe
                                    if($r->idtraslado && $r->idtipocomp==2 ){                                                                 
                                        echo '<a href="'.base_url().'pedidos/verguia/'.$r->id.'" class="btn btn-success btn-xs btn-round" title="Detalle Guia" data-id="'.$r->id.'"><i class="glyphicon glyphicon-send"></i></a>'; 
                                     }*/
                                      //si la venta es PROFORMA
                                      if($r->idtipocomp==10 ){                                                                 
                                        echo '<a href="'.base_url().'pedidos/generarventa/'.$r->id.'" class="btn btn-warning btn-xs btn-round" title="Generar Factura" data-id="'.$r->id.'"><i class="fa fa-money" aria-hidden="true"></i></a>'; 
                                     }
									 // si la venta no se ha pago
									if(($r->idtipocomp==2 || $r->idtipocomp==1) && $r->estadoventa==1){                                                                 
                                        echo '<a href="'.base_url().'pedidos/guardarpago/'.$r->id.'" class="btn btn-warning btn-xs btn-round" title="Registrar Pago" data-id="'.$r->id.'"><i class="fa fa-money" aria-hidden="true"></i></a>'; 
                                    }
									if(($r->idtipocomp==2 || $r->idtipocomp==1) && $r->estadoventa==2){                                                                 
                                        //echo '<a href="'.base_url().'pedidos/guardarpago/'.$r->id.'" class="btn btn-warning btn-xs btn-round" title="Registrar Pago" data-id="'.$r->id.'"><i class="fa fa-money" aria-hidden="true"></i></a>'; 
										echo '<a class="btn btn-primary btn-xs btn-round btn-imprimir-b" title="Imprimir Boleta" data-id="'.$r->id.'"><i class="glyphicon glyphicon-print"></i></a>';  
                                    }
									 
											 


                                    }
                            
                                echo '</td>';
                                   echo '</tr>';
                                }
                                ?>
                         
                            </tbody>
                  </table>  
                </div> 
          </div>
		  -->
        </div>
      </div>    

                 
          
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                  <!--
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">United States of America
                      <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                    <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                    </li>
                    <li><a href="#">China
                      <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                  </ul>
                  -->
                </div>
                <!-- /.footer -->
    </div>


