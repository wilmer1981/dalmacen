<div class="container-page">
	<div class="container container-fondo">
	    <div class="row">
	      <div class="col-md-12 content_left">
				<ul class="back-links">
						<!--
						<li><a href="#">Inicio</a> /</li>
						<li><a href="#">Categoria</a> /</li>
						<li>Subcaregoria</li>
						-->
						<div class="clear"> </div>
					</ul>
	   	 	</div>

		</div>
		
		<div class="row">
			<div class="col-sm-3 sin-spacio">
				<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading heading-text" >
					    Productos</div><p class="panel-heading-1" >&nbsp;</p>
						<div class="panel-body panel-body-color">
					    	<div class="content-bottom-left">
					    		<div id='flyout_menu'>
					    		    <ul>
						                <?php						         
							            foreach($categorias as $cat){               
							                $id      =  $cat->id;       
							                $des     =   $cat->titulo;
							                $link1   = $id."-".$des;
							                $url1    = urls_amigables($link1);
							             	$sub  = $cat->sub;  

	  									
							               // echo '<li><a href="#">'.$des.'</a>';
							                echo '<li><a href="'.base_url().'catalogo/paginas/'.$url1.'">'.$des.'</a>';
							                if($sub==1){						          
								                echo '<ul>';
								             	 	foreach($subcategorias as $sub){
								             	 		$subid  = $sub->id; 
								             	 	    $catid  = $sub->categoria_id; 
								             	 	    $subdes = $sub->descripcion;
								             	 	    $link   = $subid."-".$subdes;
								             	 	    $url    = urls_amigables($link);
								             	 	    if($id==$catid){						             	 	 
								             	 	    	echo '<li><a href="'.base_url().'catalogo/productos/'.$url.'">'.$subdes.'</a></li>';						             	 	
								             			}
								             		}
								             	echo '</ul>';
								             }
							             	echo '</li>';	
							            }         
							            ?> 
							        </ul>				  
								</div>
							</div>					  
						</div>
					</div>
				</div>
				<!--
				<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading heading-text" >Suscripcion</div>
					  
						<div class="panel-body container-fondo">
					    	<div class="content-bottom-left"> 							
								<div class="buters-guide">									
									<p>Recibe la última información de nuestros productos, ofertas y novedades.</p>
									<div class="col-md-12">
									
										<form name="frm_suscription_register" id="frm_suscription_register">								
										<div class="form-group">								
											<input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su E-mail">		
										</div>								
										<div class="form-group">										
											<input type="button" class="btn btn-success btn-lg btn-block btn-register" value="SUSCR&Iacute;BETE" />
										</div>
									
										</form>
									
										<div id="estatus"></div>
									</div>
								</div>								
								
			    	    	</div>					  
						</div>
					</div>
				</div>
				-->
			
			</div>

			<div class="col-sm-9">
				<div class="panel-group border-containt">
					<div class="panel panel-primary">
						<div class="panel-heading heading-text">
						<!--<i class="glyphicon glyphicon-gift color-icon"></i> -->
						Nuestros Productos</div><p class="panel-heading-2" >&nbsp;</p>
						<div class="panel-body container-fondo"> 
							<div class="content-bottom-right">    	    
		            			<div class="section group">

			           				<?php
								
										foreach($categorias as $cat){								

										$id  = $cat->id;       
							            $titu = $cat->titulo;
							            $link1   = $id."-".$titu;
							            $url1    = urls_amigables($link1);
										$des = $this->funciones->cut_string($cat->descripcion, 30);
										$img=$cat->url_img;					
											if($img)
												$image='admin/'.$img;
											else
												$image='assets/images/text.png';
									?>

											<div class="col-md-4 gal-left gal_mar">
												<div class="content-grid-effect slow-zoom vertical text-center">

													<?php
													echo '<a href="'.base_url().'catalogo/paginas/'.$url1.'">
														<div class="img-box">								
															<img src="'.base_url($image).'" alt="" class="img-responsive zoom-img" />
														</div>
														<div class="info-box">
															<div class="info-content">
																<h4>'.$titu.'</h4>
																<span class="separator"></span>
																<p>'.$des.'</p>
															</div>
														</div>
												
														</a>';
																?>													
												</div>
											</div>	


									<!--								
									    <div class="grid_1_of_4 images_1_of_4">							 
										
											<?php
											//echo '<a href="'.base_url().'catalogo/paginas/'.$url1.'"><img src="'.base_url($image).'" alt="" /></a>';
											?>		
											<div class="price-details">
										       <div class="price-number">									
													<h4>
													<?php
													//echo '<a href="'.base_url().'catalogo/paginas/'.$url1.'">'.$des.'</a>';
													?>										
												
													</h4>
											    </div>										
												<div class="clear"></div>
											</div>										 
										</div>
										-->

									<?php	
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



	  
	




