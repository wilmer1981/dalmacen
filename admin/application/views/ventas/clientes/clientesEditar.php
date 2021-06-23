    <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar Cliente</span></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
            
          <div class="box-body spacio-no-full">
					<div class="col-sm-12 spacio-no-full">
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>
					<form role="form" action="<?php echo current_url(); ?>" name="frmCliente" id="frmCliente" method="post" enctype="multipart/form-data" class="form-horizontal">
            <?php echo form_hidden('cliente_id',$cliente->id) ?>
              <div class="form-action spacing-bottom"> 
                  <div class="form-group">          
                      <div class="col-md-12">     
                          <div class="col-md-12 col-md-offset-2">               
                          <label class="col-md-2  control-label">Categoria del cliente:</label>
                           <div class="col-md-6">
                            <label class="radio-inline"> <input type="radio" name="categoria" id="categoria" value="MIN" <?php if($cliente->id_tipocliente=='1'){ echo "checked=true";}else{ echo "disabled=true";}?>> Persona Natural </label>
                            <label class="radio-inline"> <input type="radio" name="categoria" id="categoria" value="MAY" <?php if($cliente->id_tipocliente=='2'){ echo "checked=true";}else{ echo "disabled=true";}?>> Empresa </label>
                          </div>            
                                    </div>
                      </div>
                </div>
              </div>     

              <!-- Section Persona Natural -->
              <div class="row form-minorista" <?php if($cliente->id_tipocliente=='1'){?> style="display:display" <?php }else{?> style="display:none"  <?php  } ?> >
              
               <div class="col-md-6">
                          <div class="form-group">
                              <label for="nomeCliente" class="col-md-4 control-label">Nombre<span class="required">*</span></label>               
                              <div class="col-md-6">
                                  <input class="form-control" id="txtNombre" type="text" name="txtNombre" value="<?php echo $cliente->nombres; ?>"  />
                              </div>
                          </div>
                <div class="form-group">
                              <label for="nomeCliente" class="col-md-4 control-label">Apellidos<span class="required">*</span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtApellido" type="text" name="txtApellido" value="<?php echo $cliente->apellidos; ?>"  />
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Tipo Documento<span class="required"></span></label>
                              <div class="col-md-6">
                                <select id="cboTipoDocumento" name="cboTipoDocumento" class="form-control">
                                    <option value=''>-- Seleccione --</option>
                                    <?php 
                                      foreach ($documentos as $t) {
                                        $documento = mb_strtoupper($t->documento, 'UTF-8'); 
                                        if($t->id == $cliente->id_tipodoc){ $selected = 'selected';}else{$selected = '';}
                                          echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
                                        } 
                                    ?>    

                                    <?php 
                                    /*
                                    foreach ($documentos as $t) {
                                      if($t->id == 5){ 
                                          $selected = 'selected'; 
                                          $disabled='';
                                      }else{
                                          $selected = ''; 
                                          $disabled='disabled';
                                      }  

                                      $documento = mb_strtoupper($t->documento, 'UTF-8'); 
                                      echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
                                    } 
                                    */

                                    ?>                                            
                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="nomeCliente" class="col-md-4 control-label">Num. Documento<span class="required">*</span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtNumDoc" type="text" name="txtNumDoc" value="<?php echo $cliente->num_documento; ?>"  />
                              </div>
                          </div>


                          <div class="form-group">
                              <label for="documento" class="col-md-4 control-label">Telefono<span class="required"></span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtTelefono" type="text" name="txtTelefono" value="<?php echo $cliente->telefono; ?>"  />
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="documento" class="col-md-4 control-label">Celular<span class="required"></span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtCelular" type="text" name="txtCelular" value="<?php echo $cliente->celular; ?>"  />
                              </div>
                          </div>


           
                 </div>
                
                 <div class="col-md-6 div-vertical">

                          <div class="form-group">
                              <label for="numero" class="col-md-4 control-label">Direccion<span class="required"></span></label>
                              <div class="col-md-6">              
                                  <input class="form-control" id="txtDireccion" type="text" name="txtDireccion" value="<?php echo $cliente->direccion; ?>"  />                   
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Departamento<span class="required"></span></label>
                              <div class="col-md-6">
                                <select class="form-control" id="cboDpto" type="text" name="cboDpto"  >
                                 <option value=''>-- Seleccione Departamento --</option>
                                  <?php 
                                  foreach($dptos as $fila ){  
                                      if($fila->CodDpto == $cliente->CodDpto){ $selected = 'selected';}else{$selected = '';}
                                      
                                      echo '<option value="'.$fila->CodDpto.'"'.$selected.'>'.$fila->Nombre.'</option>';
                                  }               
                                  ?>                  
                            
                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Provincia<span class="required"></span></label>
                              <div class="col-md-6">
                                <select class="form-control" id="cboProv" type="text" name="cboProv"  >
                                 <!--<option value=''>-- Seleccione Provincia --</option>
                                 -->
                                 <!--
                                 <option value='<?php echo $cliente->CodProv; ?>' selected><?php echo $cliente->CodProv; ?></option>
                                 -->
                                 <?php 
                                  foreach($provincias as $fila ){  
                                      if($fila->CodProv == $cliente->CodProv){ $selected = 'selected';}else{$selected = '';}
                                      
                                      echo '<option value="'.$fila->CodProv.'"'.$selected.'>'.$fila->Nombre.'</option>';
                                  }               
                                  ?>  


                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Distrito<span class="required"></span></label>
                              <div class="col-md-6">
                                <select class="form-control" id="cboDist" type="text" name="cboDist"  >
                                 <!--<option value=''>-- Seleccione Distrito --</option>
                                 --> 
                                 <!--
                                  <option value='<?php echo $cliente->CodUbigeo; ?>' selected><?php echo $cliente->CodUbigeo; ?></option>
                                  -->
                                  <?php 
                                  foreach($distritos as $fila ){  
                                      if($fila->CodUbigeo == $cliente->CodUbigeo){ $selected = 'selected';}else{$selected = '';}
                                      
                                      echo '<option value="'.$fila->CodUbigeo.'"'.$selected.'>'.$fila->Nombre.'</option>';
                                  }               
                                  ?>                                             
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="direccion" class="col-md-4 control-label">E-mail<span class="required">*</span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtEmail" type="text" name="txtEmail" value="<?php echo $cliente->email; ?>"  />
                              </div>
                          </div>

                </div>
              </div> 
              <!-- End Section Persona Natural --> 

              <!-- Section Empresas -->
              <div class="row form-mayorista" <?php if($cliente->id_tipocliente=='2'){?> style="display:display" <?php }else{?> style="display:none"  <?php  } ?>>
                <div class="col-lg-6 left">
                        <fieldset class="fsStyle">  
                          
                            <legend class="legendStyle">
                              <a data-toggle="collapse" data-target="#demo" href="#">Datos de la Empresa</a>
                            </legend>
                            <div class="row collapse in" id="demo">
                               <div class="col-md-12">
                                   <div class="form-group ">
                                        <label for="nomeCliente" class="col-md-4 control-label">Razon Social<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="txtRazonsocial" type="text" name="txtRazonsocial" value="<?php echo $cliente->razon_social; ?>">
                                        </div>
                                    </div>
                              <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Tipo Documento<span class="required"></span></label>
                              <div class="col-md-6">
                                <select id="cboTipoDocumentos" name="cboTipoDocumentos" class="form-control">
                                <option value=''>-- Seleccione --</option>
                                      <?php 
                                      foreach ($documentos as $t) {
                                        $documento = mb_strtoupper($t->documento, 'UTF-8'); 
                                        if($t->id == $cliente->id_tipodoc){ $selected = 'selected';}else{$selected = '';}
                                          echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
                                        } 
                                    ?>    



                                        <?php 
                                        /*
                                          foreach ($documentos as $t) {
                                          $documento = mb_strtoupper($t->documento, 'UTF-8');
                                          if($t->id == 8){ 
                                              $selected = 'selected'; 
                                              $disabled='';
                                          }else{
                                              $selected = ''; 
                                              $disabled='disabled';
                                          }                                     
                                          echo '<option value="'.$t->id.'"'.$selected.''.$disabled.'>'.$documento.'</option>';
                                            
                                
                                        }*/
                                         ?>
                                          
                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="nomeCliente" class="col-md-4 control-label">Num. Documento<span class="required"></span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtNumDocs" type="text" name="txtNumDocs" value="<?php echo $cliente->num_documento; ?>"  />
                              </div>
                          </div>

                              <div class="form-group">
                                  <label for="direccion" class="col-md-4 control-label">Direccion<span class="required"></span></label>
                                  <div class="col-md-8">
                                      <input class="form-control" id="txtDireccions" type="text" name="txtDireccions" value="<?php echo $cliente->direccion; ?>">
                                  </div>
                              </div>             

                              <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Departamento<span class="required"></span></label>
                              <div class="col-md-7">
                                <select class="form-control" id="cboDptos" type="text" name="cboDptos"  >
                                 <!--
                                 <option value=''>-- Seleccione Departamento --</option>
                                 -->
                                  <?php 
                                  foreach($dptos as $fila ){  
                                      if($fila->CodDpto == $cliente->CodDpto){ $selected = 'selected';}else{$selected = '';}
                                      
                                      echo '<option value="'.$fila->CodDpto.'"'.$selected.'>'.$fila->Nombre.'</option>';
                                  }               
                                  ?>              
                            
                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Provincia<span class="required"></span></label>
                              <div class="col-md-7">
                                <select class="form-control" id="cboProvs" type="text" name="cboProvs"  >
                                 <!--
                                 <option value=''>-- Seleccione Provincia --</option> 
                                  -->
                                  <?php 
                                  foreach($provincias as $fila ){  
                                      if($fila->CodProv == $cliente->CodProv){ $selected = 'selected';}else{$selected = '';}
                                      
                                      echo '<option value="'.$fila->CodProv.'"'.$selected.'>'.$fila->Nombre.'</option>';
                                  }               
                                  ?>  

                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Distrito<span class="required"></span></label>
                              <div class="col-md-7">
                                <select class="form-control" id="cboDists" type="text" name="cboDists"  >
                                 <!--
                                 <option value=''>-- Seleccione Distrito --</option>  
                                 -->    
                                            <?php 
                                  foreach($distritos as $fila ){  
                                      if($fila->CodUbigeo == $cliente->CodUbigeo){ $selected = 'selected';}else{$selected = '';}
                                      
                                      echo '<option value="'.$fila->CodUbigeo.'"'.$selected.'>'.$fila->Nombre.'</option>';
                                  }               
                                  ?>                                        
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
                                    <div class="form-group">
                                        <label for="direccion" class="col-md-4 control-label">URL Web<span class="required"></span></label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="txtWeb" type="text" name="txtWeb" value="<?php echo $cliente->url_web; ?>">
                                        </div>
                                    </div>               
                         
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
                                            <input class="form-control" id="txtNombres" type="text" name="txtNombres" value="<?php echo $cliente->cont_nombre; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="documento" class="col-md-4 control-label">Apellidos<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="txtApellidos" type="text" name="txtApellidos" value="<?php echo $cliente->cont_apellido; ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-md-4 control-label">E-mail<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="txtEmails" type="text" name="txtEmails" value="<?php echo $cliente->cont_email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-md-4 control-label">Telefono<span class="required"></span></label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="txtTelefonos" type="text" name="txtTelefonos" value="<?php echo $cliente->cont_telefono; ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion" class="col-md-4 control-label">Celular<span class="required"></span></label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="txtCelulars" type="text" name="txtCelulars" value="<?php echo $cliente->cont_celular; ?>" >
                                        </div>
                                    </div>                            
                             
                              </div>        
                            </div>                           
                     
                        </fieldset>
                </div>
                
              </div> 
              <!-- End Section Empresas -->          
          </div>      
      </div>                
       <div class="box-footer no-padding">
                    <div class="row">
          						<div class="col-lg-12 left">
                          <div class="form-action"> 
                              <div class="form-group"> 
                                  <div class="botones">                             
                                    <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Modificar</button>
                                    <a href="<?php echo base_url('clientes')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>
                                             
                                  </div>          
                           
                            </div>
                          </div>
                      <!--
          						 <div class="botones">                             
                            <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Registrar</button>
                            <a href="<?php echo base_url('proveedores')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>
                                     
                       </div> 
                       -->
          						</div>
					        </div>



        </div>
          
        </form>
    </div>




