<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title"><span class="icon"><i class="fa fa-plus-square" aria-hidden="true"></i> Registrar Venta</span></h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
            
    <div class="box-body">
        <div id="mensaje"></div>
        
				<div class="col-md-9">    			
              <!--
    					<form role="form" name="frmPedido" id="frmPedido" method="post" enctype="multipart/form-data">
              -->

                <div class="row">
                    <div class="col-md-12 left">
                        <div class="row">
                          <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label for="inputMarca">Tipo Pedido:</label>                                
                                     <select class="form-control" name="cboTipoPedido" id="cboTipoPedido">
                                    <!--
                                     <option value="" >-- SELECCIONE --</option>   
                                     -->                            
                                        <?php foreach ($pedidostipo as $t) {
                                           $nombre = mb_strtoupper($t->nombre, 'UTF-8'); 
                                           if($t->id=='200'){$selected='selected';}else{$selected='';}
                                          echo '<option value="'.$t->id.'"'.$selected.'>'.$nombre.'</option>';
                                        } 
                                        ?>               
                                    </select>                 
                                </div>
                            </div>
                        
                            <div class="col-md-8">
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
                            <!--
                            <div class="col-xs-2">
                              <label for="inputMarca">Impuesto:</label>
                              <div class="form-group">
                                  <div class="input-group has-success">
                                      <input id="txtImpuesto" type="text" class="form-control" style="text-align:center;" name="txtImpuesto" disabled="">
                                      <div class="input-group-addon">%</div>
                                  </div>
                              </div>                         
                            </div>
                            -->
                                 

                        </div>                              
                    </div>
          
                    <div class="col-md-12 left">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label for="inputMarca">Producto:</label>                                
                                    <input type="text" name="BuscarProducto" id="BuscarProducto" disabled="disabled" class="form-control input-sm" autocomplete="off"  />
                                </div>
                            </div>                
             
                            <div class="col-md-2">
                              <div class="form-group has-success">
                                  <label for="inputMarca">Cantidad:</label>
                                  <input  type="text" name="cantidad" id="cantidad" autocomplete="off"  class="form-control input-sm" size="3" value="1" />
                              </div>
                            </div>
                              <?php

                        
                        // Create form and send values in 'shopping/add' function.
                         // echo form_open('pedidos/add');
                                 $attributes = array('class' => 'form', 'id' => 'prodForm', 'name' => 'prodForm');
                           echo form_open('',$attributes);
                           //echo form_hidden('id', $id);
                           //echo form_hidden('name', $name);
                           //echo form_hidden('price', $price);
                          $codigo = array('name' => 'codigoproducto',
                                                'id'          => 'codigoproducto',
                                                'value'       => '',                                       
                                                'type'        => 'hidden'
                                    );
                          $costo = array('name' => 'costo',
                                                'id'          => 'costo',
                                                'value'       => '',                                       
                                               'type'        => 'hidden'
                                    );


                          //echo form_hidden($codproducto);
                          //echo form_hidden($descripcion);
                         // echo form_hidden($costo);

                          $descripcion = array('name' => 'descripcion',
                                                'id'          => 'descripcion',
                                                'value'       => '',
                                                'maxlength'   => '300',
                                                'size'        => '150',
                                               'type'        => 'hidden',
                                                'style'       => 'width:100%');

                           echo form_input($codigo);
                           echo form_input($descripcion);
                           echo form_input($costo);

                            //echo form_hidden($codigo);
                            //echo form_hidden($descripcion);
                            //echo form_hidden($costo);


                        ?> 

                        <!--
                      
                          <input type="hidden" name="codigoproducto"  id="codigoproducto" /> 
                        
                          <input type="hidden" name="descripcion"    id="descripcion" />
                         
                          <input type="hidden" name="costo"          id="costo" />   
                            -->         
                          <!--
                          <input type="hidden" name="idsessionventa"  id="idsessionventa" value="<?php echo md5(rand(1000,50000)); ?>" />
                          -->
                          <div class="col-md-2">
                              <div class="form-group has-success">
                                    <label for="inputMarca">Existencia:</label>
                                   <input type="text" name="existencia" id="existencia" class="form-control input-sm"  size="3" readonly="readonly"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group has-success">
                                    <label for="inputMarca">Precio:</label>
                                   <input type="text" name="precioventa" class="form-control input-sm"  id="precioventa" size="3" readonly="readonly"/>                                    
                                </div>
                            </div>
                             <div class="col-md-2">
                              <div class="form-group has-success"> 
                                  <label for="inputMarca">&nbsp;&nbsp;&nbsp;</label><br>            
                                   <!--
                                   <button type="submit" disabled="disabled" id="AgregarProducto" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Agregar</button>
                                   -->

                                     <?php
                                   /* $btn = array(
                                        'class' => 'fg-button teal',
                                        'value' => 'Agregar',
                                        'name' => 'action'
                                    );  */                      
                                    // Submit Button.
                                    //echo form_submit($btn);

                                    
                                    
                                    $data = array(
                                      'name' => 'button',
                                      'id' => 'txtbox',                 
                                      //'value' => 'true',
                                      //'data-prod'=>$idprod,
                                      //'data-alerta'=>'alerta-prod'.$idprod,
                                      'class' => 'btn btn-success btn-md add-cart',
                                      'type' => 'button',
                                      //'type' => 'submit',
                                      'title'=>'Agregar al pedido',
                                      'content' => '<span class="glyphicon glyphicon-ok-sign"></span> Agregar'
                                  );                                          
                                         
                                      echo form_button($data);
                                      echo form_close();

                                    ?>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-12 left"> <hr/><br/></div>
                        <div id="text"> 
                          <?php  
                        
                          $cart_check = $this->cart->contents();
                          
                          // If cart is empty, this will show below message.
                          if(empty($cart_check)) {
                            echo 'To add products to your shopping cart click on "Add to Cart" Button'; 
                          }  
                          ?>
                        </div>

                    <div class="col-sm-9 col-md-12 main" id="VerDetallePedido">
                          <table id="table" border="0" cellpadding="5px" cellspacing="1px">
                  <?php
                  // All values of cart store in "$cart". 
                  var_dump($this->cart->contents());
                  if ($cart = $this->cart->contents()): ?>
                    <tr id= "main_heading">
                        <td>Serial</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Qty</td>
                        <td>Amount</td>
                        <td>Cancel Product</td>
                    </tr>
                    <?php
                     // Create form and send all values in "shopping/update_cart" function.
                    echo form_open('shopping/update_cart');
                    $grand_total = 0;
                    $i = 1;

                    foreach ($cart as $item):
                        //   echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        //  Will produce the following output.
                        // <input type="hidden" name="cart[1][id]" value="1" />
                        
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        ?>
                        <tr>
                            <td>
                       <?php echo $i++; ?>
                            </td>
                            <td>
                      <?php echo $item['name']; ?>
                            </td>
                            <td>
                                $ <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td>
                            <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                            </td>
                        <?php $grand_total = $grand_total + $item['subtotal']; ?>
                            <td>
                                $ <?php echo number_format($item['subtotal'], 2) ?>
                            </td>
                            <td>
                              
                            <?php 
                            // cancle image.
                            $path = "<img src='http://localhost/codeigniter_cart/images/cart_cross.jpg' width='25px' height='20px'>";
                            echo anchor('shopping/remove/' . $item['rowid'], $path); ?>
                            </td>
                     <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td><b>Order Total: $<?php 
                        
                        //Grand Total.
                        echo number_format($grand_total, 2); ?></b></td>
                        
                        <?php // "clear cart" button call javascript confirmation message ?>
                        <td colspan="5" align="right"><input type="button" class ='fg-button teal' value="Clear Cart" onclick="clear_cart()">
                            
                            <?php //submit button. ?>
                            <input type="submit" class ='fg-button teal' value="Update Cart">
                            <?php echo form_close(); ?>
                            
                            <!-- "Place order button" on click send "billing" controller  -->
                            <input type="button" class ='fg-button teal' value="Place Order" onclick="window.location = 'shopping/billing_view'"></td>
                    </tr>
              <?php endif; ?>
            </table>
              <!--

                      <form   name="formulario" id="formulario" role="form">
                        <table class="table table-bordered table-striped"    id="carrito">
                          <thead class="colorBodyTable">
                            <th>COD</th>
                             <th>CANT</th>
                            <th>DESCRIPCION</th>                                
                            <th>PRECIO</th>                                 
                            <th>TOTAL</th>
                            <th></th>
                          </thead>                                
                           <tbody>
                                <tr>
                                    <td colspan=6><center>No Hay Productos Agregados</center></td>
                                </tr>                                      
                           </tbody>
                           <tfoot> 
                           <tr>
                            <td colspan=4 align="right">SUBTOTAL:</td>
                            <td colspan=2><label id="lblsubtotal" name="lblsubtotal">$ 0</label><input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0"/C></td>
                          </tr>
                          <tr>
                            <td colspan=4 align="right">IGV:</td>
                            <td colspan=2><label id="lbliva" name="lbliva">$ 0</label><input type="hidden" name="txtIva" id="txtIva" value="0"/></td>
                          </tr>
                          <tr>
                            <td colspan=4 align="right">TOTAL:</td>
                            <td colspan=2><label id="lbltotal" name="lbltotal">$ 0</label><input type="hidden" name="txtTotal" id="txtTotal" value="0"/></td>
                          </tr>
                        </tfoot> 
                          </table>
        
                        </form> 
                        -->
                    </div>           

                </div>           
        </div>
        <div class="col-md-3">
          <div class="row color-fondo">
            <div class="col-md-12">
         
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><label class="lblTotalInfo" id="lblTotalInfo" name="lblTotalInfo">$ 0.00</label></h3>

                 <!-- <p>New Orders</p>-->
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Calcular Vuelto <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
 
            <div class="col-md-12 col-xs-12">
              <div class="panel panel-default">
              <!--
              <div class="panel-heading">Panel Heading</div>
              -->
              <div class="panel-body">

                    <div class="row" id="proformas" style="display: none;">
                      <div class="col-md-12">
                              <div class="form-group has-success">
                                  <label for="inputMarca">Numero:</label>
                                   <input id="txtNumero" type="text" class="form-control" required="" name="txtNumero" readonly>
                                </div>
                      </div>
                  </div>
                  <div class="row" id="ventas"> 

                      <div class="col-md-12">
                        <div class="form-group has-success">                                                       
                             <select class="form-control" name="cboTipoComp" id="cboTipoComp">
                                <option value="">-- TIPO COMPROBANTE --</option>
                                <?php foreach ($documentos as $t) {
                                   $documento = mb_strtoupper($t->documento, 'UTF-8'); 

                                  echo '<option value="'.$t->id.'" >'.$documento.'</option>';
                                } ?>
                            </select>                 
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-success">                               
                            <input id="txtSerie" type="text" class="form-control" required="" maxlength="50" name="txtSerie" disabled="disabled" placeholder="SERIE">
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-success">                            
                           <input id="txtNumComp" type="text" class="form-control" required="" maxlength="50" name="txtNumComp" disabled="disabled" placeholder="NUMERO">
                        </div>
                    </div>


                  </div>

                 <div class="col-md-12 col-xs-12">
                  <div class="form-group">
                  <label for="inputMarca">TIPO PAGO:</label> <br>                 
                    <label class="radio-inline"><input type="radio" name="tipopago" id="tipopago" value="CON" checked>CONTADO</label>             
                    <label class="radio-inline"><input type="radio" name="tipopago" id="tipopago" value="CRE">CREDITO</label>                 
                  </div>      
                </div>


              </div>
              </div>
            </div>
            <div class="col-md-12 col-xs-12">
                  <center>
                    <button type="reset" class="btn btn-default" id="resetear" onclick="javascript:location.reload();"><span class="glyphicon glyphicon-edit"></span> Nuevo</button> &nbsp;
                    <button type="submit" id="SavePedido" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Registrar</button>
                  </center>         
            </div>                
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



	<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_search" role="dialog" aria-hidden="true"></div>
<div class="modal fade" id="modal_form_isearch" role="dialog" aria-hidden="true"></div>

<script type="text/javascript">
  function AsignaSession(){
    document.getElementById("idsessionventa").value="<?php echo md5(rand(1000,50000)); ?>";
  }
  function RefrescarPagina(){
    if(confirm("Si cambias de Cliente se Perderan los Cambios")) { 
      location.reload();
    }else{
      return false;
    }

  }
</script>



