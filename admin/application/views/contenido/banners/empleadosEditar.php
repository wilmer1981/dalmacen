    <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-user-plus" aria-hidden="true"></i> Editar Usuario</span></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
            
                <div class="box-body">
					<div class="col-md-12" id="VerForm" style="display: block;">
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>
					<form role="form" action="<?php echo current_url(); ?>" name="frmEmpleado" id="frmEmpleado" method="post" enctype="multipart/form-data">
                      <div class="row">
					    <div class="col-md-12 left">
						   <div class="row">
								<div class="col-md-9">						   
									<fieldset class="scheduler-border">
									<legend class="scheduler-border">Datos Personales</legend>
										<div class="row">
											<div class="col-md-6">
											  <div class="form-group has-success">
												  <label for="inputMarca">Nombre:<span class="required">*</span></label>
												  <input id="txtNombre" type="text" name="txtNombre" required="" class="form-control" placeholder="Nombre" value="<?php echo $usuarios[0]->nombres; ?>">
											  </div>
											</div>
											<div class="col-md-6">
											  <div class="form-group has-success">
												  <input id="txtIdEmpleado" type="hidden" maxlength="50" class="form-control" name="txtIdEmpleado" placeholder="" autofocus="">
												  <label for="inputMarca">Apellidos:<span class="required">*</span></label>
												  <input id="txtApellidos" type="text" name="txtApellidos" required="" class="form-control" placeholder="Apellidos"  value="<?php echo $usuarios[0]->apellidos; ?>">
											  </div>
											</div>
										</div>
									    <div class="row">
										  <div class="col-md-6">
											  <div class="form-group has-success">
												  <label for="inputMarca">Tipo Documento:<span class="required">*</span></label>
												<select id="cboTipo_Documento" name="cboTipo_Documento" class="form-control" required>
												<option value="">-- SELECCIONE --</option>
													<?php foreach ($documentos as $t) {
													$documento = mb_strtoupper($t->documento, 'UTF-8'); 
													if($t->id==$usuarios[0]->tipo_documento){$select='selected';}else{$select='';}
																			echo '<option value="'.$t->id.'"'.$select.'>'.$documento.'</option>';
																	} ?>
																	  
												</select>
											  </div>
										  </div>
										  <div class="col-md-6">
											  <div class="form-group has-success">
												  <label for="inputMarca">Documento:<span class="required">*</span></label>
												  <input id="txtNum_Documento" type="text" maxlength="15" name="txtNum_Documento" required="" class="form-control" placeholder="Número de documento"  value="<?php echo $usuarios[0]->num_documento; ?>">
											  </div>
										  </div>
									    </div>
										
									</fieldset>
								</div>
								<div class="col-md-3">
<!--								
									<fieldset class="scheduler-border">
									<legend class="scheduler-border">Datos Personales</legend>
								 -->
									 <div class="form-group has-success">
									  <?php
									   $img = $usuarios[0]->url_imagen; 
													
										if($img)
											$image='uploads/'.$img;
										else
											$image='assets/images/image.png';
									  ?>
                                        <img class="img-thumbnail" style="width:170px;height:170px" src="<?php echo base_url($image); ?>" />
										<!--
										<input id="txtRutaImgPac" type="text" class="form-control" name="txtRutaImgPac" value="<?php echo $empleados[0]->url_imagen; ?>" readonly>
-->										
       
									</div>
									<!--
									</fieldset>
									-->
								</div>
                            </div> 
													  
                        </div>
                        <div class="col-md-12 left">
						
							<fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Contacto</legend>
							
								<div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Dirección:</label>
                                          <input id="txtDireccion" type="text" maxlength="100" name="txtDireccion" placeholder="Ingrese la dirección" class="form-control" value="<?php echo $usuarios[0]->direccion; ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Teléfono:</label>
                                          <input id="txtTelefono" type="text" maxlength="10" name="txtTelefono" class="form-control" placeholder="Ingrese el teléfono" value="<?php echo $usuarios[0]->telefono; ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Email: <span class="required">*</span></label>
                                          <input id="txtEmail" type="email" maxlength="70" name="txtEmail" class="form-control" placeholder="Ingrese el email" value="<?php echo $usuarios[0]->email; ?>" required>
                                      </div>
                                  </div>
                              </div>
								<div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Fecha Nacimiento:</label>
                                          <input id="txtFecha_Nac" type="date" name="txtFecha_Nac" class="form-control" value="<?php echo $usuarios[0]->fech_nac; ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-8">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Foto:</label>
                                          <input id="imagenUser" type="file" class="form-control filestyle" name="imagenUser" data-placeholder="Seleccione imagen" data-buttonText="" data-buttonName="btn-default" data-buttonBefore="true" data-size="md">
                                          <input id="txtRutaImg" type="text" class="form-control" name="txtRutaImg" value="<?php echo $empleados[0]->url_imagen; ?>" readonly>
                                      </div>
                                  </div>                              
                              </div>							  
                   
                            </fieldset>  
                        </div>
                     
                        <div class="col-md-12 left">
							<fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Confidenciales</legend>
							<div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group has-success">
                                        <label for="inputMarca">Tipo Usuario:<span class="required">*</span></label>                                    
                        				<select class="form-control" name="cboIdTipo" id="cboIdTipo" required>
                                        <option value="">-- SELECCIONE --</option>
											<?php foreach ($tipousers as $t) {
                                                if($t->idtipo==$usuarios[0]->nivel){$select='selected';}else{$select='';}
                      												  echo '<option value="'.$t->idtipo.'"'.$select.'>'.$t->nombre.'</option>';
                      							} ?>
										</select>
										
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group has-success">
                                         <label for="inputMarca">Permisos:<span class="required">*</span></label>
                  						<select class="form-control" name="cboIdPermiso" id="cboIdPermiso" required>
                                            <option value="">-- SELECCIONE --</option>
												<?php foreach ($permisos as $p) {
                                                if($p->idpermiso==$usuarios[0]->permisos_id){$select='selected';}else{$select='';}
                    													  echo '<option value="'.$p->idpermiso.'"'.$select.'>'.$p->nombre.'</option>';
                    							} ?>
                  						</select>							
                                      </div>
                                  </div>
                              </div>
							<div class="row">                              
                                  <div class="col-md-6 left">
                                      <div class="form-group has-success">
                                          <label for="inputInscripcion">Login: </label>
                                          <input id="txtLogin" type="text" class="form-control" maxlength="50" name="txtLogin" value="<?php echo $usuarios[0]->login; ?>">

                                      </div>
                                  </div>
                                  <div class="col-md-6 left">
                                      <div class="form-group">
                                          <div class="form-group has-success">
                                              <label for="inputInscripcion">Password</label>
                                              <input id="txtPassword" type="text" class="form-control" maxlength="32" name="txtPassword" placeholder="Dejar en blanco si no deseas cambiar.">
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
						<div class="col-md-12 left">
							<div class="botones">                             
                           
                            <a href="<?php echo base_url('usuarios')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>

                             <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Modificar</button>
                                                     
							</div> 
          				</div>
          			</div>
                </div>          
        </form>
    </div>




