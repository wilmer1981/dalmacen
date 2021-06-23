<div class="page-content">
    <div class="page-header">
        <h1>Adicionar
            <small><i class="ace-icon fa fa-angle-double-right"></i>Producto</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-product" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>
		
    </div><!-- /.page-header -->
	
	         
    <div class="row">				
		<div class="col-md-12">
			<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
				<div class="tabbable">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active">
							<a data-toggle="tab" href="#home">
								<i class="green ace-icon fa fa-home bigger-120"></i>
								General
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#data">
							<i class="green ace-icon fa fa-home bigger-120"></i>
								Datos
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#discount">
							<i class="green ace-icon fa fa-home bigger-120"></i>
								Descuento                                                     
							</a>
						</li>
						 <li>
							<a data-toggle="tab" href="#special">
							<i class="green ace-icon fa fa-home bigger-120"></i>
								Especial                                                     
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#imagenes">
								Imagen
								<span class="badge badge-danger">4</span>
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div id="home" class="tab-pane fade in active">    	
							<div class="row">
								<div class="col-md-12 left">								
									<div class="row">
										<div class="col-md-6">
											  <div class="form-group">
												  <label class="col-md-4 control-label" for="inputMarca">Codigo:</label>
												  <div class="col-md-4">
												  <input id="txtCodigo" type="text" name="txtCodigo" class="form-control" placeholder="Codigo">
											      </div>
											  </div>
										</div>
										<div class="col-md-6">
											   <div class="form-group">
												  <label class="col-md-2 control-label" for="inputMarca">URL:</label>
												  <div class="col-md-10">
												  <input id="txtURL" type="text" name="txtURLo" class="form-control" placeholder="Generado automaticamente" readonly >
												
												</div>
											  </div>
										</div>
									</div>	

									<div class="row"> 																		
										  <div class="col-md-12">
											  <div class="form-group required">																		  
												  <label class="col-md-2 control-label" for="inputMarca">Nombre del producto:</label>
													<div class="col-md-10">
												  <input id="txtNombre" type="text" name="txtNombre" required="" class="form-control" placeholder="Nombre Producto" >
													</div>
											  </div>
										  </div>  
									</div>															
									<div class="row"> 
										<div class="col-md-12">
											<div class="form-group">                              
												  <label class="col-md-2 control-label" for="inputMarca">Descripcion:</label>
												  <div class="col-md-10">
												  <textarea id="txtDescripcion1" class="form-control" name="txtDescripcion1" rows="20" placeholder="Descripcion del Producto"></textarea>
												 </div>
											</div>
											<p><font style="color:green;">Le quedan <span id="charcount">10495</span> caracteres.</font></p>
										</div>
									</div>
								</div>              
							</div>									
						</div>
						
						<div id="data" class="tab-pane fade">               	
							<div class="row">
								<div class="col-md-12 left">														
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-4">
													  <div class="form-group">
														  <label class="col-md-6 control-label" for="inputMarca">Categoria:</label> 
															<div class="col-md-6">				  
															<select class="form-control" name="cboCategorias" id="cboCategorias">
															<option value="" selected>-- Seleccione --</option>                                   
															<?php 
															  foreach($categorias as $fila ){
															  echo '<option value="'.$fila->id.'">'.mb_strtoupper($fila->titulo,'utf-8').'</option>';
															  }
															?>

														  </select>
														  </div>
													  </div>
												</div>																		
												<div class="col-md-5">							
												  <div class="form-group">
													  <label class="col-md-4 control-label" for="inputMarca">Subcategoria:</label>
														<div class="col-md-4">
														<select class="form-control" name="cboSubcategoria" id="cboSubcategoria">
														 <option value="" selected>-- Seleccione --</option> 														
														</select>
													    </div>
													    <div class="col-md-4">
														<select class="form-control" name="cboSubcategoria1" id="cboSubcategoria1">
														 <option value="" selected>-- Seleccione --</option> 														
														</select>
														</div>
												  </div>
											
												</div>
												<div class="col-md-3">				
												  <div class="form-group">
													  <label class="col-md-6 control-label" for="inputMarca">Marca:</label>
														<div class="col-md-6">
														<select class="form-control" name="cboMarca" id="cboMarca">
														 <option value="" disabled selected>-- Escoje Marca --</option> 
														  <?php 
															foreach($marcas as $fila ){
															    if($fila->id == $result[0]->id_marca){
																	$selected = 'selected';
																}else{
																	$selected = '';
																}
																echo '<option value="'.$fila->id.'"'.$selected.'>'.mb_strtoupper($fila->titulo,'utf-8').'</option>';
															}
														  ?>

														</select>
														</div>
												  </div>
												</div>
											</div>
										</div>
									</div>
									<div class="row"> 																		
										  <div class="col-md-12">
											  <div class="form-group">																		  
												  <label class="col-md-2 control-label" for="inputMarca">Precio:</label>
													<div class="col-md-10">
												  <input id="txtPrecio" type="text" name="txtPrecio" class="form-control" placeholder="Precio" >
													</div>
											  </div>
										  </div>  
									</div>	
									<div class="row"> 																		
										  <div class="col-md-12">
											  <div class="form-group">																		  
												  <label class="col-md-2 control-label" for="inputMarca">Cantidad:</label>
													<div class="col-md-10">
												  <input id="txtStock" type="text" name="txtStock" class="form-control" placeholder="Cantidad" >
													</div>
											  </div>
										  </div>  
									</div>
									<div class="row"> 																		
										  <div class="col-md-12">
											  <div class="form-group">																		  
												  <label class="col-md-2 control-label" for="inputMarca">Cantidad minima:</label>
													<div class="col-md-10">
												  <input id="txtStockMin" type="text" name="txtStockMin" class="form-control" placeholder="Nombre Producto" >
													</div>
											  </div>
										  </div>  
									</div>
									<div class="row"> 																		
										  <div class="col-md-12">
											  <div class="form-group">																		  
												  <label class="col-md-2 control-label" for="inputMarca">Dimensiones(Largo x Ancho x Alto):</label>
												<div class="col-md-3">
												  <input id="txtDimLargo" type="text" name="txtDimLargo" class="form-control" placeholder="Nombre" value="<?php echo number_format('0',2, '.', ''); ?>">
												</div>
												<div class="col-md-3">
												  <input id="txtDimAncho" type="text" name="txtDimAncho" class="form-control" placeholder="Nombre" value="<?php echo number_format('0',2, '.', ''); ?>">
												</div>
												<div class="col-md-3">
												  <input id="txtDimAlto" type="text" name="txtDimAlto" class="form-control" placeholder="Nombre" value="<?php echo number_format('0',2, '.', ''); ?>">
												</div>
											  </div>
										  </div>  
									</div>
																			
									<div class="row"> 
										<div class="col-md-12">																
											<div class="form-group">
											  <label class="col-md-2 control-label" for="inputMarca">Estado:</label> 
												<div class="col-md-10">														  
												<select class="form-control" name="cboEstado" id="cboEstado">
												<option value="">--Seleccione--</option>                          
												<?php 
												  foreach($estados as $fila ){
													
													  echo '<option value="'.$fila->id.'">'.mb_strtoupper($fila->titulo,'utf-8').'</option>';
												  }
												?>

											  </select>
											  </div>
											</div>
										</div>
									</div>
									<div class="row"> 																		
										  <div class="col-md-12">
											  <div class="form-group">																		  
												  <label class="col-md-2 control-label" for="inputMarca">Orden clsificacion:</label>
													<div class="col-md-10">
												  <input id="txtOrden" type="text" name="txtOrden" class="form-control" placeholder="0" >
													</div>
											  </div>
										  </div>  
									</div>
									<div class="row"> 
										<div class="col-md-12">																
											<div class="control-group ">
												<label class="col-md-2 control-label">Destacado :</label>
												<div class="col-md-3">
												<div class="controls">
													<div class="btn-group" data-toggle="buttons-radio">
														<label class="radio-inline"><input type="radio" id="rdoFeatured" name="rdoFeatured" value="S"> Si</label>
													   <label class="radio-inline"><input type="radio" id="rdoFeatured" name="rdoFeatured" value="N" checked > No </label>
													   
													</div>
												</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>              
							</div>											
						</div>

						<div id="imagenes" class="tab-pane fade">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
								<td class="text-left">Imagen</td>
								</tr>
								</thead>
								<tbody>
								<tr>
								<td class="text-left">
								<?php 									 
									$image='assets/images/no_image.png';									
								?>
								<div class="image-upload">
								    <label for="image-input">
								        <img src="<?php echo base_url($image);?>" class="img-thumbnail image-preview" alt ="Click aquí para subir tu foto" title ="Click aquí para subir tu foto" data-placeholder="https://demo.opencart.com/image/cache/no_image-100x100.png" > 
								    </label>
								    <input id="image-input" type="file" name="image-input"/>
								    <input type="hidden" name="txtImage" id="input-image">
								</div>
								<div class="upload-msg"></div>
								</td>
								</tr>
								</tbody>
								</table>
							</div>
							<div class="table-responsive">
								<table id="images" class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
								<td class="text-left">Imágenes Adicionales</td>
								<td class="text-right">Orden de clasificación</td>
								<td></td>
								</tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot>
								<tr>
								<td colspan="2"></td>
								<td class="text-left"><button type="button" data-toggle="tooltip" title="" class="btn btn-primary btn-addImage" data-original-title="Add Image"><i class="fa fa-plus-circle"></i></button></td>
								</tr>
								</tfoot>
								</table>
							</div>	
						</div>
						
						<div id="discount" class="tab-pane fade">
						<div class="table-responsive">
						<table id="discount" class="table table-bordered table-hover">
						  <thead>
							<tr>
							  <th scope="col">Grupo Cliente</th>
							  <th scope="col">Cantidad</th>
							  <th scope="col">Prioridad</th>
							  <th scope="col">Precio</th>
							  <th scope="col">Fech.Ini</th>
							  <th scope="col">Fech.Fin</th>
							  <th scope="col"></th>
							</tr>
						  </thead>
						  <tbody>													
						
						  </tbody>
						  <tfoot>
							<tr>
							<td colspan="6"></td>
							<td class="text-left"><button type="button" data-toggle="tooltip" title="" class="btn btn-primary btn-addDiscount" data-original-title="Add Discount"><i class="fa fa-plus-circle"></i></button></td>
							</tr>
							</tfoot>
						</table>
						</div>
						</div>
						
						<div id="special" class="tab-pane fade">
						<div class="table-responsive">
						<table id="special" class="table table-bordered table-hover">
						  <thead>
							<tr>
							  <th scope="col">Grupo Cliente</th>								
							  <th scope="col">Prioridad</th>
							  <th scope="col">Precio</th>
							  <th scope="col">Fech.Ini</th>
							  <th scope="col">Fech.Fin</th>
							  <th scope="col"></th>
							</tr>
						  </thead>
						  <tbody>													
						
						  </tbody>
						  <tfoot>
							<tr>
							<td colspan="5"></td>
							<td class="text-left"><button type="button" data-toggle="tooltip" title="" class="btn btn-primary btn-addSpecial" data-original-title="Add Special"><i class="fa fa-plus-circle"></i></button></td>
							</tr>
							</tfoot>
						</table>
						</div>
						</div>


						<div id="dropdown1" class="tab-pane fade">
							<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
						</div>

						<div id="dropdown2" class="tab-pane fade">
							<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.</p>
						</div>
					</div>
				</div>
			</form>
        </div>									
	</div>
</div>

