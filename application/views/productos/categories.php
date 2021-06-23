<!-- Busqueda-->
<!--
<div class="container">

	<div class="row">
		<div class="col-sm-6">
			<div class="panel-group">
				<div class="panel panel-primary">
				    <div class="panel-heading heading-text" >B&uacute;squeda espec&iacute;fica</div><p class="panel-heading-1" >&nbsp;</p>
						<div class="panel-body">
							<form class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-xs-3">&nbsp;</label>
								<div class="col-xs-3">
									<label class="radio-inline">
										<input type="radio" name="tipoBusqueda" value="t" checked> Todos
									</label>
								</div>
								<div class="col-xs-3">
									<label class="radio-inline">
										<input type="radio" name="tipoBusqueda" value="c"> Comprar
									</label>
								</div>
								<div class="col-xs-3">
									<label class="radio-inline">
										<input type="radio" name="tipoBusqueda" value="a"> Alquilar
									</label>
								</div>
							</div>
											
							<div class="form-group">
								<label for="inputEmail" class="control-label col-xs-3">Estado</label>
								<div class="col-xs-8">
									<select class="form-control" name="estado" id="estado">
										<option value="">Escoje Estado</option>
											<?php
											foreach($estados as $fila){
												$id=$fila->id;
												$nom=utf8_encode($fila->descripcion);
												echo "<option value='$id'>$nom</option>";
											}
											?>								
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="control-label col-xs-3">Categoria</label>
								<div class="col-xs-8">
									<select class="form-control" name="categoria" id="categoria">
										<option value="">Escoje la categoria</option>
									  	<?php
											foreach($categorias as $fila){
												$id=$fila->id;
												$nom=utf8_encode($fila->descripcion);
												echo "<option value='$id'>$nom</option>";
											}
										?>		
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="control-label col-xs-3">Marca</label>
								<div class="col-xs-8">
									<select class="form-control" name="marca" id="marca">
									 <option value="">Escoje tu marca</option>									
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="control-label col-xs-3">Modelo</label>
								<div class="col-xs-8">
									<select class="form-control" name="modelo" id="modelo">
									 <option value="">Escoje el modelo</option>						
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-offset-2 col-xs-9">
								<button type="button" class="btn btn-default btn-lg">
 <span style="color:red;" class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
</button>
									<button type="submit" class="btn btn-primary boton-ver">Buscar&nbsp;&nbsp;  <span style="color:orange;" class="glyphicon glyphicon-search"></span> </button>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-11"> 
									<label class="boton-ver"><a href="#">Busqueda avanzada » <i class="fa fa-search"></i></a></label>
								</div>
							</div>
					</form>					  
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading heading-text">Mensajes a proveedores</div><p class="panel-heading-2" >&nbsp;</p>
					<div class="panel-body"> 
						<form class="form-horizontal">									
						<div class="row">
							<div class="col-xs-6">						
									<div class="form-group">
										<label class="control-label col-xs-3">Nombre</label>
										<div class="col-xs-8">
											<input type="email" class="form-control" id="inputNombre" placeholder="Nombre">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail" class="control-label col-xs-3">Celular</label>
										<div class="col-xs-8">
											<input type="email" class="form-control" id="inputEmail" placeholder="Celular">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail" class="control-label col-xs-3">Email</label>
										<div class="col-xs-8">
											<input type="email" class="form-control" id="inputEmail" placeholder="Email">
										</div>
									</div>
							</div>									
							<div class="col-xs-6">
								<div class="form-group">
										<label for="inputPassword" class="control-label col-xs-4">Empresa</label>
										<div class="col-xs-8">
											<input type="password" class="form-control" id="inputPassword" placeholder="Empresa">
										</div>
								</div>
								<div class="form-group">
										<label for="inputPassword" class="control-label col-xs-4">Ruc</label>
										<div class="col-xs-8">
											<input type="password" class="form-control" id="inputPassword" placeholder="RUC">
										</div>
								</div>							
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<div class="col-xs-12">
									  <textarea class="form-control" rows="3" id="comment" placeholder="Escribe un mensaje"></textarea>													
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-offset-2 col-xs-10">
										<button type="submit" class="btn btn-primary boton-ver">Enviar » <span class="glyphicon glyphicon-share"></span></button>
									</div>
								</div>	
							<div class="row">
								<div class="col-sm-12"> 
									<label class="boton-ver"><a href="#">Enviar »<span class="glyphicon glyphicon-share"></span> </a></label>
								</div>
							</div>								
							</div>							
						</div>									

						</form>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
<!-- fin busqueda-->

<div class="container-page">
<!-- categorias-->
	<div class="container">
		<div class="row">
	      	<div class="col-md-12 content_left">
				<ul class="back-links">
						<li><a href="<?php echo base_url(); ?>">Inicio</a> /</li>
						<li><a href="#">Categoria</a> /</li>
						<li>Subcaregoria</li>
						<div class="clear"> </div>
				</ul>
	   	 	</div>
		</div>

		<div class="row">
		<div class="col-sm-4">
			<div class="panel-group">
				<div class="panel panel-primary">
				    <div class="panel-heading heading-text" >Todas las Categorias</div><p class="panel-heading-1" >&nbsp;</p>
					<div class="panel-body">
				    	<div class="content-bottom-left">
				    	<!--
		    	    		<div class="categories">
								   <ul>									
									      <li><a href="#">Tecles y Polipastos Electricos</a></li>
									      <li><a href="#">Winches Electricos de Izaje y Arrastre</a></li>
									      <li><a href="#">Tecles y Winches Manuales,Teche Rachet, Trolley, Tirfor</a></li>
									      <li><a href="#">Poleas, Mordazas p/planchas, Tortugas, Gata Mecanica, Magneto, Dinamometro</a></li>
									      <li><a href="#">Accesosrios G80, Cables Acero, Cadenas</a></li>
									      <li><a href="#">Grillete, Grapa, Guardacable, Ocho Giratorio, Templadores, Accesorios G80</a></li>
									      <li><a href="#">Equipos y Herrameintas para tendido de redes elecrticas</a></li>
									      <li><a href="#">Escaleras de Aluminio y Fibra de Vidrio</a></li>
									      <li><a href="#">Arn&eacute;s y lineas de vida, Lineas Rectail, Frenos para soga y cable acero, Ganchos y Mosquetones</a></li>
								  	</ul>
							</div>
							-->

							<div id='flyout_menu'>
							 <ul>									
									      <li><a href="#">Tecles y Polipastos Electricos</a>
									      	<ul>
										        <li><a href='<?php echo base_url('/') ?>productos'><span>Tecles Electricos de cadena con gancho, con trolley electrico, trolley manual</span></a></li>
										        <li><a href='<?php echo base_url('/') ?>productos'><span>Testeros electricos, Trolley electrico</span></a></li>
										         <li><a href='<?php echo base_url('/') ?>productos'><span>Polipasto cable dee acero</span></a></li>
										          <li><a href='<?php echo base_url('/') ?>productos'><span>Tecle con gancho y trolley</span></a></li>
										    </ul>
									      </li>
									      <li><a href="#">Winches Electricos de Izaje y Arrastre</a></li>
									      <li><a href="#">Tecles y Winches Manuales,Teche Rachet, Trolley, Tirfor</a></li>
									      <li><a href="#">Poleas, Mordazas p/planchas, Tortugas, Gata Mecanica, Magneto, Dinamometro</a></li>
									      <li><a href="#">Accesosrios G80, Cables Acero, Cadenas</a></li>
									      <li><a href="#">Grillete, Grapa, Guardacable, Ocho Giratorio, Templadores, Accesorios G80</a></li>
									      <li><a href="#">Equipos y Herrameintas para tendido de redes elecrticas</a></li>
									      <li><a href="#">Escaleras de Aluminio y Fibra de Vidrio</a></li>
									      <li><a href="#">Arn&eacute;s y lineas de vida, Lineas Rectail, Frenos para soga y cable acero, Ganchos y Mosquetones</a></li>
								  	</ul>
								 <!--
								<ul>
								   <li><a href='#'><span>Link 1</span></a></li>
								   <li><a href='#'><span>Link 2</span></a>
								      <ul>
								         <li><a href='#'><span>Product 1</span></a>
								    
								            <ul>
								               <li><a href='#'><span>Sub Product</span></a></li>
								               <li><a href='#'><span>Sub Product</span></a></li>
								            </ul>
								         </li>
								         <li><a href='#'><span>Product 2</span></a>
								            
								            <ul>
								               <li><a href='#'><span>Sub Product</span></a></li>
								               <li><a href='#'><span>Sub Product</span></a></li>
								            </ul>
								           
								         </li>
								      </ul>
								   </li>
								   <li><a href='#'><span>Link 3</span></a></li>
								   <li><a href='#'><span>Link 4</span></a></li>
								</ul>
								-->
							</div>									
		    	    	</div>					  
					</div>
				</div>
			</div>

			<div class="panel-group">
				<div class="panel panel-primary">
				    <div class="panel-heading heading-text" >Marcas</div>
				    <!--<p class="panel-heading-1" >&nbsp;</p>-->
					<div class="panel-body">
						    	<div class="content-bottom-left">				  	
								
									<div class="categories">
								   		<ul>									
									      <li><a href="#">Haru(2)</a></li>
									      <li><a href="#">TXK(3)</a></li>
									      <li><a href="#">Vital(45)</a></li>
									      <li><a href="#">Escalumex(2)</a></li>
									      <li><a href="#">American Bull(12)</a></li>
									      <li><a href="#">Yale(20)</a></li>
									      <li><a href="#">Apparel(17)</a></li>
									      <li><a href="#">Toys & Games(25)</a></li>
									      <li><a href="#">Automotive(4)</a></li>
								  		</ul>
									</div>				
				    	    	</div>					  
					</div>
				</div>
			</div>

		</div>

		<div class="col-sm-8">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading heading-text">Categorias</div><p class="panel-heading-2" >&nbsp;</p>
					<div class="panel-body"> 
		

			    <div class="content-bottom-right">    	    
	            <div class="section group">
				  <div class="grid_1_of_4 images_1_of_4">
					 <h4><a href="preview.html">Whirlpool LTE5243D 3.4 CuFt.... </a></h4>
					  <a href="preview.html"><img src="<?php echo base_url('assets/images/p1d.png') ?>" alt="" /></a>
					  <div class="price-details">
				       <div class="price-number">
							<p><span class="rupees">$839.93 </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="<?php echo base_url('/') ?>productos/preview">More Info</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>					 
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<h4><a href="preview.html">Whirlpool LTE5243D 3.4 CuFt.... </a></h4>
					 <a href="preview.html"><img src="<?php echo base_url('assets/images/p2d.png') ?>" alt="" /></a>
					<div class="price-details">
				       <div class="price-number">
							<p><span class="rupees">$839.93 </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="preview.html">More Info</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
					 
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<h4><a href="preview.html">Whirlpool LTE5243D 3.4 CuFt.... </a></h4>
					<a href="preview.html"><img src="<?php echo base_url('assets/images/p3d.png') ?>" alt="" /></a>
					<div class="price-details">
				       <div class="price-number">
							<p><span class="rupees">$839.93 </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="preview.html">More Info</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				    
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<h4><a href="preview.html">Whirlpool LTE5243D 3.4 CuFt.... </a></h4>
					<a href="preview.html"><img src="<?php echo base_url('assets/images/p4d.png') ?>" alt="" /></a>
					 <div class="price-details">
				       <div class="price-number">
							<p><span class="rupees">$839.93 </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="preview.html">More Info</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				 </div>
			   </div>

			   <div class="section group">
				<div class="grid_1_of_4 images_1_of_4">
					 <h4><a href="preview.html">Whirlpool LTE5243D 3.4 CuFt.... </a></h4>
					  <a href="preview.html"><img src="<?php echo base_url('assets/images/p5d.png') ?>" alt="" /></a>
					  <div class="price-details">
				       <div class="price-number">
							<p><span class="rupees">$839.93 </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="preview.html">More Info</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>					 
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<h4><a href="preview.html">Whirlpool LTE5243D 3.4 CuFt.... </a></h4>
					 <a href="preview.html"><img src="<?php echo base_url('assets/images/p6d.png') ?>" alt="" /></a>
					<div class="price-details">
				       <div class="price-number">
							<p><span class="rupees">$839.93 </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="preview.html">More Info</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
					 
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<h4><a href="preview.html">Whirlpool LTE5243D 3.4 CuFt.... </a></h4>
					<a href="preview.html"><img src="<?php echo base_url('assets/images/p7d.png') ?>" alt="" /></a>
					<div class="price-details">
				       <div class="price-number">
							<p><span class="rupees">$839.93 </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="preview.html">More Info</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				    
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<h4><a href="preview.html">Whirlpool LTE5243D 3.4 CuFt.... </a></h4>
					<a href="preview.html"><img src="<?php echo base_url('assets/images/p8d.png') ?>" alt="" /></a>
					 <div class="price-details">
				       <div class="price-number">
							<p><span class="rupees">$839.93 </span></p>
					    </div>
					       		<div class="add-cart">								
									<h4><a href="preview.html">More Info</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				 </div>
			   </div>	

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading heading-text">Categor&iacute;as</div><p class="panel-heading-0" >&nbsp;</p>
					<div class="panel-body">
						<div class="container-fluid bg-3 text-center"> 
							<div class="row">
							<?php
							$i=1;
							while($i<2){
								foreach($categoriaslimit as $cat){								
								$id=$cat->id;
								$des=utf8_encode($cat->descripcion);
								$img=$cat->url_img;					
									if($img)
										$image='assets/images/'.$img;
									else
										$image='assets/images/text.png';
							?>								
								<div class="col-sm-3">    
								  <img src="<?php echo base_url($image) ?>" class="img-responsive" style="width:150px; height:128px" alt="Image">
									<p><?php echo $des; ?></p>
								</div>						
							<?php	
								}
							$i++;
							}
							?>	
							</div>		
						</div>	
						<div class="row">
								<div class="col-sm-12"> 
									<label class="boton-ver"><a href="#">Ver todas las categorias »<span class="glyphicon glyphicon-chevron-down"></span></a></label>
								</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
	<!--
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel-group">
					<div class="panel panel-primary">
						<div class="panel-heading heading-text">Productos Destacados</div><p class="panel-heading-2" >&nbsp;</p>
						<div class="panel-body">
							<div class="container-fluid bg-3 text-center"> 
								<div class="row">
									<div class="col-sm-3">									
										<img src="http://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
									  <p>Some text..</p>
									</div>
									<div class="col-sm-3"> 
									  <img src="http://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
									  <p>Some text..</p>
									</div>
									<div class="col-sm-3"> 
									  <img src="http://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
									  <p>Some text..</p>
									</div>
									<div class="col-sm-3">									
									  <img src="http://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
									  <p>Some text..</p>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12"> 
										<label class="boton-ver"><a href="#">Ver todas las productos destacadas »</a></label>
									</div>
								</div>
							</div>				  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	-->

</div>



	  
	




