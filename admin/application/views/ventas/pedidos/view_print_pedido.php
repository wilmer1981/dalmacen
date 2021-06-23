<html>
<head>
<title>:TICKET :</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="GENERATOR" content="Quanta Plus KDE"> 
<style type="text/css">
.Imprime {    
    font-family:Arial;
    font-size:14px;
}
@page{
   margin: 0;
}
</style>
</head>
<body> 
<div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-plus-square" aria-hidden="true"></i> DETALLE DE VENTA</span></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
            
                <div class="box-body">
                <div class="col-md-8">

            <div class="box box-solid bg-green-gradient">
              <div class="box-header">
                <i class="fa fa-calendar"></i>
                <h3 class="box-title">Calendar</h3>            
                <div class="pull-right box-tools">
                
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                      <li><a href="#">Add new event</a></li>
                      <li><a href="#">Clear events</a></li>
                      <li class="divider"></li>
                      <li><a href="#">View calendar</a></li>
                    </ul>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
           
              </div>
           
              <div class="box-body no-padding" style="display: block;">
            
                <div id="calendar" style="width: 100%"></div>

              </div>
         
              <div class="box-footer text-black" style="display: block;">
                   <div class="row">
                            <div class="col-md-12 left">
                                <div class="row">
                                  <div class="col-xs-3">
                                        <div class="form-group has-success">
                                            <label for="inputMarca">Tipo Pedido:</label>                                
                                             <select class="form-control" name="cboTipoPedido" id="cboTipoPedido">
                                             <option value="" >-- SELECCIONE --</option>                                  
                                                <?php foreach ($pedidostipo as $t) {
                                                   $nombre = mb_strtoupper($t->nombre, 'UTF-8'); 
                                                  echo '<option value="'.$t->id.'">'.$nombre.'</option>';
                                                } 
                                                ?>               
                                            </select>                 
                                        </div>
                                    </div> 
                                    <div class="col-xs-1">
                                      <div class="form-group has-success">
                                            <label for="inputMarca">Numero:</label>
                                           <input id="txtNumero" type="text" class="form-control" required="" maxlength="50" name="txtNumero" readonly>
                                        </div>
                                    </div>  
                                    <div class="col-xs-6">
                                                          <div class="form-group has-success">
                                                              <input id="txtIdUsuario" type="hidden" maxlength="50" class="form-control" name="txtIdUsuario" required="" placeholder="" autofocus="">
                                                              <label for="inputMarca">Cliente:</label>                                        
                                                              <div class="input-group has-success">
                                                                  <input id="txtIdCliente" type="hidden" class="form-control" name="txtIdCliente" required="" placeholder="" autofocus="">
                                                                  <input id="txtCliente" type="text" class="form-control" name="txtCliente" required="" placeholder="Seleccione cliente" autofocus="" disabled="">
                                                                  <span class="input-group-btn">
                                                                      <button type="button" class="btn btn-success" id="btnBuscarCliente"><i class="fa fa-search"></i> Buscar</button>
                                                                  </span>
                                                              </div>   
                                                          </div>                      
                                    </div> 
                                    <div class="col-xs-2">
                                      <label for="inputMarca">Impuesto:</label>
                                      <div class="form-group">
                                          <div class="input-group has-success">
                                              <input id="txtImpuesto" type="text" class="form-control" style="text-align:center;" name="txtImpuesto" disabled="">
                                              <div class="input-group-addon">%</div>
                                          </div>
                                      </div>                         
                                    </div>
                                         

                                </div>                              
                            </div>
                  
                            <div class="col-md-12 left">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group has-success">
                                            <label for="inputMarca">Producto:</label>                                
                                            <input type="text" name="BuscarProducto" id="BuscarProducto" disabled="disabled" class="form-control input-sm" autocomplete="off"  />
                                        </div>
                                    </div>                
                     
                                    <div class="col-xs-2">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Cantidad:</label>
                                          <input  type="text" name="cantidad" id="cantidad" autocomplete="off"  class="form-control input-sm" size="3" value="1" />
                                      </div>
                                    </div>

                                  <input type="hidden" name="codigoproducto"  id="codigoproducto" /> 
                                  <input type="hidden" name="descripcion"  id="descripcion" />
                                  <input type="hidden" name="costo"  id="costo" />                                        
                            
                                  <input type="hidden" name="idsessionventa"  id="idsessionventa" value="<?php echo md5(rand(1000,50000)); ?>" />
                                  
                                  <div class="col-xs-2">
                                      <div class="form-group has-success">
                                            <label for="inputMarca">Existencia:</label>
                                           <input type="text" name="existencia" id="existencia" class="form-control input-sm"  size="3" readonly="readonly"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                      <div class="form-group has-success">
                                            <label for="inputMarca">Precio:</label>
                                           <input type="text" name="precioventa" class="form-control input-sm"  id="precioventa" size="3" readonly="readonly"/>                                    
                                        </div>
                                    </div>                          


                                </div>
                                
                            </div>
                            <div class="col-md-12 left">
                            <hr/><br/> 
                            </div>
            

                        </div>
              </div>
          </div>

        <div class="row">


                          <div class="col-sm-9 col-md-12 main" id="VerDetallePedido">
                            <form   name="formulario" id="formulario" role="form">
                              <table class="table table-bordered table-striped"    id="carrito">
                                <thead>
                                  <th>Código</th>
                                  <th>Descripcion</th>                                
                                  <th>Precio</th>
                                  <th>Cantidad</th>
                                  <th>Total</th>
                                  <th></th>
                                <thead>
                                
                                 <tbody>
                                      <tr>
                                          <td colspan=7><center>No Hay Productos Agregados</center></td>
                                      </tr>
                                      
                                 </tbody>
                                 <tfoot> 
                                 <tr>
                                  <td colspan=4 align="right">Sub-Total:</td>
                                  <td colspan=2><label id="lblsubtotal" name="lblsubtotal">$ 0</label><input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0"/C></td>
                                </tr>
                                <tr>
                                  <td colspan=4 align="right">IGV:</td>
                                  <td colspan=2><label id="lbliva" name="lbliva">$ 0</label><input type="hidden" name="txtIva" id="txtIva" value="0"/></td>
                                </tr>
                                <tr>
                                  <td colspan=4 align="right">Total:</td>
                                  <td colspan=2><label id="lbltotal" name="lbltotal">$ 0</label><input type="hidden" name="txtTotal" id="txtTotal" value="0"/></td>
                                </tr>
                              </tfoot> 
                                </table>
                                <!--<p class="bg-success">Direcciónes de Embarque</p>
                                <input type="radio" value="0"/> Dir. de Embarque <input type="radio" value="1"> Dir de Recolección. 
                              <br/>
                                Dir. de Entrega: 
                                <select name="dirEnvio">
                                  <option value="0">--Elige Dirección</option>
                                </select>-->
                               <center>
                                <button type="reset" class="btn btn-default" onclick="javascript:location.reload();"><span class="glyphicon glyphicon-edit"></span> Nueva Venta</button> &nbsp;
                                <button type="submit" id="SavePedido" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Crear Venta</button></center>
                              </form> 
                          </div> 
                      
                      </div>

     
                   
                  </div>    

                <div class="col-md-4">                   

                        <div class="ticket">    
 
                                                
                                    <table border=0 width=310 cellspacing="0" cellpadding="0" class="Imprime"> 
                                        <tr>
                                            <td><center><img src="<?php echo base_url('assets/images/HRline200.png'); ?>" width="250"></center></td> 
                                        </tr>
                                        <tr><td><center><?php echo NOMBRE_EMPRESA; ?></center></td></tr>
                                        <tr><td><center><?php echo LEYENDA_EXTRA;?></center></td></tr>
                                        <tr><td><center><?php echo CALLE;?></center></td></tr>    
                                        <tr><td><center><?php echo URB;?></center></td></tr>                
                                        <tr><td><center><?php echo CP.' - '.CIUDAD.' - '.ESTADO; ?></center></td></tr>
                                        <tr><td><center><?php echo "RUC ".RUC;?></center></td></tr>   
                                        <tr><td><center><?php echo TELEFONOS; ?></center></td></tr>
                                        <tr><td><center><img src="<?php echo base_url('assets/images/HRline200.png'); ?>" width="250"></center></td></tr>
                                        <tr>
                                            <td>
                                                <center>
                                                    FECHA: <?php echo date("Y")."-".date("m")."-".date("d")." HORA: ".date("H:i:s"); ?>
                                                    <br/>
                                                    VENDEDOR: <?php echo $this->session->userdata('nome'); ?>
                                                    <BR/> 
                                                    DOCUMENTO: <strong><?php //echo $NumOrder; ?><?php echo $DocOrder[0]->num_pedido; ?></strong>
                                                </center>
                                            </td>  
                                        </tr>
                                                
                                        <tr>
                                        <td>
                                            <table align='center' border=0 width=310 cellspacing="0" cellpadding="0" class="Imprime" >
                                                <tr><td colspan=5><hr/></td></tr>
                                                <tr>
                                                <td align='right'><small>COD.</small></td>
                                                <td align='center'><small>DESCRIPCION</small></td>
                                                <td align='center'><small>CANT.</small></td>
                                                <td align='center'><small>PRECIO</small></td>
                                                <td align='left'><small>TOTAL</small></td>
                                                </tr>
                                                <tr><td colspan=5><hr/></td></tr>
                                                <?php
                                                    foreach ($ListOrder as $key => $value) {
                                                        $cuantosLetras = strlen($value->descripcion);
                                                        if($cuantosLetras >=13)
                                                        {
                                                            $cuantosLetras = 13;
                                                        }
                                                        if($cuantosLetras <=13)
                                                        {
                                                            $cuantosLetras = $cuantosLetras;
                                                        }
                                                        # code...
                                                         echo '<tr>';
                                                         echo '<td style="font-size:12px;" align="right"><small>'.$value->cod_producto.'</small></td>';
                                                         echo '<td style="font-size:12px;" align="center"><small>'.substr($value->descripcion,0,$cuantosLetras).'</small></td>';
                                                         echo '<td style="font-size:12px;">'.$value->cantidad.'</td>';
                                                         echo '<td style="font-size:12px;" align="left">'.$value->precio_venta.'</td>';
                                                         echo '<td style="font-size:12px;" align="left">'.($value->precio_venta) * ($value->cantidad).'</td>';
                                                         echo '</tr>';
                                                    }
                                                 ?>         
                                              
                                               <tr><td colspan=5><hr/></td></tr>
                                               <tr><td colspan=3 align='center'>SUBTOTAL: </td><td colspan=2 align='center'>$ <?php echo $DocOrder[0]->bruto; ?></td></tr>
                                               <tr><td colspan=3 align='center'>IGV: </td><td colspan=2 align='center'>$ <?php echo $DocOrder[0]->impuesto_total; ?></td></tr>
                                               <tr><td colspan=3 align='center'>TOTAL: </td><td colspan=2 align='center'>$ <?php echo $DocOrder[0]->total; ?></td></tr>
                                               
                                            </table>
                                        </td>   
                                    </tr>    
                                    <tr>
                                    <td>
                                        <br/><br/>
                                        <center><img src="<?php echo base_url('assets/images/HRline200.png'); ?>" width="250"></center>
                                    </td> 
                                    </tr>
                                    <tr><td><center>GRACIAS POR SU PREFERENCIA!</center></td></tr>
                                    <tr>
                                        <td><center><img src="<?php echo base_url('assets/images/HRline200.png'); ?>" width="250"></center></td>  
                                    </tr>      
                                </table>
                                <!--
                                <div id='all_table' style='page-break-after: always'></div> 
                                -->
                        </div>
                          
                      </div>

                </div>                
                <div class="box-footer no-padding">
                <!--
                    <div class="row">
                                <div class="col-md-12 left">
                                       <div class="botones">  
                                            <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Registrar</button>
                                            <a href="<?php echo base_url('pedidos')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>
                                            </div>
                                                          
                                </div>
                            </div>
                    -->
                </div>
          <!--
                </form>
                -->
    </div>






</body>
</html>