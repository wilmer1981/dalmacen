	
<!--content-->
<!---->
<div class="product">
	<div class="container">			
		<div class="col-md-9 product1">
			<div class=" bottom-product">				
				<nav class="in">			
				  	<?php echo $this->pagination->create_links(); ?>
				</nav>
			</div>

			<div class=" bottom-product">			
				     <?php
						//var_dump($productos);
				     //echo "Cantidad: ".count($productos);
						foreach($productos as $p){	
								$id      = $p->id;       
								$titu    =  $this->funciones->cut_string($p->nombre, 30);
								$titulo  = $p->nombre;
								$link    = $id."-".$titulo;
								$precio   = $p->precio;
        						$poferta  = $p->precio_oferta;
								$url1    = $id."-".$p->url;
								$des     = $this->funciones->cut_string($p->descripcion, 30);
								$img     = $p->url_imagen;	
									if($img)
										$image='admin/'.$img;
									else
										$image='assets/images/404.png';	

								if(!empty($p->precio_oferta)){
						          $pfinal= $p->precio_oferta;
						        }else{		    
						          $pfinal= $p->precio;               
						        }

								if($p->oferta==1){
									$precio = 'S/ '.$p->precio;
								}else{
								   $precio = '';	
								}
								

						?>
						<div class="col-md-4 bottom-cd simpleCart_shelfItem">
							<?php
							echo '<div class="product-at ">';
							echo '<a href="'.base_url().'producto/'.$url1.'"><img class="img-responsive" src="'.base_url($image).'" alt="" /><div class="pro-grid"><span class="buy-in">Compra ahora</span></div>
							    </a>';	
							echo '</div>';

							echo '<p class="tun">'.$titulo.'</p>';
							 echo '<a href="#" class="item_add"><p class="flexisel_ecommerce_cart"><span>'.$precio.'</span><i class="item_price"> S/ '.$pfinal.'</i></p></a>';	

							//echo '<a href="#" class="item_add"><p class="number item_price"><i></i>S/ '.$pfinal.'</p></a>	';
							 ?>
							
						</div>				 
						
						<?php	
						}						
						?>				
				
		    </div>
		    <div class="clearfix"> </div>
		    <nav class="in">
				<?php echo $this->pagination->create_links(); ?>
				<!--
				  <ul class="pagination">
					<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
					<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
					<li><a href="#">2 <span class="sr-only"></span></a></li>
					<li><a href="#">3 <span class="sr-only"></span></a></li>
					<li><a href="#">4 <span class="sr-only"></span></a></li>
					<li><a href="#">5 <span class="sr-only"></span></a></li>
					 <li> <a href="#" aria-label="Next"><span aria-hidden="true">»</span> </a> </li>
				  </ul>
				-->
			
			</nav>
		</div>
		<div class="col-md-3 product-price">
		    <div class=" rsidebar span_1_of_left">
					<div class="of-left">
						<h3 class="cate">Categorías</h3>
					</div>
					<?php
						if(isset($menucategorie)){ $this->load->view($menucategorie);} 
						//if(isset($menucat)){ $this->load->view($menucat);} 
					?>
				<!--
				<ul class="menu">
					<li class="item1"><a href="#">Men </a>
						<ul class="cute">
							<li class="subitem1"><a href="single.html">Cute Kittens </a></li>
							<li class="subitem2"><a href="single.html">Strange Stuff </a></li>
							<li class="subitem3"><a href="single.html">Automatic Fails </a></li>
						</ul>
					</li>
					<li class="item2"><a href="#">Women </a>
						<ul class="cute">
							<li class="subitem1"><a href="single.html">Cute Kittens </a></li>
							<li class="subitem2"><a href="single.html">Strange Stuff </a></li>
							<li class="subitem3"><a href="single.html">Automatic Fails </a></li>
						</ul>
					</li>
					<li class="item3"><a href="#">Kids</a>
						<ul class="cute">
							<li class="subitem1"><a href="single.html">Cute Kittens </a></li>
							<li class="subitem2"><a href="single.html">Strange Stuff </a></li>
							<li class="subitem3"><a href="single.html">Automatic Fails</a></li>
						</ul>
					</li>
					<li class="item4"><a href="#">Accesories</a>
						<ul class="cute">
							<li class="subitem1"><a href="single.html">Cute Kittens </a></li>
							<li class="subitem2"><a href="single.html">Strange Stuff </a></li>
							<li class="subitem3"><a href="single.html">Automatic Fails</a></li>
						</ul>
					</li>							
					<li class="item4"><a href="#">Shoes</a>
						<ul class="cute">
							<li class="subitem1"><a href="product.html">Cute Kittens </a></li>
							<li class="subitem2"><a href="product.html">Strange Stuff </a></li>
							<li class="subitem3"><a href="product.html">Automatic Fails </a></li>
						</ul>
					</li>
				</ul>
				-->
		    </div>
		    	<!--
	           <div class="product-middle">		
					<div class="fit-top">
						<h6 class="shop-top">Lorem Ipsum</h6>
						<a href="single.html" class="shop-now">SHOP NOW</a>
				        <div class="clearfix"> </div>
					</div>
				</div>	
				--> 
				<div class="sellers">
					<div class="of-left-in">
						<h3 class="tag">Tags</h3>
					</div>
					<div class="tags">
						<ul>
							<li><a href="#">design</a></li>
							<li><a href="#">fashion</a></li>
							<li><a href="#">lorem</a></li>
							<li><a href="#">dress</a></li>
							<li><a href="#">fashion</a></li>
							<li><a href="#">dress</a></li>
							<li><a href="#">design</a></li>
							<li><a href="#">dress</a></li>
							<li><a href="#">design</a></li>
							<li><a href="#">fashion</a></li>
							<li><a href="#">lorem</a></li>
							<li><a href="#">dress</a></li>
							
							<div class="clearfix"> </div>
						</ul>						
					</div>								
		        </div>
		
				<div class="product-bottom">
					<div class="of-left-in">
						<h3 class="best">Más vendidos</h3>
					</div>
					<div class="product-go">
						<div class=" fashion-grid">
									<a href="<?php echo base_url('productos/preview'); ?>"><img class="img-responsive " src="<?php echo base_url('assets/images/p1.jpg'); ?>" alt=""></a>
									
								</div>
							<div class=" fashion-grid1">
								<h6 class="best2"><a href="single.html" >Lorem ipsum dolor sit
                          amet consectetuer  </a></h6>
								
								<span class=" price-in1"> $40.00</span>
							</div>
								
							<div class="clearfix"> </div>
							</div>
							<div class="product-go">
						<div class=" fashion-grid">
									<a href="single.html"><img class="img-responsive " src="<?php echo base_url('assets/images/p2.jpg'); ?>" alt=""></a>
									
								</div>
							<div class="fashion-grid1">
								<h6 class="best2"><a href="single.html" >Lorem ipsum dolor sit
                                 amet consectetuer </a></h6>
								
								<span class=" price-in1"> $40.00</span>
							</div>
								
							<div class="clearfix"> </div>
							</div>
					
				</div>
                <div class=" per1">
					<a href="single.html" ><img class="img-responsive" src="<?php echo base_url('assets/images/pro.jpg'); ?>" alt="">
					<div class="six1">
						<h4>DISCOUNT</h4>
						<p>Up to</p>
						<span>60%</span>
					</div></a>
				</div>
		</div>		
	</div>
</div>
<!--//content-->
