<div class="container-page">
	<div class="container container-fondo">	
		
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="left-sidebar">
						<h2>Categorias</h2>
						<div class="panel-group category-products" id="accordian">
							<!--category-productsr-->
							<?php  if(isset($catmenu)){ $this->load->view($catmenu);}   ?>	
							
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Marcas</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<!--price-range-->
						<!--
						<div class="price-range">
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div>
					-->
						<!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="<?php echo base_url('assets/images/home/shipping.jpg')?>" alt="" />
						</div><!--/shipping-->
					
					</div>
			</div>

			<div class="col-sm-9 sin-espacio-der">
				<div class="panel-group border-containt">
					<div class="panel panel-primary">
						<div class="panel-heading heading-text"><!--<i class="glyphicon glyphicon-gift color-icon"></i>--> <?php echo $breadcrumb->titulo_categoria; ?></div>
						<!--<p class="panel-heading-2" >&nbsp;</p>-->
						<div class="panel-body container-fondo"> 
							<div class="content-bottom-right">    	    
		            			<div class="section group">

			           				<?php
									$i=1;
									while($i<2){
										foreach($catalogosubcat as $subcat){	

										$subid  = $subcat->id; 
								        $catid  = $subcat->categoria_id; 
								        $subdes = $subcat->titulo;
								        $link   = $subid."-".$subdes;
								        $url    = urls_amigables($link);										
										$img    = $subcat->url_img;

												//$des = $this->funciones->cut_string($cat->descripcion, 30);

											if($img)
												$image='admin/'.$img;
											else
												$image='assets/images/text.png';
									?>								
									    <div class="grid_1_of_4 images_1_of_4">					 
									
										<?php
										echo '<a href="'.base_url().'catalogo/productos/'.$url.'"><img src="'.base_url($image).'" alt="" /></a>';	
										?>

											<div class="price-details">
										       <div class="price-number">									       <!--
													<p><span class="rupees">$839.93 </span></p>-->
													<h4>
													<?php
													echo '<a href="'.base_url().'catalogo/productos/'.$url.'">'.$subdes.'</a>';	
													?>	          	 	
								             	
												
													</h4>
											    </div>										
												<div class="clear"></div>
											</div>										 
										</div>

									<?php	
										}
									$i++;
									}
									?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>