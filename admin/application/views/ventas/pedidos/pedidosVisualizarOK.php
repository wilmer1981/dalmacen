<div class="box box-default">

  <div class="box-header with-border">
    <h3 class="box-title"><span class="icon"><i class="fa fa-plus-square" aria-hidden="true"></i> VENTAS / DETALLES</span></h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  
  <form role="form" action="<?php echo current_url(); ?>" name="frmVenta" id="frmVenta" method="post" >            
  <div class="box-body">
    <div class="col-md-12">    
      <div class="row">
          <div class="col-md-8">
          <div class="box box-success collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de Cliente</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              </div>
            </div>
            <div class="box-body">
                  <div class="row">             
                      <div class="col-md-12">
                         <table class="table table-bordered">                    
                          <tbody>
                             <tr>
                              <th scope="row" class="active"># Pedido</th>
                              <td><?php 
                              if($DocOrder[0]->id_tipocomprobante==2){ //si es factura
                                  echo $DocOrder[0]->serie_comprobante.' - '.$DocOrder[0]->num_pedido; 
                              }else{ // si es orden de compra
                                  echo $DocOrder[0]->seriefact.' - '.$DocOrder[0]->numfact; 
                              }

                                ?>
                                
                              </td>
                              <th scope="row" class="active">FORMA PAGO</th>
                              <td><?php echo $DocOrder[0]->tipo_pago; ?></td>                              
                            </tr>
                            <tr>
                              <th scope="row" class="active">CLIENTE</th>
                              <td><?php echo $DocOrder[0]->cliente; ?></td>
                              <th scope="row" class="active">TIPO PRECIO</th>
                              <td><?php echo $DocOrder[0]->tipoprecio; ?></td>
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
                               <th scope="row" class="active"># ORDEN</th>
                              <td>
                              <?php
                              if($DocOrder[0]->id_tipocomprobante==9) //si es orden de compra
                                  echo $DocOrder[0]->serie_comprobante.' - '.$DocOrder[0]->num_pedido; 
                              else
                                  echo '-----';

                              ?>
                                
                              </td>
                            </tr>
                          </tbody>
                        </table>          
                      </div>                       

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
                          

                          $precio_dscto = $r->precio_venta * $r->descuento;
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
                  </tfoot>                              
                </table>
              </div>
        </div>
      </div>  
                 
      <div class="col-md-4">


          <div class="box box-success">
              <div class="box-header with-border">
                <!--<i class="fa fa-calendar"></i>-->
                <h3 class="box-title">Totales</h3>            
                <div class="pull-right box-tools">
                
                  <div class="btn-group">
                    <button type="button" class="btn btn-box-tool btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                      <li><a href="#">Impirmir</a></li>
                      <li><a href="#">Exportar</a></li>
                      <li class="divider"></li>
                      <li><a href="#">View calendar</a></li>
                    </ul>
                  </div>
                  <button type="button" class="btn btn-box-tool btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>             
                </div>
           
              </div>
           
              <div class="box-body">
              <div class="row"></div>
               <div class="row">             
                      <div class="col-md-12">     
             
                  
                          <table class="table table-bordered">             
                            <tbody>
                               <tr>
                               <td colspan="2" align="right"></td>
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">SUB-TOTAL $</label></td>
                                <td colspan="1" align="right"><label id="lblsubtotal" name="lblsubtotal"><?php echo number_format(($DocOrder[0]->total - $DocOrder[0]->impuesto_total),2); ?></label>
                                <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0"/></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="right"></td>
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">I.G.V(18%) $</label></td>
                                <td colspan="1" align="right"><label id="lbliva" name="lbliva"><?php echo number_format($DocOrder[0]->impuesto_total,2); ?></label>
                                <input type="hidden" name="txtIva" id="txtIva" value="0"/></td>
                              </tr>
                              <tr>
                                 <td colspan="2" align="right"></td>
                                <td colspan="1" align="right" class="active"><label id="lbliva" name="lbliva">TOTAL $</label></td>
                                <td colspan="1" align="right"><label id="lbltotal" name="lbltotal"> <?php echo number_format($DocOrder[0]->total,2); ?></label><input type="hidden" name="txtTotal" id="txtTotal" value="0"/></td>
                              </tr>
                            </tbody>                              
                          </table>
             
                </div>
                </div>
           

              </div>
         <!--
              <div class="box-footer text-black" style="display: block;">       

              </div>
              -->
          </div>

          <div class="row">
            <div class="col-md-12 right">
              <div class="botones">  
              <a href="<?php echo base_url('pedidos')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Regresar</a>
          

              </div>                                                
            </div>
          </div>
        </div>

      </div>           
    </div>      
  </div>
  <!--                
  <div class="box-footer no-padding">
    <div class="row">
      <div class="col-md-12 left">
        <div class="botones">  
        <a href="<?php echo base_url('pedidos')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Regresar</a>
    

        </div>                                                
      </div>
    </div>
  </div>
  -->
    </form>
</div>
  <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_search" role="dialog" aria-hidden="true"></div>
<div class="modal fade" id="modal_form_isearch" role="dialog" aria-hidden="true"></div>

<div class="modal fade" id="modal_form_listaProd" role="dialog" aria-hidden="true"></div>


