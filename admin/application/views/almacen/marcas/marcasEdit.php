 <div class="page-content">
    <div class="page-header">
        <h1>Adicionar
            <small><i class="ace-icon fa fa-angle-double-right"></i> Marca de Producto</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-productcategory" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>		
    </div>
	

	<div class="row">	
					<?php if ($custom_error != '') {
						echo '<div class="alert alert-danger">' . $custom_error . '</div>';
					} ?>	
		
		<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-productcategory" class="form-vertical">
		
		<div class="col-md-12">
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
							Dato                                                    
						</a>
					</li>
					<!--
					<li>
						<a data-toggle="tab" href="#sectionC">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							Cuenta Usuario                                                    
						</a>
					</li>
					-->					

				</ul>						
				
				<div class="tab-content">
					<div id="seccionA" class="tab-pane fade in active">   
						<div class="row">
							<div class="col-md-12 left">													   
								<fieldset class="scheduler-border">
									<legend class="scheduler-border"></legend>								
									<div class="row">
										<div class="col-md-6">
											  <div class="form-group required">
												  <label class="control-label" for="inputMarca">Nombre Marca:</label>
												 
												  <input id="txtTitulo" type="text" name="txtTitulo" required="" class="form-control" placeholder="Nombre Categoria" autofocus="" value="<?php echo $registro[0]->titulo; ?>">
												
											  </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												  <label class="control-label" for="inputMarca">Url:</label>												 
												  <input id="txtUrl" type="text" name="txtUrl" class="form-control" placeholder="Url Categoria" value="<?php echo $registro[0]->url; ?>" readonly>
												
											  </div>
										  </div>										  
									</div> 
									<div  class="row">	
										<div  class="col-md-12">																			
											<div class="control-group ">
												<label class="control-label">Descripcion :<span class="required"></span></label>
												<div class="controls">
												<!--
												<div class="wysiwyg-editor" id="editor1"></div>
												-->
													 <textarea name="txtDescripcion" id="txtDescripcion" rows="20" class="form-control" type="textarea"  ><?php echo $registro[0]->descripcion; ?></textarea>
												</div>
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
								<div class="row">												
									<div class="col-md-12">
										  <div class="control-group">								  
											  <label class="control-label" for="inputMarca">Orden clasificación:</label>
										
											  <input id="txtOrden" type="text" name="txtOrden" class="form-control" placeholder="0" value="<?php echo $registro[0]->orden; ?>" >											
										  </div>
									  </div>  
								</div>	
																
								<div class="row">
									<div class="col-md-12 left">										
										<div class="control-group ">
											<label class="control-label left">Status :</label>
											<div class="controls">
												<div class="btn-group" data-toggle="buttons-radio">
												   <label class="radio-inline"><input type="radio" id="rdoStatus" name="rdoStatus" value="1"<?php if($registro[0]->estado=='1'){ echo "checked=true";}else{ echo "";}?>> Habilitado </label>
												   <label class="radio-inline"><input type="radio" id="rdoStatus" name="rdoStatus" value="0"<?php if($registro[0]->estado=='0'){ echo "checked=true";}else{ echo "";}?>> Bloqueado</label>
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
</div>




