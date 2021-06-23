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
      <div id="mensaje"></div>        
			<div class="col-md-9">
    					<?php if ($custom_error != '') {
    						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
    					} ?>
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
                                  
                                       <option value="" >-- SELECCIONE --</option>   
                                                           
                                        <?php foreach ($pedidostipo as $t) {
                                           $nombre = mb_strtoupper($t->nombre, 'UTF-8'); 
                                           //if($t->id=='200'){$selected='selected';}else{$selected='';}
                                          //echo '<option value="'.$t->id.'"'.$selected.'>'.$nombre.'</option>';
                                          echo '<option value="'.$t->id.'">'.$nombre.'</option>';
                                        } 
                                        ?>               
                                    </select>                 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label for="inputMarca">Tipo Precio:</label>                               
                                    <select class="form-control" name="cboTipoDscto" id="cboTipoDscto">    
                                        <option value="" >-- SELECCIONE --</option>                      
                                        <?php 
                                        foreach ($pagostipo as $t) {
                                          $nombre = mb_strtoupper($t->codigo, 'UTF-8');
                                          //if($t->id=='2'){$selected='selected';}else{$selected='';}
                                          //echo '<option value="'.$t->id.'"'.$selected.'>'.$nombre.'</option>';
                                          echo '<option value="'.$t->id.'">'.$nombre.'</option>';
                                        } 
                                        ?>               
                                    </select>                 
                                </div>
                            </div>
                                     

                        </div>
  
                    </div>
          
                    <div class="col-md-12 left">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-success">
                                    <label for="inputMarca">Producto:</label>                                
                                    <input type="text" name="BuscarProducto" id="BuscarProducto" disabled="disabled" class="form-control input-sm" autocomplete="off" placeholder="Ingrese codigo producto y precione ENTER"  />
                                </div>
                            </div>                
             
                            <div class="col-md-2">
                              <div class="form-group has-success">
                                  <label for="inputMarca">Cantidad:</label>
                                  <input  type="text" name="cantidad" id="cantidad" autocomplete="off"  class="form-control input-sm" size="3" value="1" />
                              </div>
                            </div>

                          <input type="hidden" name="codigoproducto"  id="codigoproducto" /> 
                          <input type="hidden" name="descripcion"  id="descripcion" />
                          <input type="hidden" name="costo"  id="costo" />                  
                          <input type="hidden" name="idsessionventa"  id="idsessionventa" value="<?php echo md5(rand(1000,50000)); ?>" />
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
                                   <button type="submit" disabled="disabled" id="AgregarProducto" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Agregar</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-md-2">
                          <div class="form-group has-success">
                                <label for="inputMarca">Dscto:</label>
                               <input type="text" name="txtDscto" class="form-control input-sm" id="txtDscto">
                               <input type="hidden" name="txtDsctos" class="form-control input-sm" id="txtDsctos">                                    
                          </div>
                      </div>

                    <div class="col-md-12 left"> <hr/><br/></div>
                    <div class="col-sm-9 col-md-12 main" id="VerDetallePedido">
                      <form   name="formulario" id="formulario" role="form">
                        <table class="table table-bordered table-striped"    id="carrito">
                          <thead class="colorBodyTable">
                            <th>COD</th>
                             <th>CANT</th>
                            <th>DESCRIPCION</th>                                
                            <th>PRECIO</th>   
                            <th>DSCTO</th>                                 
                            <th>TOTAL</th>
                            <th></th>
                          </thead>                                
                           <tbody>
                                <tr>
                                    <td colspan=7><center>No Hay Productos Agregados</center></td>
                                </tr>                                      
                           </tbody>
                           <tfoot> 
                           <tr>
                            <td colspan=5 align="right">SUBTOTAL:</td>
                            <td colspan=2><label id="lblsubtotal" name="lblsubtotal">$ 0</label><input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0"/C></td>
                          </tr>
                          <tr>
                            <td colspan=5 align="right">IGV:</td>
                            <td colspan=2><label id="lbliva" name="lbliva">$ 0</label><input type="hidden" name="txtIva" id="txtIva" value="0"/></td>
                          </tr>
                          <tr>
                            <td colspan=5 align="right">TOTAL:</td>
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
                          <!--
                         <center>
                          <button type="reset" class="btn btn-default" onclick="javascript:location.reload();"><span class="glyphicon glyphicon-edit"></span> Nueva Venta</button> &nbsp;
                          <button type="submit" id="SavePedido" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Crear Venta</button></center>
                          -->
                        </form> 
                    </div>           

                </div>           
        </div>
        <div class="col-md-3">
          <div class="row color-fondo">
            <div class="col-md-12">
         
                   <div class="row">
                            <div class=" col-xs-12 col-md-12">
                                <div class="form-group has-success">
                                  <input type="hidden" name="txtIdCliente" id="txtIdCliente" >         
                                  <input type="hidden" name="Ciente" id="Cliente" >
                                  <input type="hidden" name="Direccion" id="Direccion" >
                                  <input type="hidden" name="Ubigeo" id="Ubigeo" >
                                  <input type="hidden" name="NumDoc" id="NumDoc" >
                                  <label for="inputMarca">Cliente:</label>  
                                  <input type="text" name="BuscarCliente" id="BuscarCliente" class="form-control input-sm" autocomplete="off" placeholder="Ingrese RUC o DNI y precione ENTER" disabled />
                     
                                </div>            
                            </div>
                            <div class=" col-xs-12 col-md-12">
                                <div class="form-group has-success">
                                    <label for="inputMarca">Direccion:</label>                                
                                    <input type="text" name="txtDireccion" id="txtDireccion" class="form-control input-sm" autocomplete="off" readonly />
                                </div>
                            </div> 
                            <div class=" col-xs-12 col-md-12">
                                <div class="form-group has-success">
                                    <label for="inputMarca">Num.Doc:</label>                                
                                    <input type="text" name="txtNumDoc" id="txtNumDoc" class="form-control input-sm" autocomplete="off" readonly />
                                </div>
                            </div>       
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
                                <?php 
                                /*foreach ($documentos as $t) {
                                   $documento = mb_strtoupper($t->documento, 'UTF-8'); 

                                  echo '<option value="'.$t->id.'" >'.$documento.'</option>';
                                }*/
                                 ?>
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
                  <label for="inputMarca">FORMA PAGO:</label> <br>                 
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



<div class="modal fade" id="modal_form_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Registrar Cliente</span>
  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </button>
        </div>        
        <form id="formCliente" name="formCliente" method="post" class="form-horizontal">   
        <div class="form-action spacing-bottom"> 
              <div class="form-group">                       
                <div class="col-md-12 col-md-offset-2"> 
                  <input class="form-control" id="txtCodigo" type="hidden" name="txtCodigo" value="<?php echo 'C'.$correlativo; ?>"  />                
                      <label class="col-md-4  control-label">Categoria del cliente:</label>
                      <div class="col-md-6">
                        <label class="radio-inline"> <input type="radio" name="categoria" id="categoria" value="MIN" checked> Persona Natural </label>
                        <label class="radio-inline"> <input type="radio" name="categoria" id="categoria" value="MAY"> Empresa </label>
                      </div>            
                </div>                        
              </div>
        </div>              
        <div class="modal-body"> 
            <!-- Section Persona Natural -->
            <div class="row form-minorista">
             <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomeCliente" class="col-md-4 control-label">Nombre<span class="required">*</span></label>               
                            <div class="col-md-8">
                                <input class="form-control" id="txtNombre" type="text" name="txtNombre" value="<?php echo set_value('nombre'); ?>"  />
                            </div>
                        </div>
              <div class="form-group">
                            <label for="nomeCliente" class="col-md-4 control-label">Apellidos<span class="required">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" id="txtApellido" type="text" name="txtApellido" value="<?php echo set_value('apellido'); ?>"  />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Tipo Documento<span class="required"></span></label>
                            <div class="col-md-8">
                              <select id="cboTipoDocumento" name="cboTipoDocumento" class="form-control">
                                  <option value=''>-- Seleccione --</option>
                                  <?php foreach ($documentosper as $t) {
                                    if($t->id == 5){ 
                                        $selected = 'selected'; 
                                        $disabled='';
                                    }else{
                                        $selected = ''; 
                                        $disabled='disabled';
                                    }  

                                    $documento = mb_strtoupper($t->documento, 'UTF-8'); 
                                    echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
                                  } ?>                                            
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Num. Documento<span class="required">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" id="txtNumDoc" type="text" name="txtNumDoc" value="<?php echo set_value('NumDoc'); ?>"  />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Telefono<span class="required"></span></label>
                            <div class="col-md-8">
                                <input class="form-control" id="txtTelefono" type="text" name="txtTelefono" value="<?php echo set_value('telefono'); ?>"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Celular<span class="required"></span></label>
                            <div class="col-md-8">
                                <input class="form-control" id="txtCelular" type="text" name="txtCelular" value="<?php echo set_value('celular'); ?>"  />
                            </div>
                        </div>           
               </div>
              
               <div class="col-md-6 div-vertical">
                        <div class="form-group">
                            <label for="numero" class="col-md-4 control-label">Direccion<span class="required"></span></label>
                            <div class="col-md-8">              
                                <input class="form-control" id="txtDireccion" type="text" name="txtDireccion" value="<?php echo set_value('direccion'); ?>"  />                   
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Departamento<span class="required"></span></label>
                            <div class="col-md-8">
                              <select class="form-control" id="cboDpto" type="text" name="cboDpto"  >
                               <option value=''>-- Seleccione Departamento --</option>
                              <?php 
                              foreach($dptos as $fila ){                
                                ?>
                              <option value='<?php echo $fila->CodDpto; ?>'> <?php echo $fila->Nombre; ?></option>
                        
                               <?php } ?>
                          
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Provincia<span class="required"></span></label>
                            <div class="col-md-8">
                              <select class="form-control" id="cboProv" type="text" name="cboProv"  >
                               <option value=''>-- Seleccione Provincia --</option>                                            
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Distrito<span class="required"></span></label>
                            <div class="col-md-8">
                              <select class="form-control" id="cboDist" type="text" name="cboDist"  >
                               <option value=''>-- Seleccione Distrito --</option>                                            
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">E-mail<span class="required"></span></label>
                            <div class="col-md-8">
                                <input class="form-control" id="txtEmail" type="text" name="txtEmail" value="<?php echo set_value('email'); ?>"  />
                            </div>
                        </div>

              </div>
            </div> 
            <!-- End Section Persona Natural --> 

              <!-- Section Empresas -->
            <div class="row form-mayorista" style="display:none">
              <div class="col-lg-6 left">
                      <fieldset class="fsStyle">  
                        
                          <legend class="legendStyle">
                            <a data-toggle="collapse" data-target="#demo" href="#">Datos de la Empresa</a>
                          </legend>
                          <div class="row collapse in" id="demo">
                             <div class="col-md-12">
                                 <div class="form-group ">
                                      <label for="nomeCliente" class="col-md-4 control-label">Razon Social<span class="required">*</span></label>
                                      <div class="col-md-6">
                                          <input class="form-control" id="txtRazonsocial" type="text" name="txtRazonsocial" value="" placeholder="Ingrese RUC a buscar">     
                                          <!--                                
                                          <button type="button" class="btn btn-success" id="btnBuscarRUC"><i class="fa fa-search"></i></button>
                                          -->
                                      </div>
                                        <div class="col-md-2 spacio-no-full">                                                 
                                          <button type="button" class="btn btn-success" id="btnBuscarRUC" title="Buscar Cliente"><i class="fa fa-search"></i></button>
                                      </div>
                                  </div>
                            <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Tipo Doc.<span class="required"></span></label>
                            <div class="col-md-6">
                              <select id="cboTipoDocumentos" name="cboTipoDocumentos" class="form-control">
                              <option value=''>-- Seleccione --</option>

                                      <?php foreach ($documentosper as $t) {
                                        $documento = mb_strtoupper($t->documento, 'UTF-8');
                                        if($t->id == 8){ 
                                            $selected = 'selected'; 
                                            $disabled='';
                                        }else{
                                            $selected = ''; 
                                            $disabled='disabled';
                                        }                                     
                                        echo '<option value="'.$t->id.'"'.$selected.''.$disabled.'>'.$documento.'</option>';

                              
                                      } ?>
                                        
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomeCliente" class="col-md-4 control-label">Num. Doc.<span class="required"></span></label>
                            <div class="col-md-6">
                                <input class="form-control" id="txtNumDocs" type="text" name="txtNumDocs" value=""  />
                            </div>
                        </div>

                            <div class="form-group">
                                <label for="direccion" class="col-md-4 control-label">Direccion<span class="required"></span></label>
                                <div class="col-md-8">
                                    <input class="form-control" id="txtDireccions" type="text" name="txtDireccions" value="">
                                </div>
                            </div>             

                            <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Departamento<span class="required"></span></label>
                            <div class="col-md-8">
                              <select class="form-control" id="cboDptos" type="text" name="cboDptos"  >
                               <option value=''>-- Seleccione Departamento --</option>
                           
                              <?php 
                              foreach($dptos as $fila ){                
                                ?>
                              <option value='<?php echo $fila->CodDpto; ?>'> <?php echo $fila->Nombre; ?></option>
                        
                               <?php } ?>
                        
                            <!--
                                <?php 
                                foreach($dptos as $fila ){  
                                    if($fila->CodDpto == $ubigeo[0]->CodDpto){ $selected = 'selected';}else{$selected = '';}
                                    
                                    echo '<option value="'.$fila->CodDpto.'"'.$selected.'>'.$fila->Nombre.'</option>';
                                }               
                                ?>      

                          -->
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Provincia<span class="required"></span></label>
                            <div class="col-md-8">
                              <select class="form-control" id="cboProvs" type="text" name="cboProvs"  >
                               <option value=''>-- Seleccione Provincia --</option>                                            
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rua" class="col-md-4 control-label">Distrito<span class="required"></span></label>
                            <div class="col-md-8">
                              <select class="form-control" id="cboDists" type="text" name="cboDists"  >
                               <option value=''>-- Seleccione Distrito --</option>                                            
                              </select>
                            </div>
                        </div>

                                  <!--
                                  <div class="form-group">
                                      <label for="direccion" class="col-md-4 control-label">Pais<span class="required">*</span></label>
                                      <div class="col-md-8">
                                          <select class="form-control" name="cboPais" id="cboPais">
                                          <option value="" disabled selected>-- Escoje Pais --</option>
                                            <?php foreach ($paises as $t) {
                                              echo '<option value="'.$t->id.'">'.$t->nombre.'</option>';
                                            } ?>
                                        </select>   
                                      </div>                                        
                                  </div>
                                  <div class="form-group">
                                      <label for="direccion" class="col-md-4 control-label">Estado/Provincia<span class="required">*</span></label>
                                      <div class="col-md-8">
                                        <select class="form-control" name="cboEstado" id="cboEstado">
                                           <option value="" disabled selected>-- Escoje Estado --</option>     
                                        </select>
                                      </div>                                        
                                  </div>
                                  -->
                                          
                       
                            </div>        
                          </div>                           
                   
                      </fieldset>
              </div>
              <div class="col-lg-6 left">
                       <fieldset class="fsStyle">  
                        
                          <legend class="legendStyle">
                            <a data-toggle="collapse" data-target="#demo" href="#">Datos de Contacto</a>
                          </legend>
                          <div class="row collapse in" id="demo">
                             <div class="col-md-12">
                                 <div class="form-group">
                                      <label for="nomeCliente" class="col-md-4 control-label">Nombres<span class="required">*</span></label>
                                      <div class="col-md-8">
                                          <input class="form-control" id="txtNombres" type="text" name="txtNombres" value="">
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label for="documento" class="col-md-4 control-label">Apellidos<span class="required">*</span></label>
                                      <div class="col-md-8">
                                          <input class="form-control" id="txtApellidos" type="text" name="txtApellidos" value="" >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="direccion" class="col-md-4 control-label">E-mail<span class="required"></span></label>
                                      <div class="col-md-8">
                                          <input class="form-control" id="txtEmails" type="text" name="txtEmails" value="">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="direccion" class="col-md-4 control-label">Telefono<span class="required"></span></label>
                                      <div class="col-md-8">
                                          <input class="form-control" id="txtTelefonos" type="text" name="txtTelefonos" value="" >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="direccion" class="col-md-4 control-label">Celular<span class="required"></span></label>
                                      <div class="col-md-8">
                                          <input class="form-control" id="txtCelulars" type="text" name="txtCelulars" value="" >
                                      </div>
                                  </div> 
                                  <div class="form-group">
                                      <label for="direccion" class="col-md-4 control-label">URL Web<span class="required"></span></label>
                                      <div class="col-md-8">
                                          <input class="form-control" id="txtWeb" type="text" name="txtWeb">
                                      </div>
                                  </div>                           
                           
                            </div>        
                          </div>                           
                   
                      </fieldset>
              </div> 
            </div> 
            <!-- End Section Empresas -->   

            <!--
            <div class="row">
              <div class="col-md-12 left">      

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group has-success">
                      <label for="inputMarca">Nombre(<span class="required">*</span>):</label>
                      <input id="txtNombre" type="text" name="txtNombre" required="" class="form-control" placeholder="Ingrese Nombre" autofocus="">
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-success">
                      <label for="inputMarca">Apellidos(<span class="required">*</span>):</label>
                      <input id="txtApellido" type="text" name="txtApellido" required="" class="form-control" placeholder="Ingrese Apellidos" >
                    </div>
                  </div>
                </div> 
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group has-success">
                      <label for="inputMarca">Tipo Documento(<span class="required">*</span>):</label>
                               <select id="cboTipoDocumento" name="cboTipoDocumento" class="form-control">
                                  <option value=''>-- Seleccione --</option>
                                  <?php foreach ($documentosper as $t) {
                                    if($t->id == 5){ 
                                        $selected = 'selected'; 
                                        $disabled='';
                                    }else{
                                        $selected = ''; 
                                        $disabled='disabled';
                                    }  

                                    $documento = mb_strtoupper($t->documento, 'UTF-8'); 
                                    echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
                                  } ?>                                            
                              </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-success">
                      <label for="inputMarca">Num.Documento(<span class="required">*</span>):</label>
                      <input id="txtNumDoc" type="text" maxlength="20" name="txtNumDoc" required="" class="form-control" placeholder="Ingrese Numero Documento" >
                    </div>
                  </div>
            </div> 

            <div class="row">
                  <div class="col-md-12">
                      <div class="form-group has-success">
                      <label for="inputMarca">Direccion:</label>
                      <input id="txtDireccion" type="text" name="txtDireccion" required="" class="form-control" placeholder="Ingrese Direccion" >
                    </div>
                  </div>
            </div> 
            -->
        </div>   
   
        <div class="modal-footer">                    
          <div id="status"></div>
            <input name="opcion" id="opcion" type="hidden" value="register">
            <button id="btn-cancelar" type="button" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-remove"></i> Cancelar</button> 
            <button id="btn-registerCliente" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>                                                    
        </div>
        </form>                 
      </div>              
    </div>
  </div>


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



