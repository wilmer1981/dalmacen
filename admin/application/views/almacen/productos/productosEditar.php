<div class="page-content">
    <div class="page-header">
        <h1>Editar
            <small><i class="ace-icon fa fa-angle-double-right"></i>Producto</small>
        </h1>
		<div class="botones pull-right">
			<button type="submit" form="form-producto" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
			<a href="javascript:history.back(-1);" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
		</div>		
    </div><!-- /.page-header -->
	
	         
    <div class="row">				
		<div class="col-md-12">
		<?php if ($custom_error != '') {
			echo '<div class="alert alert-danger">'.$custom_error.'</div>';
		} ?>	
			<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" id="form-producto" class="form-horizontal">
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
														  <input id="txtCodigo" type="text" name="txtCodigo" class="form-control" placeholder="Codigo" value="<?php echo $result[0]->codigo; ?>" >
															<input type="hidden" name="id_producto" id="id_producto" value="<?php echo $result[0]->id; ?>">
														</div>
													  </div>
												</div>
												<div class="col-md-6">
													   <div class="form-group">
														  <label class="col-md-2 control-label" for="inputMarca">URL:</label>
														  <div class="col-md-10">
														  <input id="txtURL" type="text" name="txtURLo" class="form-control" placeholder="Codigo" value="<?php echo $result[0]->url; ?>" readonly >
														
														</div>
													  </div>
												</div>
											</div>													
											<div class="row"> 																		
												  <div class="col-md-12">
													  <div class="form-group required">																		  
														  <label class="col-md-2 control-label" for="inputMarca">Nombre del producto:</label>
															<div class="col-md-10">
														  <input id="txtNombre" type="text" name="txtNombre" required="" class="form-control" placeholder="Nombre Producto" value="<?php echo $result[0]->nombre; ?>">
															</div>
													  </div>
												  </div>  
											</div>															
											<div class="row"> 
												<div class="col-md-12">
													  <div class="form-group">                              
														  <label class="col-md-2 control-label" for="inputMarca">Descripcion:</label>
														  <div class="col-md-10">
														  <textarea id="txtDescripcion1" class="form-control" name="txtDescripcion1" rows="20" placeholder="Descripcion del Producto"><?php echo $result[0]->descripcion; ?></textarea>
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
																	<select class="form-control" name="cboCategoria" id="cboCategoria">
																	<option value="" disabled selected>-- Escoje Categoria --</option>                                   
																	<?php 
																	  foreach($categorias as $fila ){
																		if($fila->id == $result[0]->id_categoria ){
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
														<div class="col-md-5">														
														  <div class="form-group">
															  <label class="col-md-4 control-label" for="inputMarca">Subcategoria:</label>
																<div class="col-md-4">
																	<select class="form-control" name="cboSubcategoria" id="cboSubcategoria">
																	 <option value="" disabled selected>-- Escoje Subcategoria --</option> 
																	  <?php 

																	    $idcat         = $result[0]->id_categoria; 
																	    $subcategorias = getSubcategoria($idcat);
																		foreach($subcategorias as $fila ){
																		    if($fila->id == $result[0]->idcatpadre){
																				$selected = 'selected';
																			}else{
																				$selected = '';
																			}
																			echo '<option value="'.$fila->id.'"'.$selected.'>'.mb_strtoupper($fila->titulo,'utf-8').'</option>';
																		}
																	  ?>

																	</select>
																</div>
																<div class="col-md-4">
																	<select class="form-control" name="cboSubcategoria1" id="cboSubcategoria1">
																	 <option value="" disabled selected>-- Escoje Subcategoria --</option> 
																	  <?php 
																	    $idsubcat      = $result[0]->idcatpadre;
																	    $subcategorias = getSubcategoria($idsubcat);

																		foreach($subcategorias as $fila ){
																		    if($fila->id == $result[0]->id_subcategoria ){
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
														  <input id="txtPrecio" type="text" name="txtPrecio"  class="form-control" placeholder="Precio" value="<?php echo number_format($result[0]->precio,2, '.', ''); ?>">
															</div>
													  </div>
												  </div>  
											</div>	
											<div class="row"> 																		
												  <div class="col-md-12">
													  <div class="form-group">																		  
														  <label class="col-md-2 control-label" for="inputMarca">Cantidad:</label>
															<div class="col-md-10">
														  <input id="txtStock" type="text" name="txtStock"  class="form-control" placeholder="Cantidad" value="<?php echo $result[0]->stock; ?>">
															</div>
													  </div>
												  </div>  
											</div>
											<div class="row"> 																		
												  <div class="col-md-12">
													  <div class="form-group">																		  
														  <label class="col-md-2 control-label" for="inputMarca">Cantidad minima:</label>
															<div class="col-md-10">
														  <input id="txtStockMin" type="text" name="txtStockMin"  class="form-control" placeholder="Nombre Producto" value="<?php echo $result[0]->stock_min; ?>">
															</div>
													  </div>
												  </div>  
											</div>
											<div class="row"> 																		
												  <div class="col-md-12">
													  <div class="form-group">																		  
														  <label class="col-md-2 control-label" for="inputMarca">Dimensiones(Largo x Ancho x Alto):</label>
														<div class="col-md-3">
														  <input id="txtDimLargo" type="text" name="txtDimLargo"  class="form-control" placeholder="Nombre" value="<?php echo number_format($result[0]->stock,2, '.', ''); ?>">
														</div>
														<div class="col-md-3">
														  <input id="txtDimAncho" type="text" name="txtDimAncho"  class="form-control" placeholder="Nombre" value="<?php echo number_format($result[0]->stock,2, '.', ''); ?>">
														</div>
														<div class="col-md-3">
														  <input id="txtDimAlto" type="text" name="txtDimAlto" class="form-control" placeholder="Nombre" value="<?php echo number_format($result[0]->stock,2, '.', ''); ?>">
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
														<option value="" disabled selected>--Seleccione--</option>                                   
														<?php 
														  foreach($estados as $fila ){
															if($fila->id == $result[0]->estado){ $selected = 'selected';}else{$selected = '';}
															  echo '<option value="'.$fila->id.'"'.$selected.'>'.mb_strtoupper($fila->titulo,'utf-8').'</option>';
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
														  <input id="txtOrden" type="text" name="txtOrden" class="form-control" placeholder="Nombre Producto" value="<?php echo $result[0]->orden; ?>">
															</div>
													  </div>
												  </div>  
											</div>
											<div class="row"> 
												<div class="col-md-12">																
													<div class="control-group ">
														<label class="col-md-2 control-label">Destacado :</label>
														<div class="col-md-10">
														<div class="controls">
															<div class="btn-group" data-toggle="buttons-radio">
																<label class="radio-inline"><input type="radio" id="rdoFeatured" name="rdoFeatured" value="S"<?php if($result[0]->destacado=='S'){ echo "checked=true";}else{ echo "";}?>> Si</label>
															   <label class="radio-inline"><input type="radio" id="rdoFeatured" name="rdoFeatured"  value="N"<?php if($result[0]->destacado=='N'){ echo "checked=true";}else{ echo "";}?>> No </label>
															   
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
									   $img = $result[0]->url_imagen;									      
										if($img){									
											$image=$img;
											//$image='<img class="img-thumbnail" src="'.base_url($image).'" />';
										}else{
											$image='assets/images/no_image.png';
											//$image='<img class="img-thumbnail" width="307" height="240" src="'.base_url($image).'" />';
										}
									
									
									?>									

									<div class="image-upload">
									    <label for="image-input">										
											<img src="<?php echo base_url($image);?>" class="img-thumbnail image-preview" alt="" title="" data-placeholder="https://demo.opencart.com/image/cache/no_image-100x100.png">
										</label>
									
									<input id="image-input" type="file" name="image-input"/>								
									<input type="hidden" name="txtImage" id="input-image" value="<?php echo $img;?>">
									</div>
									
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
									<?php 
									$cont=0;
									foreach ($imagenes as $r){ 
										$idp  	= $r->id; 
										$img  	= $r->url_imagen;  
										$order  = $r->sort_order;  
										if($img){						
											$image=$img;						
										}else{
											$image='assets/images/no_image.png';						
										}
										
										echo '<tr id="image-row'.$cont.'">';
											echo '<td class="text-left">';
											echo '<div class="images-upload">';
											echo '<label for="images-input'.$cont.'" id="images-input_'.$cont.'">';
											echo '<img src="'.base_url($image).'" class="img-thumbnail image-preview'.$cont.'" alt="" title="" data-placeholder="https://demo.opencart.com/image/cache/no_image-100x100.png">';
											echo '</label>';
											echo '</div>';
											echo '<input id="images-input'.$cont.'" type="file" name="images-input" class="hidden">
													<input type="hidden" name="product_image['.$cont.'][id]" value="'.$idp.'" id="input-image'.$cont.'">
													<input type="hidden" name="product_image['.$cont.'][image]" value="'.$img.'" id="input-image'.$cont.'">';
											echo '</td>'; 
											echo '<td class="text-right">
													<input type="text" name="product_image['.$cont.'][sort_order]" value="'.$order.'" placeholder="Sort Order" class="form-control">
												</td>';
											echo '<td class="text-left">
												<button type="button" onclick="$(\'#image-row'.$cont.'\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
												<i class="fa fa-minus-circle"></i></button>
												</td>';
										echo '</tr>';
										$cont++;
									}
									?>									
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
							  	<?php 
									$cont=0;
									foreach ($descuentos as $r){ 
										$iddis 	= $r->id; 
										$idtc  	= $r->id_tipocliente;  
										$idprod = $r->id_producto; 
										$cant   = $r->cantidad; 
										$prio   = $r->prioridad;  
										$prec   = $r->precio; 
										$fini   = $r->fech_ini; 
										$ffin   = $r->fech_fin; 
									
										echo '<tr id="discount-row'.$cont.'">';
											echo '<input type="hidden" name="product_discount['.$cont.'][id]" value="'.$iddis.'" id="input-discount'.$cont.'">';
											echo '<td class="text-left">';
												echo '<select name="product_discount['.$cont.'][customer_group_id]" class="form-control">';
												echo '<option value="1">Default</option>';
			                               		echo '</select>';
			                                echo '</td>';
			                                echo '<td class="text-right">';
			                                	echo '<input type="text" name="product_discount['.$cont.'][quantity]" value="'.$cant.'" placeholder="Quantity" class="form-control" />';
			                                echo '</td>';
			                                echo '<td class="text-right">';
			                                	echo '<input type="text" name="product_discount['.$cont.'][priority]" value="'.$prio.'" placeholder="Quantity" class="form-control" />';
			                                echo '</td>';
											echo '<td class="text-right">
													<input type="text" name="product_discount['.$cont.'][price]" value="'.$prec.'" placeholder="Price" class="form-control">
												</td>';
											echo '<td class="text-left" style="width: 20%;">';
												echo '<div class="input-group date" id="fech_ini">';
												echo '<input type="text" name="product_discount['.$cont.'][date_start]" value="'.$fini.'" placeholder="Date Start" class="form-control" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>';
												echo '</div>';
											echo '</td>';

											echo '<td class="text-left" style="width: 20%;">
											<div class="input-group date" id="fech_fin">
											<input type="text" name="product_discount['.$cont.'][date_end]" value="'.$ffin.'" placeholder="Date End" class="form-control" /><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div></td>';

											echo '<td class="text-left">
												<button type="button" onclick="$(\'#discount-row'.$cont.'\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
												<i class="fa fa-minus-circle"></i></button>
												</td>';
										echo '</tr>';
										$cont++;
									}
									?>														
							
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

