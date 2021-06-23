<div class="box box-default">
			<div class="box-header with-border">
            <h3 class="box-title"><span class="icon"><i class="fa fa-file-text-o" aria-hidden="true"></i> Articulos : Nuevo</span></h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>					
			</div>
		<form role="form" action="<?php echo current_url(); ?>" name="frmArticulo" id="frmArticulo" method="post" enctype="multipart/form-data">
                     
			<div class="row">
						<div class="col-md-12 background-header">
							<div class="botones der">   
								<a href="<?php echo base_url('articulos')?>" class="btn btn-primary "><i class="fa fa-remove"></i> Cancelar</a>                          
								<button class="btn btn-success " type="submit"><i class="fa fa-floppy-o"></i> Guardar</button>
							</div> 
						</div>
			</div>			
		         
            <div class="box-body">					
				<div class="col-md-12" id="VerForm" style="display: block;">
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>
					<div  class="row">	
						<div  class="col-md-6">	
							<div class="form-group">
								  <label class="control-label">Titulo:(<span class="required">*</span>)</label>
								<div class="controls">
								  <input id="txtTitulo" type="text" maxlength="100" name="txtTitulo" required="" class="form-control" placeholder="Ingrese Titulo" autofocus="">
								</div>
							</div>								
													
						</div>
						<div  class="col-md-3">					
								<div class="control-group">				
									<label class="control-label">Estatus :</label>

									<div class="controls">
										<select id="cboStatus" name="cboStatus" class="form-control" data-placeholder="Seleccione tipo publicación...">
											<!--
											<option value="1" selected>Publicado</option>
											<option value="2">Despublicado</option>
											<option value="3">Archivado</option>
											-->
												<?php foreach ($artstatus as $t) {
															//$documento = mb_strtoupper($t->nombre, 'UTF-8');
															$documento = $t->titulo;
															if($t->id == '1'){ 
																$selected = 'selected'; 														
															}else{
																$selected = '';															
															}  
															echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
												} ?>
												  
										</select>

									</div>
								</div>
							</div>
						<div  class="col-md-3">							
								<div class="control-group ">
												<label class="control-label">Destacado :</label>
												 <div class="controls">
													<div class="btn-group" data-toggle="buttons-radio">
												 
													   <label class="radio-inline"><input type="radio" id="rdoDestacado" name="rdoDestacado" value="1" >Si </label>
													   <label class="radio-inline"><input type="radio" id="rdoDestacado" name="rdoDestacado" value="0" checked>No</label>
											
													
													</div>
												</div>
								</div>
							</div>
				</div>
				<div class="row">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#sectionA">Contenido</a></li>
					<li><a data-toggle="tab" href="#sectionB">Imagenes</a></li>
					<li><a data-toggle="tab" href="#sectionC">Publicacion</a></li>
				
				</ul>
				<div class="tab-content">
					<div id="sectionA" class="tab-pane fade in active">
						<div  class="row">	
								<div  class="col-md-9">																			
									<div class="control-group ">
										<label class="control-label">Resumen :(<span class="required">*</span>)</label>
										<div class="controls">
											 <textarea name="txtResumen" id="txtResumen" class="form-control" type="textarea"></textarea>
										</div>
									</div>
											
								</div>
								<div  class="col-md-3">				
									
												<div class="control-group">
													<label class="control-label">Categoria :</label>
													<div class="controls">
														<select id="cboCategoria" name="cboCategoria" class="form-control" data-placeholder="Seleccione...">
															<option value="">-- Seleccione --</option>
															<?php foreach ($categorias as $t) {
															//$documento = mb_strtoupper($t->nombre, 'UTF-8');
															$documento = $t->nombre;
															if($t->id == $idtipo){ 
																$selected = 'selected'; 														
															}else{
																$selected = '';															
															}  
															echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
														} ?>
													
											 
														</select>

													</div>
												</div>		                   
										
										
											<!--		
											<div class="control-group ">
												<label class="control-label">Fec.Caducidad :</label>
												<div class="controls">
													<div id="datepicker" class="input-prepend date">
														<span class="add-on"><i class="icon-th"></i></span>
														<input name="fec_cad" id="fec_cad"  class="span2" type="text" value="">
													</div>
												</div>
											</div>
											-->											


										</div>
						</div>
						<div  class="row">	
							<div  class="col-md-12">
									<div class="control-group ">
										<label class="control-label">Descripci&oacute;n :(<span class="required">*</span>)</label><br>
									
									<textarea name="txtDescrip" id="txtDescrip" class="form-control" rows="14" cols="48" ></textarea>
									
									</div>								
									<p><font style="color:green;">Le quedan <span id="charcount">10495</span> caracteres.</font></p>
										
							</div>
						</div>
					  
					</div>
					
					<div id="sectionB" class="tab-pane fade">
						<div  class="row">	
							<div class="col-md-6">
								
								  <div class="form-group has-success">
									  <label for="inputMarca">Imagen de Introduccion :</label>
									<input id="imagenIntro" type="file" class="form-control filestyle" name="imagenIntro" autofocus="" data-placeholder="Seleccione imagen" data-buttonText="" data-buttonName="btn-success" data-buttonBefore="true" data-size="md">                                                          

								  </div>
								  <div class="control-group ">
										<label class="control-label">Descripcion:<span class="required"></span></label>
										<div class="controls">
											 <textarea name="txtDescripIntro" id="txtDescripIntro" class="form-control" type="textarea"></textarea>
										</div>
									</div>
							</div>	
							<div class="col-md-6">
								
								  <div class="form-group has-success">
									  <label for="inputMarca">Imagen del Articulo Completo:</label>
									<input id="imagenFull" type="file" class="form-control filestyle" name="imagenFull" autofocus="" data-placeholder="Seleccione imagen" data-buttonText="" data-buttonName="btn-success" data-buttonBefore="true" data-size="md">                                                          

								  </div>
								   <div class="control-group ">
										<label class="control-label">Descripcion:<span class="required"></span></label>
										<div class="controls">
											 <textarea name="txtDescripFull" id="txtDescripFull" class="form-control" type="textarea"  ></textarea>
										</div>
									</div>
							</div>	
						</div>				
					</div>
					<div id="sectionC" class="tab-pane fade">
						<div  class="row">	
							<div class="col-md-6">								
								<div class="form-group">
									<label class="control-label col-md-6">Empezar Publicacion:<span class="required"></span></label>
									<div class="controls col-md-6">
										<div class="form-group">
											<div class='input-group date' id='fecha_inicial'>
												<input type='text' class="form-control" name='fecha_inicial' />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
							    </div>	
								<div class="form-group">
									<label class="control-label col-md-6">Finalizar Publicacion:<span class="required"></span></label>
									<div class="controls col-md-6">
										<div class="form-group">
											<div class='input-group date' id='fecha_final'>
												<input type='text' class="form-control" name='fecha_final' />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>								
																
							    </div>
															
								
							</div>	
							<div class="col-md-6">
								
								<div class="form-group">
									<label class="control-label col-md-6">Fecha Creacion:<span class="required"></span></label>
									<div class="controls col-md-6">
										<div class="form-group">
											<div class='input-group date' id='fecha_creacion'>
												<input type='text' class="form-control" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
							    </div>	
							</div>	
						</div>				
					</div>
					
				</div>

			
			</div>
					           
        	</div>        
		</div>
       
          
        </form>
	</div>
		<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_search" role="dialog" aria-hidden="true"></div>
<div class="modal fade" id="modal_form_isearch" role="dialog" aria-hidden="true"></div>


  




