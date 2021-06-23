 <div class="page-content">
    <div class="page-header">
        <h1>Adicionar
            <small><i class="ace-icon fa fa-angle-double-right"></i> Grupo Usuario</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-usuariotipo" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>		
    </div>
	

	<div class="row">	
		<?php if ($custom_error != '') {
			echo '<div class="alert alert-danger">' . $custom_error . '</div>';
		} ?>	

		<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-usuariotipo" class="form-vertical">
		
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
										  <div class="col-md-12">
											  <div class="form-group required">
												  <label class="control-label" for="inputMarca">Nombre Grupo:</label>
												 
												  <input id="txtTitulo" type="text" name="txtTitulo" required="" class="form-control" placeholder="Nombre grupo" autofocus="">
												
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
													 <textarea name="txtDescripcion" id="txtDescripcion" rows="20" class="form-control" type="textarea"  ></textarea>
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
								<fieldset class="scheduler-border">
								<legend class="scheduler-border"></legend>							
									<div class="row">
									<div class="col-md-12 left">										
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
								</fieldset>                               
							</div>				  
						</div>
					</div>	  
					  
				</div> 
            </div>
		</div>			
        </form>	
		
	</div>
</div>




