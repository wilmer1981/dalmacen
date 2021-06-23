<?php
  $numOrder = $this->uri->segment(3);
?>
<div class="box box-default">

  <div class="box-header with-border">
    <h3 class="box-title"><span class="icon"><i class="fa fa-plus-square" aria-hidden="true"></i> REGISTRO DE PAGO</span></h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
 
    <form role="form" name="formVenta" id="formVenta" method="post" >


<!--
    <form role="form" action="<?php echo current_url(); ?>" name="formGuia" id="formGuia" method="post" >
    -->
    
  <input type="hidden" name="txtNumOrden" id="txtNumOrden" class="form-control input-sm" value="<?php echo $numOrder;?>">
            
  <div class="box-body">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-success">
                <div class="box-header with-border">
                  <!--<i class="fa fa-calendar"></i>-->
                  <h3 class="box-title">Informacion de Venta</h3>            
                  <div class="pull-right box-tools">       
              
                    <button type="button" class="btn btn-box-tool btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>             
                  </div>
             
                </div>
             
                <div class="box-body">
                  <div class="row">             
                      <div class="col-md-12">
                         <table class="table table-bordered">                    
                          <tbody>
						  <!--
                             <tr>
                              <th scope="row" class="active"># ORD.COMPRA</th>
                              <td><?php echo $DocOrder[0]->serie_comprobante.' - '.$DocOrder[0]->num_pedido; ?></td>
                              <th scope="row" class="active">TIPO PAGO</th>
                              <td><?php echo $DocOrder[0]->tipo_pago; ?></td>                              
                            </tr>
							-->
                            <tr>
                              <th scope="row" class="active">CLIENTE</th>
                              <td><?php echo $DocOrder[0]->cliente; ?>
							  <!--
                              <button type="button" class="btn btn-warning" id="btnBuscarCli" title="Cambiar Cliente" data-toggle="modal" data-target="#modal_form_register" data-name="<?php echo $DocOrder[0]->cliente; ?>" data-numero="<?php echo $DocOrder[0]->serie_comprobante.' - '.$DocOrder[0]->num_pedido; ?>" data-id="<?php echo $DocOrder[0]->id; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button> 
-->							  
                              </td>
                              <th scope="row" class="active">TIPO PAGO</th>
                              <td><?php echo $DocOrder[0]->tipo_pago; ?></td>
                            </tr>
                            <tr>
                              <th scope="row" class="active">NUM. DOCUMENTO</th>
                              <td><?php echo $DocOrder[0]->num_documento; ?></td>
                              <th scope="row" class="active">FECHA VENTA</th>
                              <td><?php echo $DocOrder[0]->fech_reg; ?></td>
                            </tr>
                            <tr>
                              <th scope="row" class="active">DIRECCION</th>
                              <td><?php echo $DocOrder[0]->direccion; ?></td>
                              <th scope="row"></th>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>          
                      </div>
                  </div>
             

                </div>
                       <div class="row">
                    <div class="col-md-12">
                      <table class="table">
                       <thead class="active">
                          <th>CANT.</th>
                          <th>DESCRIPCION</th>                                
                          <th>P.UNIT.</th>    
                          <th>P.DCTO.</th>                     
                          <th>IMPORTE</th>                
                        </thead>                                
                        <tbody>
                            <?php 
                            $subtotal=0;
                            foreach ($ListOrder as $r) {   
                                $precio_dscto = number_format($r->precio_venta * $r->descuento,2);
                                $importe      = $r->cantidad * $precio_dscto;
                                
                              echo '<tr>';
                              echo '<td>'.$r->cantidad.'</td>';
                              echo '<td>'.$r->descripcion.'</td>';                               
                              echo '<td>'.$r->precio_venta.'</td>';             
                              echo '<td>'.number_format($precio_dscto,2).'</td>';             
                              echo '<td align="right">'.number_format($importe,2).'</td>';                    
                              echo '</tr>';
                            }
                             ?>          
                        </tbody>                             
                        <tfoot> 
                            <tr>
                               <td colspan="2" align="right"></td>
                                <td colspan="2" align="right" class="active"><label id="lbliva" name="lbliva">SUB-TOTAL S/.</label></td>
                                <td colspan="1" align="right"><label id="lblsubtotal" name="lblsubtotal"><?php echo number_format(($DocOrder[0]->total-$DocOrder[0]->impuesto_total),2); ?></label>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" align="right"></td>
                                <td colspan="2" align="right" class="active"><label id="lbliva" name="lbliva">I.G.V(18%) S/.</label></td>
                                <td colspan="1" align="right"><label id="lbliva" name="lbliva"><?php echo number_format($DocOrder[0]->impuesto_total,2); ?></label>
                                </td>
                              </tr>
                              <tr>
                                 <td colspan="2" align="right"></td>
                                <td colspan="2" align="right" class="active"><label id="lbliva" name="lbliva">TOTAL S/.</label></td>
                                <td colspan="1" align="right"><label id="lbltotal" name="lbltotal"> <?php echo number_format($DocOrder[0]->total,2); ?></td>
                              </tr>           
                        </tfoot>                              
                      </table>
                    </div>
              </div>
         
                <div class="box-footer ">
                 
                </div>
               
          </div>
        </div>
      </div>
    
      </div>
      <div class="col-md-4">
          <div class="box box-success">
              <div class="box-header with-border">
                <!--<i class="fa fa-calendar"></i>-->
                <h3 class="box-title">Informacion de Comprobante</h3>            
                <div class="pull-right box-tools">
                  <div class="btn-group">
                    <button type="button" class="btn btn-box-tool btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                      <li><a href="#">Nuevo</a></li>
                      <li><a href="#" id="btnBuscarTransportista">Buscar</a></li>
                      <li class="divider"></li>
                      <li><a href="#">View calendar</a></li>
                    </ul>
                  </div>              
             
                  <button type="button" class="btn btn-box-tool btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>             
                </div>
           
              </div>
           
              <div class="box-body">
                <div class="row"></div>
                      <div class="row" id="ventas"> 

                      <div class="col-md-12">
                        <div class="form-group has-success"> 
							<label for="inputMarca">COMPROBANTE:</label>
							  <input id="txtComp" type="text" class="form-control" name="txtComp" placeholder="COMPROBANTE" readonly value="<?php echo $DocOrder[0]->comprobante; ?>">

						
						<!--							
                             <select class="form-control" name="cboTipoComp" id="cboTipoComp">
                                <option value="">-- TIPO COMPROBANTE --</option>
                                <?php 
                                foreach ($documentos as $t) {
                                   $documento = mb_strtoupper($t->documento, 'UTF-8'); 
                                    if($t->id!='3' and $t->id!='4' and $t->id!='9' and $t->id!='10'){

                                      echo '<option value="'.$t->id.'" >'.$documento.'</option>';
                                    }
                                } 

                                ?>
                            </select>  
								-->
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-success"> 
							<label for="inputMarca">SERIE:</label>						  
                            <input id="txtSerie" type="text" class="form-control" name="txtSerie" placeholder="SERIE" readonly value="<?php echo $DocOrder[0]->serie_comprobante; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-success">   
							<label for="inputMarca">NUMERO:</label>					  
                           <input id="txtNumComp" type="text" class="form-control" name="txtNumComp" placeholder="NUMERO" readonly value="<?php echo $DocOrder[0]->num_pedido; ?>">
                        </div>
                    </div>


                  </div>


                <div class="row"> 
                    <div class="col-md-6 col-xs-12">
 <input id="txtTotal" type="hidden" class="form-control" name="txtTotal"  value="<?php echo number_format($DocOrder[0]->total,2); ?>">
					
	
                      <div class="form-group">
                      <label for="inputMarca">EFECTIVO:</label>
					  	<div class="input-group">
						  <div class="input-group-addon">S/.</div>
						  <input id="txtEfectivo" type="text" class="form-control" name="txtEfectivo" autofocus >
						 <!-- <div class="input-group-addon">.00</div>
						  -->
						</div>
						
                
                      </div>      
                    </div>
					<div class="col-md-6 col-xs-12">
                      <div class="form-group">
                      <label for="inputMarca">VUELTO:</label>
					  	<div class="input-group">
						  <div class="input-group-addon">S/.</div>
						<input id="txtVuelto" type="text" class="form-control" name="txtVuelto" placeholder="00.00" readonly>
						</div>
                      </div>      
                    </div>

                </div>
    

              </div>
       
              <div class="box-footer text-black">       
                   <div class="row">
                      <div class="col-md-12 right">
                        <div class="botones">  
                        <a href="<?php echo base_url('pedidos')?>" class="btn icon-btn btn-primary btn-md"><span class="glyphicon btn-glyphicon glyphicon-remove img-circle text-primary"></span> Cancelar</a>
                        
                        <button class="btn icon-btn btn-success btn-md" type="button" id="SavePago"><span class="glyphicon btn-glyphicon glyphicon-floppy-saved img-circle text-success"></span> Registrar</button>
                        
                        <!--
                        <a class="btn icon-btn btn-success btn-md" id="SaveGuia">
                            <span class="glyphicon btn-glyphicon glyphicon-floppy-saved img-circle text-success"></span>Registrar</a>
                            -->
                   
                        </div>                                                
                      </div>
                    </div>
              </div>
             
          </div>
      </div>     
  </div>
    </form>
</div> 