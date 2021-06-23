    <div class="box box-default">
			<div class="box-header with-border">
            <h3 class="box-title"><span class="icon"><i class="fa fa-th-list" aria-hidden="true"></i> Menu : Nuevo Item</span></h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>					
			</div>
		<form role="form" action="<?php echo current_url(); ?>" name="frmEmpleado" id="frmEmpleado" method="post" enctype="multipart/form-data">
                     
			<div class="row">
						<div class="col-md-12 background-header">
							<div class="botones der">   
								<a href="<?php echo base_url('menu')?>" class="btn btn-primary "><i class="fa fa-remove"></i> Cancelar</a>                          
								  <button class="btn btn-success " type="submit"><i class="fa fa-floppy-o"></i> Guardar</button>
							</div> 
						</div>
			</div>			
		         
            <div class="box-body">
					
					<div class="col-md-12" id="VerForm" style="display: block;">
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>
					 <div class="row">
                          <div class="col-lg-12 left">
						   <div class="row">
								<div class="col-md-9">						   
									<fieldset class="scheduler-border">
									<legend class="scheduler-border"></legend>
				
				
									   <div class="row">
										  <div class="col-md-12">
											  <div class="form-group has-success">
												  <label for="inputMarca">Titulo Menu :<span class="required">*</span></label>
												  <input id="txtTitulo" type="text" maxlength="20" name="txtTitulo" required="" class="form-control" placeholder="Nombre" autofocus="">
											  </div>
										  </div>
										</div>
										<div class="row"> 
										  <div class="col-md-6">
											  <div class="form-group has-success">
												  <input id="txtIdEmpleado" type="hidden" maxlength="50" class="form-control" name="txtIdEmpleado" placeholder="" autofocus="">
												  <label for="inputMarca">Alias  :<span class="required">*</span></label>
												  <input id="txtAlias" type="text" maxlength="40" name="txtAlias" required="" class="form-control" placeholder="Generar automáticamente desde el título" >
											  </div>
										  </div>
										        <div class="col-md-6">
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Tipo Item :<span class="required">*</span></label>
                                        <select id="cboTipoItem" name="cboTipoItem" class="form-control" required>
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
									</div> 
								<div class="row">
                            
								    <div class="col-md-12">
                      									<div class="form-group has-success">
                      										<input id="txtIdUsuario" type="hidden" maxlength="50" class="form-control" name="txtIdUsuario" required="" placeholder="" autofocus="">
                      										<label for="inputMarca">Seleccione Articulo:</label>										
                      										<div class="input-group has-success">
                      											<input id="txtIdEmpleado" type="hidden" class="form-control" name="txtIdEmpleado" required="" placeholder="" autofocus="">
                      											<input id="txtEmpleado" type="text" class="form-control" name="txtEmpleado" required="" placeholder="Seleccione un Articulo" autofocus="" disabled="">
                      											<span class="input-group-btn">
                      												  <button type="button" class="btn btn-success" id="btnBuscarArt"><i class="fa fa-search"></i>
                      																Buscar
                      												  </button>
                      											</span>
                      										</div>   
                      									</div>						
                                  </div> 
							
                              </div>
							  </fieldset>
									  
                            </div>
							<div class="col-md-3">
							  <fieldset class="scheduler-border">
									<legend class="scheduler-border"></legend>
									<div class="row">
										<div class="col-md-12">
							     
                                      <div class="form-group has-success">
                                          <label for="inputMarca">Menu:<span class="required">*</span></label>
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
										<div class="form-group has-success">
                                          <label for="inputMarca">Elemento Padre:<span class="required">*</span></label>
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
									<div class="form-group has-success">
                                          <label for="inputMarca">Status:<span class="required">*</span></label>
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
									 </div> 
									</fieldset>					  
						
							
							</div>
						</div>              
              								  
						  
                      </div>           
                  </div>      
                </div> 
			</div>
                <!--
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
				-->
          
        </form>
	</div>
		<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_search" role="dialog" aria-hidden="true"></div>
<div class="modal fade" id="modal_form_isearch" role="dialog" aria-hidden="true"></div>


  




