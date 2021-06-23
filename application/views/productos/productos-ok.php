<div class="container-page">
<!-- categorias-->
	<div class="container">
		<div class="row">
			
	<div class="col-sm-3 sin-spacio">
				<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading heading-text" >
					    <i class="glyphicon glyphicon-list color-icon"></i>
					     Categorias</div><p class="panel-heading-1" >&nbsp;</p>
						<div class="panel-body panel-body-color">
					    	<div class="content-bottom-left">
					    		<div id='flyout_menu'>
					    		    <ul>
						                <?php						         
							            foreach($categorias as $cat){ 				           

							             	$id  	= $cat->id;       
							                $des 	=utf8_encode($cat->titulo);
							                $link1  = $id."-".$des;
							                $url1   = urls_amigables($link1);
							             	$sub  	= $cat->sub;  
	  									
							                //echo '<li><a href="#">'.$des.'</a>';
							                echo '<li><a href="'.base_url().'catalogo/paginas/'.$url1.'">'.$des.'</a>';
							                if($sub==1){						          
								                echo '<ul>';
								             	 	foreach($subcategorias as $sub){
								             	 		$subid  = $sub->id; 
								             	 	    $catid  = $sub->categoria_id; 
								             	 	    $subdes = utf8_encode($sub->descripcion);
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

				<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading heading-text" >Suscripcion</div>
					  
						<div class="panel-body container-fondo">
							    	<div class="content-bottom-left"> 	
									
										<div class="buters-guide">															
											<p>Recibe la última información de nuestros productos, ofertas y novedades.</p>
											<div class="col-md-12">
												<?php echo form_open() ?>							
												<div class="form-group">										
													<input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su E-mail">										
												</div>								
												<div class="form-group">
													<input type="submit" class="btn btn-success btn-lg btn-block" value="SUSCR&Iacute;BETE">
												</div>
												<?php echo form_close(); ?>
											</div>
										</div>								
										
					    	    	</div>					  
						</div>
					</div>
				</div>
			</div>

		<div class="col-sm-9">
			<div class="panel-group border-containt">
				<div class="panel panel-primary">
					<div class="panel-heading heading-text"><?php echo $breadcrumb->titulo_subcategoria; ?></div>
					<div class="panel-body panel-width container-fondo">

						<div class="row">
							<div class="col-lg-12 col-sm-6">
						 		<?php //echo $this->pagination->create_links() ?>
							</div>
						</div>
						
						<?php
						foreach($productos as $producto){								
								$id    =$producto->producto_id;	
								$titulo=utf8_encode($producto->nombre);						
								$descri=utf8_encode($producto->descripcion);

								//$des = $this->funciones->cut_string($cat->descripcion, 30);
								$img=$producto->url_img;					
									if($img)
										$image='admin/images/productos/'.$img;
									else
										$image='assets/images/text.png';
						?>								
							
					 	<div class="row">
						 	<div class="product-details">
							 	<div class="col-lg-3 col-sm-3">
							 		<div class="grid foto">
							 			<img class="etalage_image" src="<?php echo base_url($image) ?>" />
								    </div>					
							 	</div>
							  	<div class="col-lg-9 col-sm-9">
							  		<div class="desc span_31_of_2">
										<h2><?php echo $titulo; ?></h2>
										<p><?php echo $descri; ?></p>
										<div class="table-responsive">	
										<table>
										<tr>
										<td>			
											<div class="available">									 
											  		<ul>
												 		<li><span>Modelo: SSDHL03 - 01</span></li>
												 	    <li><span>Capacidad: 3</span></li>
												 	    <li><span>Izaje : 3/9</span></li>
												 	</ul>														
											</div>
										</td>
										<td>		
												<div class="wish-list">
													 	<ul>
													 		<li class="wish"><a href="<?php echo base_url('assets/uploads/files/Ficha-Polipasto-cadena-3TN-TXK.pdf') ?>" class="btn btn-primary btn-lg" target="_blank"><span class='glyphicon glyphicon-download'></span> Ficha Tecnica</a></li>
													 	    <li class="compare"><a href="#" class="btn btn-success btn-lg"><span class='glyphicon glyphicon-info-sign'></span> Solicitar Cotizacion</a></li>
													 	</ul>
												</div>
										</td>
										</tr>
										</table>
										</div>

									</div>
							  	 
						 	</div>
						 	<div class="clear"></div>
						</div>
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



	  
	




