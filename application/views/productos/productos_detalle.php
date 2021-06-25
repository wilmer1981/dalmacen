
<!--content-->
<div class="product">
		<div class="container">
				 <?php                    
				// Create form and send values in 'shopping/add' function.
				$price="1"; 
				$message=""; 	
			    if(!empty($producto[0]->precio_oferta)){
		          $pfinal= $producto[0]->precio_oferta;
		        }else{		    
		          $pfinal= $producto[0]->precio;               
		        }

			    $message=""; 
			    //echo "Id Prod: ".$producto[0]->id;
			   // echo "-Precio: ".$pfinal;
			   // echo "-Nombre: ".$producto[0]->nombre;
			    //echo "-Imagen: ".$producto[0]->url_imagen;
				echo form_open('shopping/add');
				echo form_hidden('id', $producto[0]->id);
				echo form_hidden('image', $producto[0]->url_imagen);
				echo form_hidden('name', $producto[0]->nombre);
				echo form_hidden('message', $message);
				echo form_hidden('price', $pfinal);							
				
				?>								
			<div class="col-md-12 product-price1 not-padding">
				<div class="col-md-7 single-top">				
					<div class="flexslider" style="direction:ltr">
					    <ul class="slides">
					    <?php 
						$idprod = $producto[0]->id;
						$images = getProductImages($idprod);
						if($images){						
							foreach($images as $i){	
								$id       = $i->id;  
								$img      = $i->url_imagen;  
								$image   ='admin/'.$img;
								echo '<li data-thumb="'.base_url($image).'"><img src="'.base_url($image).'"></li>';
							}
						}else{
							$img = $producto[0]->url_imagen;
							$image   ='admin/'.$img;
							echo '<li data-thumb="'.base_url($image).'"><img src="'.base_url($image).'"></li>';
						}						
						?>
					    </ul>
					</div>
				</div>	
				<div class="col-md-5 single-top-in">
					<div class="single-para ">
						<h4><?php echo $producto[0]->nombre; ?></h4>
							<div class="star-on">
								<ul class="star-footer">
									    <li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
								</ul>
								<div class="review">
									<a href="#"> 1 visto </a>									
								</div>
							    <div class="clearfix"> </div>
							</div>
							<p class="flexisel_cart">
								<span>
									<?php 
									if($producto[0]->oferta==1){
										echo 'S/ '.$producto[0]->precio;
									}else{
									   echo '';	
									}
									?>										
								</span>
								<i class="item_price"><?php echo 'S/ '.$pfinal; ?></i>
							</p>
							
							<p><?php echo $producto[0]->descripcion; ?></p>
							<div class="available">
								<ul>
									<!--
									<li>Color
										<select>
										<option>Silver</option>
										<option>Black</option>
										<option>Dark Black</option>
										<option>Red</option>
									</select>
									</li>
									-->
								<?php if($producto[0]->id_categoria==3 || $producto[0]->id_categoria==4){ ?>
								<li class="size-in">Talla<select>
									<option>Large</option>
									<option>Medium</option>
									<option>small</option>
									<option>Large</option>
									<option>small</option>
									</select>
								</li>
								<?php } ?>
								<li class="size-in">Cantidad<input type="number" class="text_box" id="quantity" name="quantity" value="1" min="1" /></li>

								<div class="clearfix"> </div>
							</ul>
						   </div>
							<ul class="tag-men">
								<li><span>TAG</span>
								<span class="women1">: <?php  echo $producto[0]->categoria;  ?></span></li>
								<li><span>SKU</span>
								<span class="women1">: <?php  echo $producto[0]->codigo;  ?></span></li>
							</ul>
							<?php
								$btn = array(
									'class' => 'add-cart item_add',
									'value' => 'true',
									'name' => 'action',
									'type' => 'submit',
									'content' => 'Añadir al carro'
								);											
								echo form_button($btn);
							?>											
						</div>
					</div>
					<?php echo form_close(); ?>	
				<div class="clearfix"> </div>			
				<!--
				<div class="cd-tabs is-ended">
					<nav>
						<ul class="cd-tabs-navigation">
							<li><a data-content="fashion"  href="#0">Description </a></li>
							<li><a data-content="cinema" href="#0" >Addtional Informatioan</a></li>
							<li><a data-content="television" href="#0" class="selected ">Reviews (1)</a></li>
						</ul> 
					</nav>
					<ul class="cd-tabs-content">
						<li data-content="fashion" >
							<div class="facts">
							   <p > There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined </p>
								<ul>
									<li>Research</li>
									<li>Design and Development</li>
									<li>Porting and Optimization</li>
									<li>System integration</li>
									<li>Verification, Validation and Testing</li>
									<li>Maintenance and Support</li>
								</ul>         
					        </div>
						</li>
						<li data-content="cinema" >
							<div class="facts1">										
								<div class="color"><p>Color</p>
									<span >Blue, Black, Red</span>
									<div class="clearfix"></div>
								</div>
								<div class="color">
									<p>Size</p>
									<span >S, M, L, XL</span>
									<div class="clearfix"></div>
								</div>										        
							</div>
						</li>
						<li data-content="television" class="selected">
							<div class="comments-top-top">
								<div class="top-comment-left">
									<img class="img-responsive" src="<?php echo base_url('assets/images/co.png'); ?>" alt="">
								</div>
								<div class="top-comment-right">
									<h6><a href="#">Hendri</a> - September 3, 2014</h6>
									<ul class="star-footer">
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
									</ul>
									<p>Wow nice!</p>
								</div>
								<div class="clearfix"> </div>
								<a class="add-re" href="#">ADD REVIEW</a>
							</div>
						</li>
	                    <div class="clearfix"></div>
		            </ul> 
	            </div> 
				-->
				<div class="content-similares">
					<div class="section-header">
							<h3>PRODUCTOS SIMILARES</h3>
					</div>
					<div class="divider"></div> 
					<div class=" bottom-product">
						<div class="col-md-4 bottom-cd simpleCart_shelfItem">
							<div class="product-at ">
								<a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/pi3.jpg'); ?>" alt="">
								<div class="pro-grid">
											<span class="buy-in">Buy Now</span>
								</div>
							</a>	
							</div>
							<p class="tun">It is a long established fact that a reader</p>
							<a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>						
						</div>
						<div class="col-md-4 bottom-cd simpleCart_shelfItem">
							<div class="product-at ">
								<a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/pi1.jpg'); ?>" alt="">
								<div class="pro-grid">
											<span class="buy-in">Buy Now</span>
								</div>
							</a>	
							</div>
							<p class="tun">It is a long established fact that a reader</p>
						<a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>
						</div>
						<div class="col-md-4 bottom-cd simpleCart_shelfItem">
							<div class="product-at ">
								<a href="#"><img class="img-responsive" src="<?php echo base_url('assets/images/pi4.jpg'); ?>" alt="">
								<div class="pro-grid">
											<span class="buy-in">Buy Now</span>
								</div>
							</a>	
							</div>
							<p class="tun">It is a long established fact that a reader</p>
						<a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>					
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
            </div>

		<div class="clearfix"> </div>
	</div>
</div>
<!--//content-->