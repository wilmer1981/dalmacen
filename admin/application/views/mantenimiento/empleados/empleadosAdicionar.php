 <div class="page-content">
    <div class="page-header">
        <h1>Adicionar
            <small><i class="ace-icon fa fa-angle-double-right"></i>Usuario</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-usuario" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>		
    </div>
	

	<div class="row">	
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>	
		
		<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-usuario" class="form-vertical">
		
		<div class="col-md-9">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#seccionA">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							Datos Generales
						</a>
					</li>
					<li>
						<a data-toggle="tab" href="#sectionB">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							Datos Contacto                                                    
						</a>
					</li>
					<li>
						<a data-toggle="tab" href="#sectionC">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							Cuenta Usuario                                                    
						</a>
					</li>				

				</ul>						
				
				<div class="tab-content">
					<div id="seccionA" class="tab-pane fade in active">   
						<div class="row">
							<div class="col-md-12 left">
													   
									<fieldset class="scheduler-border">
									<legend class="scheduler-border">Datos Personales</legend>
								
									<div class="row">
										  <div class="col-md-6">
											  <div class="form-group required">
												  <label class="control-label" for="inputMarca">Nombre :</label>
												 
												  <input id="txtNombres" type="text" maxlength="20" name="txtNombres" required="" class="form-control" placeholder="Nombre" autofocus="">
												
											  </div>
										  </div>									
										  <div class="col-md-6">
											  <div class="form-group required">
												  <label class="control-label" for="inputMarca">Apellidos :</label>
												
												  <input id="txtApellidos" type="text" maxlength="40" name="txtApellidos" required="" class="form-control" placeholder="Apellidos">
												
											  </div>
										  </div>
									</div> 
									<div class="row">
										<div class="col-md-6">
										  <div class="form-group">
											<label class="control-label" for="inputMarca">Tipo Doc.</label>
											
											<select id="cboTipoDoc" name="cboTipoDoc" class="form-control">
												<option value="">-- SELECCIONE --</option>
												<?php foreach ($documentos as $t) {
														$documento = mb_strtoupper($t->titulo, 'UTF-8');
														 if($t->id == 1){ 
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
										<div class="col-md-6">
										  <div class="form-group">
											  <label class="control-label" for="inputMarca">Num.Doc </label>											
											  <input id="txtNumDoc" type="text" maxlength="15" name="txtNumDoc" required="" class="form-control" placeholder="Número de documento">
											
										  </div>
										</div>
									</div>
									  
							  </fieldset>									  
                           					
							</div>		  
						</div>           
					</div>										 
					<div id="sectionB" class="tab-pane fade">
						<div class="row">					                 
                          <div class="col-md-12 left">
						  	<fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Contacto</legend>
							
							
                              <div class="row">
                                  <div class="col-md-8">
                                      <div class="form-group">
                                          <label class="control-label" for="inputMarca">Dirección:</label>
                                          <input id="txtDireccion" type="text" maxlength="100" name="txtDireccion" placeholder="Ingrese la dirección" class="form-control">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label" for="inputMarca">Teléfono:</label>
                                          <input id="txtTelefono" type="text" maxlength="10" name="txtTelefono" class="form-control" placeholder="Ingrese el teléfono">
                                      </div>
                                  </div>
                               
                              </div>
							    <div class="row">
								   <div class="col-md-8">
                                      <div class="form-group">
                                          <label class="control-label" for="inputMarca">Email:</label>
                                          <input id="txtEmail" type="email" maxlength="70" name="txtEmail" class="form-control" placeholder="Ingrese el email">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label class="control-label" for="inputMarca">Fecha Nacimiento:</label>
                                          <input id="txtFechNac" type="date" maxlength="150" name="txtFechNac" class="form-control" >
                                      </div>
                                  </div>       
                              </div>
							  </fieldset>                               
                          </div>				  
						</div>
					</div>
					<div id="sectionC" class="tab-pane fade">
						<div class="row"> 
							<div class="col-md-12 left">
							<fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Confidenciales</legend>
		                    <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group required">
                                         <label class="control-label" for="inputMarca">Grupo de Usuario :</label>                                    
                        				<select class="form-control" name="cboGrupo" id="cboGrupo" 	required>
                                             <option value="">-- SELECCIONE --</option>
											  <?php foreach ($tipousers as $t) {
												  echo '<option value="'.$t->id.'">'.$t->titulo.'</option>';
											  } ?>
										</select>
										
                                      </div>
                                  </div>
								      <div class="col-md-6 left">
                                      <div class="form-group required">
                                          <label class="control-label" for="inputInscripcion">Login :</label>
                                          <input id="txtLogin" type="text" class="form-control" required="" maxlength="50" name="txtLogin">

                                      </div>
                                  </div>
                             
                            </div>
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group required">
                                          <label class="control-label" for="inputMarca">Permisos:</label>
                  							<select class="form-control" name="cboIdPermiso" id="cboIdPermiso" required>
                                          <option value="">-- SELECCIONE --</option>

										  <?php foreach ($permisos as $p) {
											  echo '<option value="'.$p->id.'">'.$p->nombre.'</option>';
										  } ?>
                  						</select>							
                                      </div>
                                  </div>							
                              
                                  <div class="col-md-6 left">
                                      <div class="form-group required">
                                          
                                              <label class="control-label" for="inputInscripcion">Password :</label>
                                              <input id="txtPassword" type="text" required="" class="form-control" maxlength="32" name="txtPassword">
                                     
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
		<div class="col-md-3">
			<div class="row">
				 <div class="form-group">
				  <?php
					$image='assets/images/no_image.png';
				  ?>				
					<div class="image-upload">
					<label for="file-input">					
						<img src="<?php echo base_url($image); ?>" alt="" title="" data-placeholder="https://demo.opencart.com/image/cache/no_image-100x100.png">
						<input type="file" class="hidden" name="image" id="file-input">				
						<input type="hidden" name="txtImage" value="" id="input-image">
					</label>
					</div>
				</div>		
				<div class="control-group ">
					<label class="control-label left">Status :</label>
					<div class="controls">
						<div class="btn-group" data-toggle="buttons-radio">
						   <label class="radio-inline"><input type="radio" id="rdoStatus" name="rdoStatus" value="1" checked > Habilitado </label>
						   <label class="radio-inline"><input type="radio" id="rdoStatus" name="rdoStatus" value="0"> Bloqueado</label>
						</div>
					</div>
				</div>
			</div>		
		</div>
			
        </form>	
		
	</div>
</div>




