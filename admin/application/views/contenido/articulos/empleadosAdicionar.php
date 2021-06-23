    <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar Usuario</span></h3>
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
					<form role="form" action="<?php echo current_url(); ?>" name="frmEmpleado" id="frmEmpleado" method="post" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-lg-12 left">
						   <div class="row">
								<div class="col-md-9">						   
									<fieldset class="scheduler-border">
									<legend class="scheduler-border">Datos Personales</legend>
				
				
									  <div class="row">
										  <div class="col-xs-6">
											  <div class="form-group has-success">
												  <label for="inputMarca">Nombre :<span class="required">*</span></label>
												  <input id="txtNombre" type="text" maxlength="20" name="txtNombre" required="" class="form-control" placeholder="Nombre" autofocus="">
											  </div>
										  </div>
										  <div class="col-xs-6">
											  <div class="form-group has-success">
												  <input id="txtIdEmpleado" type="hidden" maxlength="50" class="form-control" name="txtIdEmpleado" placeholder="" autofocus="">
												  <label for="inputMarca">Apellidos :<span class="required">*</span></label>
												  <input id="txtApellidos" type="text" maxlength="40" name="txtApellidos" required="" class="form-control" placeholder="Apellidos" autofocus="">
											  </div>
										  </div>
									</div> 
									<div class="row">
                                  <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Tipo Documento :<span class="required">*</span></label>
                                        <select id="cboTipo_Documento" name="cboTipo_Documento" class="form-control" required>
										    <option value="">-- SELECCIONE --</option>
                                    		<?php foreach ($documentos as $t) {
													$documento = mb_strtoupper($t->documento, 'UTF-8');
													 if($t->id == 5){ 
														  $selected = 'selected'; 
														  $disabled='';
													  }else{
														  $selected = ''; 
														  $disabled='disabled';
													  }  
													echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
                  								} ?>
                  											  
                                        </select>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Documento :<span class="required">*</span></label>
                                          <input id="txtNum_Documento" type="text" maxlength="15" name="txtNum_Documento" required="" class="form-control" placeholder="Número de documento" autofocus="">
                                      </div>
                                  </div>
                              </div>
							  </fieldset>
									  
                            </div>
							<div class="col-md-3">
									 <div class="form-group has-success">
									  <?php
										$image='assets/images/image.png';
									  ?>
                                        <img class="img-thumbnail" style="width:170px;height:170px" src="<?php echo base_url($image); ?>" />
		
									</div>
							
							</div>
						</div>
                    
                          <div class="col-lg-12 left">
						  	<fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Contacto</legend>
							
							
                              <div class="row">
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Dirección:</label>
                                          <input id="txtDireccion" type="text" maxlength="100" name="txtDireccion" placeholder="Ingrese la dirección" class="form-control" autofocus="">
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Teléfono:</label>
                                          <input id="txtTelefono" type="text" maxlength="10" name="txtTelefono" class="form-control" placeholder="Ingrese el teléfono" autofocus="">
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Email: <span class="required">*</span></label>
                                          <input id="txtEmail" type="email" maxlength="70" name="txtEmail" class="form-control" placeholder="Ingrese el email" required>
                                      </div>
                                  </div>
                              </div>
							               <div class="row">
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Fecha Nacimiento:</label>
                                          <input id="txtFecha_Nac" type="date" maxlength="150" name="txtFecha_Nac" class="form-control" >
                                      </div>
                                  </div>
                                  <div class="col-xs-8">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Foto:</label>
                                        <input id="imagenUser" type="file" class="form-control filestyle" name="imagenUser" autofocus="" data-placeholder="Seleccione imagen" data-buttonText="Buscar imagen" data-buttonName="btn-default" data-buttonBefore="true" data-size="md">                                                          

                                      </div>
                                  </div>
         
                              </div>
							  </fieldset> 
                              
                          </div>                   
						  
						<div class="col-lg-12 left">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Confidenciales</legend>
		
                              <div class="row">
                                  <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Tipo Usuario :<span class="required">*</span></label>                                    
                        										 <select class="form-control" name="cboIdTipo" id="cboIdTipo" 	required>
                                             <option value="">-- SELECCIONE --</option>
                        											  <?php foreach ($tipousers as $t) {
                        												  echo '<option value="'.$t->idtipo.'">'.$t->nombre.'</option>';
                        											  } ?>
                        										</select>
										
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                    <div class="form-group has-success">
                                          <label for="inputMarca">Permisos :<span class="required">*</span></label>
                  										   <select class="form-control" name="cboIdPermiso" id="cboIdPermiso" required>
                                          <option value="">-- SELECCIONE --</option>

                  												  <?php foreach ($permisos as $p) {
                  													  echo '<option value="'.$p->idpermiso.'">'.$p->nombre.'</option>';
                  												  } ?>
                  											</select>							
                                      </div>
                                  </div>
                              </div>
							<div class="row">                              
                                  <div class="col-xs-6 left">
                                      <div class="form-group has-success">
                                          <label for="inputInscripcion">Login :<span class="required">*</span></label>
                                          <input id="txtLogin" type="text" class="form-control" required="" maxlength="50" name="txtLogin" autofocus="">

                                      </div>
                                  </div>
                                  <div class="col-xs-6 left">
                                      <div class="form-group">
                                          <div class="form-group has-success">
                                              <label for="inputInscripcion">Password :<span class="required">*</span></label>
                                              <input id="txtPassword" type="text" required="" class="form-control" maxlength="32" name="txtPassword" autofocus="">
                                              <input id="txtClaveOtro" type="text" class="form-control" maxlength="32" name="txtClaveOtro" autofocus="" style="display: none;">
                                          </div>
                                      </div>
                                  </div>
                               
                              </div>
							  
							  </fieldset>
                              
                          </div>								  
						  
                      </div>           
                  </div>      
                </div>                
                <div class="box-footer no-padding">
                    <div class="row">
						<div class="col-lg-12 left">
						 <div class="botones">   
              <a href="<?php echo base_url('usuarios')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>                          
                                  <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Registrar</button>
                                 
                                           
                             </div> 
						</div>
					</div>
                </div>
          
                </form>
    </div>




