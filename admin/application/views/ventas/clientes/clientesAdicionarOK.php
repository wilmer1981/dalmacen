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
              <div class="form-action spacing-bottom"> 
                  <div class="form-group">          
                      <div class="col-md-12">     
                          <div class="col-md-12 col-md-offset-2">
                          <input class="form-control" id="txtCodigo" type="hidden" name="txtCodigo" value="<?php echo 'C'.$correlativo; ?>"  />               
                          <label class="col-md-2  control-label">Categoria del cliente:</label>
                           <div class="col-md-6">
                            <label class="radio-inline"> <input type="radio" name="categoria" id="categoria" value="MIN" checked> Persona Natural </label>
                            <label class="radio-inline"> <input type="radio" name="categoria" id="categoria" value="MAY"> Empresa </label>
                          </div>            
                                    </div>
                                </div>
                </div>
              </div>

              <!-- Section Persona Natural -->
              <div class="row form-minorista">
               <div class="col-md-6">
                          <div class="form-group">
                              <label for="nomeCliente" class="col-md-4 control-label">Nombre<span class="required">*</span></label>               
                              <div class="col-md-6">
                                  <input class="form-control" id="txtNombre" type="text" name="txtNombre" value="<?php echo set_value('nombre'); ?>"  />
                              </div>
                          </div>
                <div class="form-group">
                              <label for="nomeCliente" class="col-md-4 control-label">Apellidos<span class="required">*</span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtApellido" type="text" name="txtApellido" value="<?php echo set_value('apellido'); ?>"  />
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Tipo Documento<span class="required"></span></label>
                              <div class="col-md-6">
                                <select id="cboTipoDocumento" name="cboTipoDocumento" class="form-control">
                                    <option value=''>-- Seleccione --</option>
                                    <?php foreach ($documentos as $t) {
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
                              <label for="nomeCliente" class="col-md-4 control-label">Num. Documento<span class="required">*</span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtNumDoc" type="text" name="txtNumDoc" value="<?php echo set_value('NumDoc'); ?>"  />
                              </div>
                          </div>


                          <div class="form-group">
                              <label for="documento" class="col-md-4 control-label">Telefono<span class="required"></span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtTelefono" type="text" name="txtTelefono" value="<?php echo set_value('telefono'); ?>"  />
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="documento" class="col-md-4 control-label">Celular<span class="required"></span></label>
                              <div class="col-md-6">
                                  <input class="form-control" id="txtCelular" type="text" name="txtCelular" value="<?php echo set_value('celular'); ?>"  />
                              </div>
                          </div>


           
                 </div>
                
                 <div class="col-md-6 div-vertical">

                          <div class="form-group">
                              <label for="numero" class="col-md-4 control-label">Direccion<span class="required"></span></label>
                              <div class="col-md-6">              
                                  <input class="form-control" id="txtDireccion" type="text" name="txtDireccion" value="<?php echo set_value('direccion'); ?>"  />                   
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Departamento<span class="required"></span></label>
                              <div class="col-md-6">
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
                              <div class="col-md-6">
                                <select class="form-control" id="cboProv" type="text" name="cboProv"  >
                                 <option value=''>-- Seleccione Provincia --</option>                                            
                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Distrito<span class="required"></span></label>
                              <div class="col-md-6">
                                <select class="form-control" id="cboDist" type="text" name="cboDist"  >
                                 <option value=''>-- Seleccione Distrito --</option>                                            
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="direccion" class="col-md-4 control-label">E-mail<span class="required">*</span></label>
                              <div class="col-md-6">
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
                                        <div class="col-md-8">
                                            <input class="form-control" id="txtRazonsocial" type="text" name="txtRazonsocial" value="">
                                            <!--
                                            <input class="form-control" id="txtRUC" type="text" name="txtRUC" value="">
                                            -->
                                            <button type="button" class="btn btn-success" id="btnBuscarRUC"><i class="fa fa-search"></i>
                                                    Buscar
                                              </button>
                                        </div>
                                    </div>
                              <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Tipo Documento<span class="required"></span></label>
                              <div class="col-md-6">
                                <select id="cboTipoDocumentos" name="cboTipoDocumentos" class="form-control">
                                <option value=''>-- Seleccione --</option>

                                        <?php foreach ($documentos as $t) {
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
                              <label for="nomeCliente" class="col-md-4 control-label">Num. Documento<span class="required"></span></label>
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
                              <div class="col-md-7">
                                <select class="form-control" id="cboDptos" type="text" name="cboDptos"  >
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
                              <div class="col-md-7">
                                <select class="form-control" id="cboProvs" type="text" name="cboProvs"  >
                                 <option value=''>-- Seleccione Provincia --</option>                                            
                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="rua" class="col-md-4 control-label">Distrito<span class="required"></span></label>
                              <div class="col-md-7">
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
                                    <div class="form-group">
                                        <label for="direccion" class="col-md-4 control-label">URL Web<span class="required"></span></label>
                                        <div class="col-md-8">
                                            <input class="form-control" id="txtWeb" type="text" name="txtWeb" value="">
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
                                        <label for="direccion" class="col-md-4 control-label">E-mail<span class="required">*</span></label>
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
                                    <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Registrar</button>
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




