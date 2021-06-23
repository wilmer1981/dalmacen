 <div class="page-content">
    <div class="page-header">
        <h1>Adicionar
            <small><i class="ace-icon fa fa-angle-double-right"></i> Categoria Producto</small>
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
		
		<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-productcategory" class="form-horizontal">
		
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

				</ul>						
				
				<div class="tab-content">
					<div id="seccionA" class="tab-pane fade in active">   
						<div class="row">
							<div class="col-md-12 left">												   
								<div class="row">
									<div class="col-md-6">
										<div class="form-group required">
											<label class="col-md-4 control-label" for="inputMarca">Nombre Categoria:</label>
											<div class="col-md-8">
											<input id="txtTitulo" type="text" name="txtTitulo" required="" class="form-control" placeholder="Nombre Categoria" autofocus="">	
											</div>										
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-md-4 control-label" for="inputMarca">Url:</label>
											<div class="col-md-8">	 
											<input id="txtUrl" type="text" name="txtUrl" class="form-control" placeholder="Url Categoria" readonly>
											</div>
										</div>
									</div>										  
								</div> 
								<div  class="row">	
										<div  class="col-md-12">										
											<div class="form-group">
												<label class="col-md-2 control-label">Descripcion :<span class="required"></span></label>
												<div class="col-md-10">
												 <textarea name="txtDescripcion" id="txtDescripcion" rows="20" class="form-control" type="textarea"  ></textarea>
												</div>
											</div>													
										</div>							
								</div>						  
                           					
							</div>		  
						</div>           
					</div>										 
					<div id="sectionB" class="tab-pane fade">
						<div class="row">					                 
							<div class="col-md-12 left">
									<div class="row">												
										<div class="col-md-12">
											  <div class="form-group">								  
												  <label class="col-md-2 control-label" for="inputMarca">Orden clasificación:</label>
													<div class="col-md-10">
												  <input id="txtOrden" type="text" name="txtOrden" class="form-control" placeholder="0" >
													</div>
											  </div>
										  </div>  
									</div>	
									<div class="row">
										<div class="col-md-12 left">										
											<div class="form-group">
												<label class="col-md-2 control-label left">Status :</label>
												<div class="col-md-10 controls">
													<div class="btn-group" data-toggle="buttons-radio">
													   <label class="radio-inline"><input type="radio" id="rdoStatus" name="rdoStatus" value="1" checked > Habilitado </label>
													   <label class="radio-inline"><input type="radio" id="rdoStatus" name="rdoStatus" value="0"> Bloqueado</label>
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




