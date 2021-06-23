<?php
  $numOrder = $this->uri->segment(3);
?>
<div class="box box-default">

  <div class="box-header with-border">
    <h3 class="box-title"><span class="icon"><i class="fa fa-plus-square" aria-hidden="true"></i> REGISTRO VENTA</span></h3>
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
    
  <input type="hidden" name="txtId" id="txtId" class="form-control input-sm" value="<?php echo $numOrder;?>">
            
  <div class="box-body">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-success">
                <div class="box-header with-border">
                  <!--<i class="fa fa-calendar"></i>-->
                  <h3 class="box-title">Informacion de Orden Compra</h3>            
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
                             <tr>
                              <th scope="row" class="active"># ORD.COMPRA</th>
                              <td><?php echo $DocOrder[0]->serie_comprobante.' - '.$DocOrder[0]->num_pedido; ?></td>
                              <th scope="row" class="active">TIPO PAGO</th>
                              <td><?php echo $DocOrder[0]->tipo_pago; ?></td>
                              
                            </tr>
                            <tr>
                              <th scope="row" class="active">CLIENTE</th>
                              <td><?php echo $DocOrder[0]->cliente; ?>
                              <button type="button" class="btn btn-warning" id="btnBuscarCli" title="Cambiar Cliente" data-toggle="modal" data-target="#modal_form_register" data-name="<?php echo $DocOrder[0]->cliente; ?>" data-numero="<?php echo $DocOrder[0]->serie_comprobante.' - '.$DocOrder[0]->num_pedido; ?>" data-id="<?php echo $DocOrder[0]->id; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>                            
                              </td>
                              <th scope="row" class="active">COMPROBANTE</th>
                              <td><?php echo $DocOrder[0]->comprobante; ?></td>
                            </tr>
                            <tr>
                              <th scope="row" class="active">RUC</th>
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
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">SUB-TOTAL $</label></td>
                                <td colspan="1"><label id="lblsubtotal" name="lblsubtotal"><?php echo number_format(($DocOrder[0]->total-$DocOrder[0]->impuesto_total),2); ?></label>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" align="right"></td>
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">I.G.V(18%) $</label></td>
                                <td colspan="1"><label id="lbliva" name="lbliva"><?php echo number_format($DocOrder[0]->impuesto_total,2); ?></label>
                                </td>
                              </tr>
                              <tr>
                                 <td colspan="2" align="right"></td>
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">TOTAL $</label></td>
                                <td colspan="1"><label id="lbltotal" name="lbltotal"> <?php echo number_format($DocOrder[0]->total,2); ?></td>
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
                             <select class="form-control" name="cboTipoComp" id="cboTipoComp">
                                <option value="">-- TIPO COMPROBANTE --</option>
                                <?php 
                                foreach ($documentos as $t) {
                                   $documento = mb_strtoupper($t->documento, 'UTF-8'); 
                                  // if($t->id=='2'){$selected="selected";}else{$selected="";}
                                    if($t->id!='3' and $t->id!='4' and $t->id!='9' and $t->id!='10'){

                                      echo '<option value="'.$t->id.'" >'.$documento.'</option>';
                                    }
                                } 

                                ?>
                            </select>                 
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-success">                               
                            <input id="txtSerie" type="text" class="form-control" required="" maxlength="50" name="txtSerie" placeholder="SERIE" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-success">                            
                           <input id="txtNumComp" type="text" class="form-control" required="" maxlength="50" name="txtNumComp" placeholder="NUMERO" readonly>
                        </div>
                    </div>


                  </div>


                <div class="row"> 
                    <div class="col-md-12 col-xs-12">
                      <div class="form-group">
                      <label for="inputMarca">FORMA PAGO:</label> <br>                 
                        <label class="radio-inline"><input type="radio" name="tipopago" id="tipopago" value="CON" checked>CONTADO</label>             
                        <label class="radio-inline"><input type="radio" name="tipopago" id="tipopago" value="CRE">CREDITO</label>                 
                      </div>      
                    </div>

                </div>
    

              </div>
       
              <div class="box-footer text-black">       
                  
                    <div class="row">
                      <div class="col-md-12 right">
                        <div class="botones">  
                        <a href="<?php echo base_url('pedidos')?>" class="btn icon-btn btn-primary btn-md"><span class="glyphicon btn-glyphicon glyphicon-remove img-circle text-primary"></span> Cancelar</a>
                        
                        <button class="btn icon-btn btn-success btn-md" type="button" id="SaveVenta"><span class="glyphicon btn-glyphicon glyphicon-floppy-saved img-circle text-success"></span> Registrar</button>
                        
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
  <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_search" role="dialog" aria-hidden="true"></div>

<div class="modal fade" id="modal_form_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Cambiar Cliente</span>
  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </button>
        </div>                   
            <form id="formOrden" name="formOrden" method="post">   
              <div class="form-action spacing-bottom"> 
                    <div class="form-group">                       
                        <div class="col-md-12 col-md-offset-2"> 
                        <input class="form-control" id="txtCodigo" type="hidden" name="txtCodigo" value="<?php echo 'C'.$correlativo; ?>"  />                
                            <label class="col-md-4  control-label">Numero Orden:</label>
                             <div class="col-md-6">
                             <input id="txtIdOrden" type="hidden" name="txtIdOrden" class="form-control orden_id" readonly>
                              <input id="txtNumero" type="text" name="txtNumero" class="form-control orden_numero" readonly>
                            </div>            
                      </div>
                        
                  </div>
              </div>              
              <div class="modal-body">           
              <div class="row">
                <div class="col-md-12 left"> 
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <label for="inputMarca">Cliente:</label>
                        <input id="txtNombre" type="text" name="txtNombre" class="form-control cliente_name" readonly>
                      </div>
                      </div>           
                    </div>     

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group has-success">
                        <label for="inputMarca">Nuevo Cliente(<span class="required">*</span>):</label>
                         <input type="text" name="BuscarCliente" id="BuscarCliente" class="form-control" autofocus="" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group has-success">
                        <label for="inputMarca">Id</label>
                        <input id="txtIdCliente" type="text" name="txtIdCliente" class="form-control" readonly>
                        </div>
                      </div>
                  </div>     

                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-success">
                        <label for="inputMarca">Direccion:</label>
                        <input id="txtDireccion" type="text" name="txtDireccion" class="form-control" readonly>
                      </div>
                    </div>
                  </div> 


                </div>
              </div>              
            </div>
                <div class="modal-footer"> 
                <?php if (isset($custom_error) != '') {
                 // echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>            
              <div id="status"></div>
                <input name="opcion" id="opcion" type="hidden" value="register">
                <button id="btn-cancelar" type="button" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-remove"></i> Cancelar</button> 
                <button id="btn-updClienteOrden" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Actualizar</button>
                                                        
                </div>
                    </form>                 
                </div>              
      </div>
  </div>


