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

<div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-plus-square" aria-hidden="true"></i> Registrar Pedido</span></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
            
                <div class="box-body">
					<div class="col-sm-14" id="VerForm" style="display: block;">
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>
          <!--
					<form role="form" name="frmPedido" id="frmPedido" method="post" enctype="multipart/form-data">
          -->

                      <div class="row">
                          <div class="col-lg-12 left">
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
                
                          <div class="col-lg-12 left">
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
                                   <div class="col-xs-2">
                                    <div class="form-group has-success"> 
                                        <label for="inputMarca">&nbsp;&nbsp;&nbsp;</label>                               
                                         <button type="submit" disabled="disabled" id="AgregarProducto" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Agregar Producto</button>
                                      </div>
                                  </div>


                              </div>
                              
                          </div>
                          <div class="col-lg-12 left">
                          <hr/><br/> 
                          </div>


                          <div class="col-sm-9 col-lg-12 main" id="VerDetallePedido">
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
                </div>                
                <div class="box-footer no-padding">
                <!--
                    <div class="row">
          						<div class="col-lg-12 left">
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





