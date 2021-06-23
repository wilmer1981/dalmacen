<?php
$grand_total = 0;
// Calculate grand total.
if ($cart = $this->cart->contents()):
    foreach ($cart as $item):
        $grand_total = $grand_total + $item['subtotal'];
     endforeach;
endif;
?>

<div class="container-page">
<!-- categorias-->
	<div class="container">
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
					    <!--
					    <i class="glyphicon glyphicon-list color-icon"></i>-->
					     Categorias</div><p class="panel-heading-1" >&nbsp;</p>
						<div class="panel-body panel-body-color">
					    	<div class="content-bottom-left">
					    		<div id='flyout_menu'>
					    		    <ul>
						                <?php						         
							            foreach($categorias as $cat){ 
							             	$id  	= $cat->id;       
							                $des 	= $cat->titulo;
							                $link1  = $id."-".$des;
							                $url1   = urls_amigables($link1);
							             	$sub  	= $cat->sub;  	  								
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

				<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading heading-text" >CARRO DE COMPRAS</div>
					  
						<div class="panel-body container-fondo">
							<div class="content-bottom-left">
					

										
					    	
					    	</div>					  
						</div>
					</div>
				</div>

			</div>

		<div class="col-sm-9">
			<div class="panel-group border-containt">
				<div class="panel panel-primary">
					<div class="panel-heading heading-text"><?php //echo $breadcrumb->titulo_subcategoria;
													echo "CARRO DE COMPRAS"; ?></div>
					<div class="panel-body panel-width container-fondo">

						<div class="row">
							<div class="col-lg-12 col-sm-6">
						 		<div id="bill_info">
            
						            <?php // Create form for enter user imformation and send values 'shopping/save_order' function?>
						            <?php
						                $cart_check = $this->cart->contents();
						                        
						                // If cart is empty, this will show below message.
						                if(empty($cart_check)) {
						                    $total=0;
						                }else{

						                    if ($cart = $this->cart->contents()){
						                          $i = 1;
						                          foreach ($cart as $item){
						                            $i++;
						                          }
						                          $total=$i-1;
						                    }
						                    //$total=$this->cart->total(); //total monto en dinero
						                    // $total=$this->cart->total_items(); //total productos
						                }  

               						?>

						            <form name="billing" method="post" action="<?php echo base_url() . 'shopping/save_order' ?>" >
						                <input type="hidden" name="command" />
						                <div align="center">
						                    <h1 align="center">Billing Info</h1>
						                    <table border="0" cellpadding="2px">
						                     <tr>
						                        <td>Total Productos:</td><td>
						                        <strong>
						                        <?php 
						                       // echo $this->cart->total_items();
						                        echo $total;
						                         ?>
						                        	
						                        </strong></td></tr>
						                        <tr><td>Nombre o Razon Social:</td><td><input type="text" name="name" required=""/></td></tr>
						                        <tr><td>RUC:</td><td><input type="text" name="address" required="" /></td></tr>
						                        <tr><td>E-mail:</td><td><input type="text" name="email" required="" /></td></tr>
						                        <tr><td>Telefono:</td><td><input type="text" name="phone"  required="" /></td></tr>
						                        <tr><td><?php
						                        // This button for redirect main page.
						                        echo "<a class ='fg-button teal' id='back' href=" . base_url() . "shopping>Regresar</a>";  ?>
						                            </td><td><input type="submit" class ='fg-button teal' value="Enviar" /></td></tr> 
						                     
						                    </table>
						                </div>
						            </form>
						        </div>



							</div>


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



	  
	




