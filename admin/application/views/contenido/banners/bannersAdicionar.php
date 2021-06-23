 <div class="page-content">
    <div class="page-header">
        <h1>Adicionar
            <small><i class="ace-icon fa fa-angle-double-right"></i> Banner</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-banner" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>		
    </div>
	
	<div class="row">	
		<?php if ($custom_error != '') {
			echo '<div class="alert alert-danger">' . $custom_error . '</div>';
		} ?>	
		
		<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-banner" class="form-vertical">
		<div  class="col-md-12">	
			<div  class="row">	
				<div  class="col-md-6">	
					<div class="form-group">
						<label class="control-label">Nombre:</label>
						<div class="controls">
						  <input id="txtTitulo" type="text" maxlength="100" name="txtTitulo" required="" class="form-control" placeholder="Ingrese titulo del banner" autofocus="">
						</div>
					</div>								
											
				</div>
				<div  class="col-md-3">
					<div class="form-group">
						<label class="control-label">Alias</label>
						<div class="controls">
						  <input id="txtAlias" type="text" maxlength="100" name="txtAlias" class="form-control" placeholder="Autogenerar desde el título" readonly>
						</div>
					</div>					
				
				</div>
			
			</div>
		</div>
	
		<div  class="col-md-12">	
			<div class="tabbable">			
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#seccionA">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							General
						</a>
					</li>
					<li>
						<a data-toggle="tab" href="#sectionB">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							Publicacion                                                   
						</a>
					</li>	

				</ul>				
				<div class="tab-content">
					<div id="seccionA" class="tab-pane fade in active">				
						<div  class="row">	
							<div class="col-md-8">
								  <div class="form-group has-success">
									<label for="inputMarca">Imagen :</label>
									<input id="imagenBanner" type="file" class="form-control filestyle" name="imagenBanner" autofocus="" data-placeholder="Seleccione imagen" data-buttonText="Buscar imagen" data-buttonName="btn-default" data-buttonBefore="true" data-size="md">                                                          

								  </div>
								  <div class="control-group ">
										<label class="control-label">Descripcion :<span class="required"></span></label>
										<div class="controls">
											<textarea name="txtDescripcion" id="txtDescripcion" rows="20" class="form-control" type="textarea"  ></textarea>

										</div>
									</div>
							</div>						
						
							<div  class="col-md-4">	
									<div class="control-group">				
									<label class="control-label">Estado :</label>

									<div class="controls">
										<select id="cboStatus" name="cboStatus" class="form-control" data-placeholder="Seleccione tipo publicación...">
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
								<div class="control-group">
									<label class="control-label">Categoria :</label>
									<div class="controls">
										<select id="cboCategoria" name="cboCategoria" class="form-control">
											<option value="">-- Seleccione --</option>
												<?php 
													foreach ($categorias as $t){
														//$documento = mb_strtoupper($t->nombre, 'UTF-8');
														$documento = $t->titulo;
														if($t->id ==  $banners[0]->id_categoria){ 
															$selected = 'selected'; 														
														}else{
															$selected = '';															
														}  
														echo '<option value="'.$t->id.'"'.$selected.'>'.$documento.'</option>';
													
													} 
												?> 
										</select>
									</div>
								</div>
															
											
							</div>
					
						</div>
 					</div>
					
					<div id="sectionB" class="tab-pane fade">
						<div  class="row">	
							<div class="col-md-8">					
								<div class="form-group">
									<label class="control-label col-md-4" for="inputMarca">Comenzar a publicar:</label>
									<div class="col-md-6">
									<input id="txtFechini" type="date" maxlength="150" name="txtFechIni" class="form-control" >
									</div>
								</div>
								 <div class="form-group">
									<label class="control-label col-md-4" for="inputMarca">Finalizar publicacion:</label>
									<div class="col-md-6">
									<input id="txtFechFin" type="date" maxlength="150" name="txtFechFin" class="form-control" >
									</div>
								</div>
								 <div class="form-group">
									<label class="control-label col-md-4" for="inputMarca">Fecha Creacion:</label>
									<div class="col-md-6">
									<input id="txtFechReg" type="date" maxlength="150" name="txtFechReg" class="form-control" >
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
</div>



  




