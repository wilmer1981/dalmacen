<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container container-fondo">
	<div class="row">
		<div class="col-sm-9 sin-spacio">
		<div class="panel-group">		
			<div class="panel panel-primary">
				 <div class="panel-heading heading-text" >Detalle Productosss</div>
						<!--<p class="panel-heading-1" >&nbsp;</p>
						-->
		
				<div class="panel-body container-fondo">		
					<div class="product-details">	
							<div class="grid images_3_of_2">
								<ul id="etalage">
									<?php 
										foreach ($images as $imagen) {
												# code...
										?>
										<li>
											<a href="#">
											<!--
												<img class="etalage_thumb_image" src="<?php echo base_url().'admin/'.$imagen->url_img; ?>" />
											-->
												<img class="etalage_source_image" src="<?php echo base_url().'admin/'.$imagen->url_img; ?>" title="<?php echo $producto ->nombre; ?>" />
											

											</a>
										</li>
										<?php 							
										}
									?>															
								</ul>
						    </div>
							<div class="desc span_3_of_2">
								<h2><?php echo $producto ->nombre; ?></h2>
								<p><?php echo  $producto->descripcion; ?></p>					
								<!--
								<div class="price">
									<p>Precio: <span>S/.<?php echo  $producto->precio; ?></span></p>
								</div>
								-->
								<div class="precio">  
                                  <p>                            
                                  <?php		
									/*$precio  = $producto->precio; 
									$dcto    = $producto->dcto;
									$preciof = $precio - (($precio*$dcto)/100); 
																			
									if($producto->dcto!=0){
										echo '<span class="rupees line-through">S/. '.$precio .'</span>';
										echo '<span class="rupees">S/. ';
										printf("%.02lf\n",$preciof);
										echo "</span>";										
									}else{
										echo '<span class="rupees">S/. ';
										printf("%.02lf\n",$preciof);
										echo "</span>";
										
									}*/
							 								  
								
                              	 
                                  ?>  
                                  </p>                           
                              </div> 
					
								
											
									              
												  
										<?php
                        
										// Create form and send values in 'shopping/add' function.
										$price="1"; 
										$message=""; 										
										echo form_open('shopping/add');
										echo form_hidden('id', $producto->id);
										echo form_hidden('name', $producto->nombre);
										echo form_hidden('marca', $producto->marca);
										echo form_hidden('modelo', $producto->modelo);
										echo form_hidden('message', $message);
										echo form_hidden('price', $price);
										//echo form_hidden('price', $preciof);
										
										//echo form_hidden('price', $producto->precio);
										?> 
										
							
										<div class="share-desc">
											<div class="share">
												<p>Cantidad :</p><input type="number" class="text_box" id="quantity" name="quantity" value="1" min="1" />				
											</div>
											<div class="button">
											 <?php
											/*	$btn = array(
													'class' => 'btn btn-success',
													'value' => 'true',
													'name' => 'action',
													'type' => 'submit',
													'content' => '<span class="glyphicon glyphicon-shopping-cart"></span> AÑADIR AL CARRO'
												);													
												
												// Submit Button.
												//echo form_submit($btn);
												echo form_button($btn);
												echo form_close();*/
											?>										
											</div>					
											<div class="clear"></div>
										</div>
									 <div class="wish-list">
									 	<ul>
										<!--
									 		<li class="wish"><a href="#">Add to Wishlist</a></li>
											-->
											<li class="wish">
												<div class="button">
													 <?php
													 $file   = $producto->url_file;
													 if(!empty($file)){ // si archivo no es null								
														$archivo=$file;								
													}else{						
														$archivo='';
													}	
													
													echo '<a href="'. base_url($archivo).'" class="btn btn-primary btn-lg" target="_blank"><span class="glyphicon glyphicon-download"></span> DESCARGAR FICHA</a>';
												   ?>	
												</div>	
											</li>
													
									 	    <li class="compare">
											<div class="button">
											 <?php
												$btn = array(
													'class' => 'btn btn-success',
													'value' => 'true',
													'name' => 'action',
													'type' => 'submit',
													'content' => '<span class="glyphicon glyphicon-shopping-cart"></span> AÑADIR AL CARRO'
												);
												
															/* $data = array(
															        'name' => 'button',
															        'id' => 'txtbox'.$idprod,									
															        //'value' => 'true',
															        'data-prod'=>$idprod,
															        'data-alerta'=>'alerta-prod'.$idprod,
															        'class' => 'btn btn-success btn-lg add-cart',
															        'type' => 'button',
															        //'type' => 'submit',
															        'title'=>'Agregar al pedido',
															        'content' => '<span class="glyphicon glyphicon-ok-sign"></span> Enviar'
															    );		*/		
												
												// Submit Button.
												//echo form_submit($btn);
												echo form_button($btn);
												echo form_close();
											?>										
											</div>											
									
											</li>
									 	</ul>
									 </div>											 
								<div class="colors-share">
								<!--
								 	<div class="color-types">
								 
										<h4>Sabores Disponibles</h4>
									
										
								
								 		<form class="checkbox-buttons">
											<ul>
												<li><input id="r1" name="r1" type="radio"><label for="r1" class="grey"> </label></li>
												<li><input id="r2" name="r1" type="radio"><label for="r2" class="blue"> </label></li>
												<li><input id="r3" name="r1" type="radio"><label class="white" for="r3"> </label></li>
												<li><input id="r4" name="r1" type="radio"><label class="black" for="r4"> </label></li>
											</ul>
										 </form>
									
									
								 	</div>
										 -->
								 	<div class="social-share">
								 		<h4>Compartir producto</h4>
								 			  <ul>
													<li><a class="share-face" href="#"> </a></li>
													<li><a class="share-twitter" href="#"> </a></li>
													<li><a class="share-google" href="#"> </a></li>
													<li><a class="share-rss" href="#"> </a></li>
													<div class="clear"> </div>
										    </ul>
								 	</div>
								 	<div class="clear"></div>
								</div>
								
							</div>
						<div class="clear"></div>
		  			</div>
					
				<!--
				  	<div class="product_desc">	
					<div id="horizontalTab">
						<ul class="resp-tabs-list">
							<li>Especificaciones</li>			
							<li>Calificar Producto</li>
							<div class="clear"></div>
						</ul>
						<div class="resp-tabs-container">
							<div class="product-specifications">
								<ul>
								  <li><span class="specification-heading">Potencia (kw)</span> <span>33.0kw(4hp)</span><div class="clear"></div></li>
				                  <li><span class="specification-heading">Velocidad (m/min)</span> <span>6.4</span><div class="clear"></div></li>
				                  <li><span class="specification-heading">N° Ramales x Ø Cadena</span> <span>1 x 11.2mm</span><div class="clear"></div></li>
				                    <li><span class="specification-heading">Voltaje (v)</span> <span>220/380/440</span><div class="clear"></div></li>
				                  <li><span class="specification-heading">Peso (kg)</span> <span>125</span><div class="clear"></div></li>
				    
				                </ul>
						 	</div>
						 
						   	<div class="product-tags">
								 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
								<h4>Add Your Tags:</h4>
								<div class="input-box">
									<input type="text" value="">
								</div>
								<div class="button"><span><a href="#">Add Tags</a></span></div>
					    	</div>
					    

							<div class="review">
								<h4>Lorem ipsum Review by <a href="#">Finibus Bonorum</a></h4>
								 <ul>
								 	<li>Price : <div class="rating-stars"><div class="rating" data-rating-max="5"> </div> </div>
									</li>
								 	<li>Value : <div class="rating-stars"><div class="rating" data-rating-max="5"> </div> </div></li>
								 	<li>Quality : <div class="rating-stars"><div class="rating" data-rating-max="5"> </div> </div></li>
								 </ul>
								 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
							  <div class="your-review">
							  	 <h4>How Do You Rate This Product?</h4>
							  	  <p>Write Your Own Review?</p>
							  	  <form>
								    	<div>
									    	<span><label>Nickname<span class="red">*</span></label></span>
									    	<span><input type="text" value=""></span>
									    </div>
									    <div><span><label>Summary of Your Review<span class="red">*</span></label></span>
									    	<span><input type="text" value=""></span>
									    </div>						
									    <div>
									    	<span><label>Review<span class="red">*</span></label></span>
									    	<span><textarea> </textarea></span>
									    </div>
									   <div>
									   		<span><input type="submit" value="SUBMIT REVIEW"></span>
									  </div>
								    </form>
							  	 </div>			
							
									</div>
							  </div>
						    </div>
					</div>
					-->

				
				</div>
			</div>
		</div>
	</div>
    <div class="col-sm-3 sin-espacio-der ">	
	<!--
		<div class="panel-group">
			<div class="panel panel-primary">
				 <div class="panel-heading heading-text" >					    
					    Categorias</div>					
				<div class="panel-body panel-body-color">
						<?php  //if(isset($catmenu)){ $this->load->view($catmenu);}   ?>		
				</div>
			</div>
		</div>
		-->
				<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading heading-text" >
						Productos Destacados</div><!--<p class="panel-heading-1" >&nbsp;</p>-->
						<div class="panel-body container-fondo">
					    	
					    		<?php  if(isset($featuresmod)){ $this->load->view($featuresmod);}   ?>	
						  
						</div>
					</div>
				</div>
				<div class="panel-group">
					<div class="panel panel-primary">
							<div class="panel-heading heading-text" >Ultimos Productos</div><!--<p class="panel-heading-1" >&nbsp;</p>-->
							<div class="panel-body container-fondo">
			
							<?php  if(isset($latestsmod)){ $this->load->view($latestsmod);}   ?>	
				
							
						</div>
					</div>
				</div>
				
				
	</div>


</div>
</div>