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
					<form role="form" action="<?php echo current_url(); ?>" name="frmUsuario" id="frmUsuario" method="post" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-md-12 left">
                              <div class="row">
                                  <div class="col-md-6">
                      									<div class="form-group has-success">                      						
                      										<label for="inputMarca">Trabajador:</label>										
                      										<div class="input-group has-success">
                      											<input id="txtIdEmpleado" type="hidden" class="form-control" name="txtIdEmpleado" required="" value="<?php echo $usuarios[0]->id_empleado; ?>">
                      											<input id="txtEmpleado" type="text" class="form-control" name="txtEmpleado" required="" placeholder="Seleccione un Trabajador"  value="<?php echo $usuarios[0]->nombres.' '.$usuarios[0]->apellidos; ?>" disabled="">
                                            <!--
                      											<span class="input-group-btn">
                      												  <button type="button" class="btn btn-success" id="btnBuscarTrabajador"><i class="fa fa-search" disabled=""></i>
                      																Buscar
                      												  </button>
                      											</span>
                                            -->
                      										</div>   
                      									</div>						
                                  </div>   

                              </div>                              
                          </div>
                          <div class="col-md-12 left">
                              <div class="row">
                                  <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Tipo Usuario:</label>                                    
											<select class="form-control" name="cboIdTipo" id="cboIdTipo">
                                             <option value="">-- SELECCIONE --</option>
                      							<?php foreach ($tipousers as $t) {
                                                if($t->idtipo==$usuarios[0]->nivel){$select='selected';}else{$select='';}
                      												  echo '<option value="'.$t->idtipo.'"'.$select.'>'.$t->nombre.'</option>';
                      							} ?>
                      						</select>
										
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                    <div class="form-group has-success">
                                          <label for="inputMarca">Permisos:</label>
                    										   <select class="form-control" name="cboIdPermiso" id="cboIdPermiso">
                                           <option value="">-- SELECCIONE --</option>
                    							<?php foreach ($permisos as $p) {
                                                if($p->idpermiso==$usuarios[0]->permisos_id){$select='selected';}else{$select='';}
                    													  echo '<option value="'.$p->idpermiso.'"'.$select.'>'.$p->nombre.'</option>';
                    							} ?>
                    					</select>							
                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                          <div class="col-md-12 left">
                              <div class="row">                              
                                  <div class="col-xs-6 left">
                                      <div class="form-group has-success">
                                          <label for="inputInscripcion">Login</label>
                                          <input id="txtLogin" type="text" class="form-control" required="" name="txtLogin" autofocus="" value="<?php echo $usuarios[0]->login; ?>">

                                      </div>
                                  </div>
                                  <div class="col-xs-6 left">
                                      <div class="form-group">
                                          <div class="form-group has-success">
                                              <label for="inputInscripcion">Password</label>
                                              <input id="txtPassword" type="text" class="form-control" maxlength="32" name="txtPassword" placeholder="Dejar en blanco si no deseas cambiar.">
                                              <input id="txtClaveOtro" type="text" class="form-control" maxlength="32" name="txtClaveOtro" autofocus="" style="display: none;">
                                          </div>
                                      </div>
                                  </div>
                               
                              </div>
                              
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
	<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_search" role="dialog" aria-hidden="true"></div>
<div class="modal fade" id="modal_form_isearch" role="dialog" aria-hidden="true"></div>





