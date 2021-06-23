    <?php	
	$idtipo   = $this->uri->segment(3);
	$link_ant = $_SERVER['HTTP_REFERER'];
	$array    = explode("/", $link_ant);

	$parte1=$array[0];
	$parte2=$array[1];
	$parte3=$array[2];
	$parte4=$array[3];
	$parte5=$array[4];
	//$parte6=$array[5];
	//$parte7=$array[6];
	//$parte8=$array[7];
	//echo "Parte : ".$parte7; 

	?>
 <div class="page-content">
    <div class="page-header">
        <h1>Menus
            <small><i class="ace-icon fa fa-angle-double-right"></i> Nuevo Item</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-items" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>		
    </div>
	<div class="espacio-fila"></div>  	         
    <div class="row">		
		<?php if ($custom_error != '') {
			echo '<div class="alert alert-danger">' . $custom_error . '</div>';
		} ?>
		<form role="form" action="<?php echo current_url(); ?>" id="form-items" method="post" enctype="multipart/form-data">
    	<div class="col-md-12">
			<div  class="row">	
				<div  class="col-md-8">	
					<div class="form-group required">
						<label class="control-label">Titulo :</label>
						<div class="controls">
						  <input id="txtTitulo" type="text" name="txtTitulo" required="" class="form-control" placeholder="Ingrese Titulo" autofocus="">
						</div>
					</div>												
				</div>
				<div  class="col-md-4">					
					<div class="form-group">				
						<label class="control-label">Alias :</label>
						<div class="controls">									
							  <input id="txtAlias" type="text" name="txtAlias" class="form-control" placeholder="Autogenerado desde el título" readonly >
						</div>
					</div>
				</div>						
			</div>
		
		
			<div class="row">
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
							Dato                                                    
						</a>
					</li>			
				</ul>
				
				<div class="tab-content">		
					<div id="sectionA" class="tab-pane fade in active">			
						<div class="row">
									<div class="col-md-12 left">
										<div class="row">
									<div class="col-md-9">						   
										<!--
										<div class="row"> 
										
											<div class="col-md-6">
											  <div class="form-group">
												  <label for="inputMarca">Tipo Item :<span class="required">*</span></label>
												   <div class="controls">	
												   <select id="cboTipoItem" name="cboTipoItem" class="form-control">
													<option value="">-- Seleccione --</option>
													<?php foreach ($categorias as $t) {
															//$documento = mb_strtoupper($t->nombre, 'UTF-8');	
															$documento = $t->nombre;		 
															echo '<option value="'.$t->id.'">'.$documento.'</option>';
														} ?>
																	  
												</select>
												</div>
											  </div>
											 </div>
										</div> 
										-->
										<div class="row">
								
										<div class="col-md-12">
											<div class="form-group">
												<label for="inputMarca">Seleccione Articulo:</label>										
												<div class="input-group">
													<input id="txtIdEmpleado" type="hidden" class="form-control" name="txtIdEmpleado" required="" placeholder="" autofocus="">
													<input id="txtEmpleado" type="text" class="form-control" name="txtEmpleado" placeholder="Seleccione un Articulo" autofocus="" disabled="">
													<span class="input-group-btn">
														  <button type="button" class="btn btn-default" id="btnBuscarArt"><i class="fa fa-search"></i>
																		Buscar
														  </button>
													</span>
												</div>   
											</div>
											<div class="form-group">
											   <label for="inputMarca">Link :<span class="required"></span></label>
											    <div class="controls">									
													<input id="txtLink" type="text" name="txtLink" class="form-control">
												</div>
										    </div>											
									  </div> 
								
								  </div>
								
										  
								</div>
								<div class="col-md-3">
										<div class="row">
											<div class="col-md-12">
									 
										  <div class="form-group required">
											   <label class="control-label">Menu:</label>
												<div class="controls">	
												<select id="cboMenu" name="cboMenu" class="form-control">
												<option value="">-- Seleccione --</option>
												<?php foreach ($tipomenu as $t) {
														$documento = mb_strtoupper($t->titulo, 'UTF-8');											
													 
														echo '<option value="'.$t->id.'">'.$documento.'</option>';
													} ?>
																  
											</select>
											</div>
										  </div> 
											<div class="form-group">
											  <label for="inputMarca">Elemento Padre:</label>
												<div class="controls">	
												<select id="cboMenuItemPadre" name="cboMenuItemPadre" class="form-control">
												<option value="0"> Menu Item Padre </option>												  
											</select>
											</div>
										  </div> 
										<div class="form-group">
											  <label for="inputMarca">Status:<span class="required"></span></label>
												<div class="controls">	
												<select id="cboStatus" name="cboStatus" class="form-control" required>
												<option value="1"> Publicado </option>
												<option value="2"> Despublicado </option>
												<option value="3"> Archivado </option>
											  
											</select>
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
</div>
   </form>
   
   </div>
  </div>




