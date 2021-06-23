<div class="container-page">
<!-- categorias-->
	<div class="container container-fondo">
		<div class="row">
			
	    <div class="col-sm-3 sin-spacio category-sec">
				<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading heading-text" >
					      Productos</div><p class="panel-heading-1" >&nbsp;</p>
						<div class="panel-body panel-body-color">
					    	<div class="content-bottom-left">
							<?php  if(isset($catmenu)){ $this->load->view($catmenu);}   ?>	
		
							</div>					  
						</div>
					</div>
				</div>
		</div>

		<div class="col-sm-9 sin-espacio-der">
			<div class="panel-group border-containt">
				<div class="panel panel-primary">
					<div class="panel-heading heading-text">
					<?php 
					echo 'Catalogo de Productos'; 
					//echo $breadcrumb->titulo_subcategoria; 
					?></div>
					<div class="panel-body panel-width container-fondo">

						<div class="row">
							<div class="col-lg-12 col-sm-6">
						 		<?php echo $this->pagination->create_links() ?>
							</div>
						</div>
						
						<?php

						//var_dump($productos);
						foreach($productos as $producto){	

								$idprod = $producto->producto_id;	
								$titulo = $producto->nombre;						
								$descri = $producto->descripcion;	
								$iza    = $producto->izaje;	
								$cap    = $producto->capacidad;
								$vel    = $producto->velocidad;	
								$pot    = $producto->potencia;	
								$med    = $producto->medidas;	
								$pes    = $producto->peso;	
								$lon    = $producto->longitud;	
								$cer    = $producto->certificacion;
								$cru    = $producto->cruptura;	
								$ome    = $producto->omedidas;		
								$mod    = $producto->modelo;	
								$mar    = $producto->marca;	
								$catid  = $producto->categoria_id;	
								$subid  = $producto->subcategoria_id;	
								
								$link1   = $idprod."-".$titulo;
								$url1    = urls_amigables($link1);

								$img   =$producto->url_img;					
								if($img)
										//$image='admin/images/productos/'.$img;
									    $image='admin/'.$img;
								else
										$image='assets/images/text.png';


								if( !empty($filesprod) ) { // si existe archivo
								
										foreach($filesprod as $files){	
											$id      = $files->product_id;
											$file    = $files->url_file;
											
											if($id==$idprod){												
												if(!empty($file)){ // si archivo no es null
													//$archivo='admin/'.$file;	
													$archivo=$file;								
												}else{
													//$archivo='assets/uploads/files/Ficha-Polipasto-cadena-3TN-TXK.pdf';
													$archivo='';
												}											
											}
										}
									}else{ // si no hay archivos
										//$archivo='assets/uploads/files/Ficha-Polipasto-cadena-3TN-TXK.pdf';
										$archivo='';
									}	

									
						?>
						<div class="grid_1_of_4 images_1_of_4">										
							<?php
							
							echo '<a href="'.base_url().'productos/preview/'.$url1.'"><img src="'.base_url($image).'" alt="" />
									</a>';	
							echo '<div class="preview-titulo"><h4><a href="'.base_url().'productos/preview/'.$url1.'">'.$titulo.'</a></h4></div>';										
							
							echo ' <div class="add-carrito"><h4><a href="'.base_url().'productos/preview/'.$url1.'">Ver m&aacute;s...</a></h4></div>';
							
							?>							
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


<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" align="center">
					<img class="img-circle" id="img_logo" src="<?php echo base_url('assets/images/isotipo-mp.png') ?>">
					<!--
					<img class="img-circle" id="img_logo" src="http://bootsnipp.com/img/logo.jpg">-->
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</div>
                
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                
                    <!-- Begin # Login Form -->
                    
                    <form id="form-cotizacion" name="form-cotizacion" method="post">
                    
                    
                    <!--
                    <form id="form-cotizacion" action="<?php echo base_url('contactenos/cotizacion'); ?>" method="post">
                    -->
                  
		                <div class="modal-body">
				    		<div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">Formulario de Cotizacion</span>
                            </div>
				    		<input id="nombre" class="form-control" type="text" placeholder="Nombre" required>
				    		<input id="correo" class="form-control" type="text" placeholder="E-mail" required>
				    		<input id="telefono" class="form-control" type="text" placeholder="Telefono" required>
				    		<input id="idprod" type="hidden" class="form-control" type="text" placeholder="idproducto" required>
				    		<input id="producto" class="form-control" type="text" placeholder="producto" required>
				    	<!--
				    		<textarea id="descripcion" class="form-control" placeholder="Descripcion Producto" required></textarea> 
				    		-->
				    					    	
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Aceptar condiciones
                                </label>
                            </div>
        		    	</div>
				        <div class="modal-footer">
				           <div id="status"></div>
                            <div id="boton">                          
                                 <input class="btn btn-primary" id="btn-cotizacion" name="btn-cotizacion" type="button" value="Enviar Solicitud" />
                            </div>
				    	    <!--
				    	    <div>
                                <button id="login_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                                <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                            </div>
                            -->
				        </div>
                    </form>
                    <!-- End # Login Form -->
                    
                    <!-- Begin | Lost Password Form -->
                    <form id="lost-form" style="display:none;">
    	    		    <div class="modal-body">
		    				<div id="div-lost-msg">
                                <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-lost-msg">Type your e-mail.</span>
                            </div>
		    				<input id="lost_email" class="form-control" type="text" placeholder="E-Mail (type ERROR for error effect)" required>
            			</div>
		    		    <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
                            </div>
                            <div>
                                <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                                <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
                            </div>
		    		    </div>
                    </form>
                    <!-- End | Lost Password Form -->
                    
                    <!-- Begin | Register Form -->
                    <form id="register-form" style="display:none;">
            		    <div class="modal-body">
		    				<div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Register an account.</span>
                            </div>
		    				<input id="register_username" class="form-control" type="text" placeholder="Username (type ERROR for error effect)" required>
                            <input id="register_email" class="form-control" type="text" placeholder="E-Mail" required>
                            <input id="register_password" class="form-control" type="password" placeholder="Password" required>
            			</div>
		    		    <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                            </div>
                            <div>
                                <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                                <button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                            </div>
		    		    </div>
                    </form>
                    <!-- End | Register Form -->
                    
                </div>
                <!-- End # DIV Form -->
                
			</div>
		</div>
	</div>
    <!-- END # MODAL LOGIN -->



	  
	




