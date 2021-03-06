    <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><span class="icon"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar Empleado</span></h3>
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
                                  <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Nombre:</label>
                                          <input id="txtNombre" type="text" maxlength="20" name="txtNombre" required="" class="form-control" placeholder="Nombre" autofocus="">
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <input id="txtIdEmpleado" type="hidden" maxlength="50" class="form-control" name="txtIdEmpleado" placeholder="" autofocus="">
                                          <label for="inputMarca">Apellidos:</label>
                                          <input id="txtApellidos" type="text" maxlength="40" name="txtApellidos" required="" class="form-control" placeholder="Apellidos" autofocus="">
                                      </div>
                                  </div>

                              </div>                              
                          </div>
                          <div class="col-lg-12 left">
                              <div class="row">
                                  <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Tipo Documento:</label>
                                        <select id="cboTipo_Documento" name="cboTipo_Documento" class="form-control">
                                    		<?php foreach ($documentos as $t) {
													  echo '<option value="'.$t->id.'">'.strtoupper($t->documento).'</option>';
											} ?>
											  
                                        </select>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Documento:</label>
                                          <input id="txtNum_Documento" type="text" maxlength="15" name="txtNum_Documento" required="" class="form-control" placeholder="N??mero de documento" autofocus="">
                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                          <div class="col-lg-12 left">
                              <div class="row">
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Direcci??n:</label>
                                          <input id="txtDireccion" type="text" maxlength="100" name="txtDireccion" placeholder="Ingrese la direcci??n" class="form-control" autofocus="">
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Tel??fono:</label>
                                          <input id="txtTelefono" type="text" maxlength="10" name="txtTelefono" required="" class="form-control" placeholder="Ingrese el tel??fono" autofocus="">
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Email:</label>
                                          <input id="txtEmail" type="email" maxlength="70" name="txtEmail" class="form-control" placeholder="Ingrese el email" autofocus="">
                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                          <div class="col-lg-12 left">
                              <div class="row">
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Fecha Nacimiento:</label>
                                          <input id="txtFecha_Nacimiento" type="date" maxlength="150" name="txtFecha_Nacimiento" class="form-control" autofocus="">
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Foto:</label>
                                          <input id="imagenEmp" type="file" class="form-control" name="imagenEmp" autofocus="">
                                      <input id="txtRutaImgEmp" type="text" class="form-control" name="txtRutaImgEmp" autofocus="">
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Estado:</label>
                                          <select class="form-control" name="txtEstado" id="txtEstado">
                                            <option value="A">A</option>
                                            <option value="C">C</option>
                                            <option value="S">S</option>
                                          </select>
                                      </div>
                                  </div>
                                  <!--
                                  <div class="col-lg-6 left">
                                      <div class="form-group has-success">
                                          <label for="inputInscripcion">Login</label>
                                          <input id="txtLogin" type="text" class="form-control" required="" maxlength="50" name="txtLogin" autofocus="">

                                      </div>
                                  </div>

                                  <div class="col-lg-6 left">
                                      <div class="form-group">
                                          <div class="form-group has-success">
                                              <label for="inputInscripcion">Clave</label>
                                              <input id="txtClave" type="text" required="" class="form-control" maxlength="32" name="txtClave" autofocus="">
                                              <input id="txtClaveOtro" type="text" class="form-control" maxlength="32" name="txtClaveOtro" autofocus="" style="display: none;">
                                          </div>
                                      </div>
                                  </div>
                                  -->
                              </div>
                              
                          </div>
                      </div>           
                  </div>      
                </div>                
                <div class="box-footer no-padding">
                    <div class="row">
						<div class="col-lg-12 left">
                                  <h5></h5>
                                  <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Registrar</button>
                                  <a href="<?php echo base_url('empleados')?>" class="btn btn-primary"><i class="fa fa-remove"></i> Cancelar</a>
                                  <hr>
                                  <span class="lead text-primary"></span>                
                              
						</div>
					</div>
                </div>
          
                </form>
    </div>




