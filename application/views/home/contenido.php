<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-page">
<div class="container container-fondo">
		<div class="row">
      		  	<div class="col-sm-12 sin-spacio">	
      		  		<div class="panel panel-primary">
						<div class="panel-heading heading-text"><?php echo $content->titulo; ?></div><p class="panel-heading-2" ></p>
						<div class="panel-body container-fondo sin-espacio">

						<div class="row">           

                 	<?php
                 	switch ($content->modulo) {
                 		case 'nosotros':
						
						    echo '<div class="col-sm-12 col-pane">
									<div class="row">
									<div class="col-sm-12">
				                     <p>'. $content->descripcion.'</p>  
									</div>
									</div>	
									<div class="row">
										<div class="col-sm-6">
										<img style="float: left;" src="'.base_url('assets/images/mision.jpg').'" class="img-responsive">
										<strong>NUESTRA MISION</strong>
										 <p style="text-align: justify;">Brindar garantía y soluciones de acuerdo a las necesidades de nuestros clientes ya sea para mover, levantar, posicionar y asegurar todo tipo de material de una manera fácil y eficiente.</p>  
										</div>
										<div class="col-sm-6">
										<img style="float: left;" src="'.base_url('assets/images/vision.jpg').'" class="img-responsive">
										<strong>NUESTRA VISION</strong>
										<p style="text-align: justify;">Ser una empresa altamente competitiva en el mercado nacional y en el sector industrial, que satisfaga de la mejor manera las expectativas de nuestros clientes, desarrollando día a día nuestras alternativas para un mejor servicio.</p>  
										</div>
									</div>									
									
		                	</div> ';
                 	 	/*echo '<div class="col-sm-4">                 
		                    	<img src="'.base_url('admin/'.$content->url_img).'" class="img-responsive">
		                	</div>';*/
		               /* echo '<div class="col-sm-12 col-pane">
		                        <div class="bs-example">
				                    <ul class="nav nav-tabs">
				                        <li class="active">
				                        <a href="#tab1" data-toggle="tab" class="a-tab" aria-expanded="true">Nuestra Empresa</a>
				                        </li>			                        
				                    </ul>
				                    <div class="tab-content">
				                        <div class="tab-pane active" id="tab1">
				                          <p>'. $content->descripcion.'</p>								
											<div class="about">
												 	<ul class="normal">
													<li><h3>Misión</h3>
													Brindar garantía y soluciones de acuerdo a las necesidades de nuestros clientesya sea para mover, levantar, posicionar y asegurar todo tipo de material de una manera fácil y eficiente.
													</li>
													<li><h3>Visión</h3>
													Ser una empresa altamente competitiva en el mercado nacional y en el sector industrial, que satisfaga de la mejor manera las expectativas de nuestros clientes, desarrollando día a día nuestras alternativas para un mejor servicio.
													</li>													
												</ul>
											</div>
				                        </div>
				                        <div class="tab-pane" id="tab2">                     
				                          	<div class="about">
					                          	<ul class="normal">
													<li><h3>Mision</h3>
														Contar con amplio stock de todos nuestros productos, tener disponibilidad de equipos manuales y eléctricos de altas capacidades, de hasta 50T, todo esto con el fin de satisfacer las necesidades de nuestros clientes, las cuales saltan en cualquier momento y a veces en grandes cantidades, cuando suceda, nosotros estaremos preparados; pero eso sí siempre con el respaldo de grandes marcas como TXK, HARU, YALE, YOKE, AMERICAN BULL, SLR.
													</li>
													<li><h3>Vision</h3>
													En el 2015-2016 consolidarnos como empresa líder en el mercado especializado de equipos de izaje y maniobras en general, ser la primera opción de todo pequeño, mediano y gran cliente. Mediante el trabajo eficiente de todo el equipo humano que conformamos, ofreciendo productos y servicios de alta calidad, precios competitivos, amplio stock e infraestructura adecuada; con el fin de alcanzar nuestros objetivos.
													</li>
												</ul>
											</div> 				
				                        </div>
				                        <div class="tab-pane" id="tab3">
				                          <p>At compuniagara.com the destiny of the company and its personnel are immersed in one another, resulting in sheer professionalism. Our talented team with leadership qualities, communication and management skills are competent enough to support clients with their fast pace business demands and solutions.<br><br>
				                          A fundamental axiom guides our company in all its technology-driven endeavors. <br>Which are the people who create and operate the technology to achieve the customers’ demands and to make progress happen.</p>
				                        </div>     
				                    </div>
		                		</div>
		                	</div> ';*/
                 	break;

                 	case 'dptotecnico':
                 	 	echo '<div class="col-sm-4">                 
		                    	<img src="'.base_url('admin/'.$content->url_img).'" class="img-responsive">
		                	</div>';
		                echo '<div class="col-sm-8 col-pane">
		                        <div class="bs-example">
				                    <ul class="nav nav-tabs">
				                        <li class="active">
				                        <a href="#tab1" data-toggle="tab" class="a-tab" aria-expanded="true">Mantenimiento Preventivo</a>
				                        </li>
				                        <li class="">
				                        <a href="#tab2" data-toggle="tab" class="a-tab" aria-expanded="false">Mantenimiento Correctivo</a></li>
				                        <li class="">
				                        <a href="#tab3" data-toggle="tab" class="a-tab" aria-expanded="false">Garantia de Productos</a>
				                        </li>             
				                    </ul>
				                    <div class="tab-content">
				                        <div class="tab-pane active" id="tab1">
				                          <p>'. $content->descripcion.'</p>								
											<div class="about">											
												<ul class="normal">
												<li>Mayor seguridad para el operario.</li>
												<li>Máxima disponibilidad en los productos.</li>
												<li>Mayor productividad.</li>
												<li>Menor costo en mantenimiento y en reparaciones.</li>
												<li>Mayor duración de los equipos.</li>												</ul>
											</div>	


				                        </div>
				                        <div class="tab-pane" id="tab2">                     
				                          	
				                          	Llevar a cabo <b>reparaciones de los productos</b> puede suponer una bajada de productividad importante según el tiempo que duren los arreglos. En ESCALERAS Y MANIOBRAS SAC sabemos que el mantenimiento preventivo evita estas situaciones no deseadas pero también que el correctivo es una realidad en algunas empresas.<br><br>
												<b>¿Qué es el mantenimiento correctivo?</b><br>
												Realizar reparaciones bajo la demanda del operario para corregir problemas que se hayan notado en el funcionamiento de los productos. Cuando algo falla de repente, es la única solución para volver a poner en marcha la maquinaria.
												El objetivo de este tipo de mantenimiento es reaccionar y solucionar rápidamente el problema para no retrasar la producción de la empresa.<br><br>
												<b>¿Qué tipos de avería puede sufrir la maquinaria?</b><br>
												En ESCALERAS Y MANIOBRAS SAC damos solución a cualquier problema que tenga una máquina:									
														
												<div class="about">
					                          		<ul class="normal">										
														<li>Reparación de todo tipo de motores y marcas.</li>
														<li>Reparación de equipos manuales.</li>
														<li>Detección y reparación de averías eléctricas.</li>
										
													</ul>
												</div>
													Nuestro equipo especializado en montaje y reparación de equipos se encarga de arreglar los productos para volver a poner en marcha la producción.

				                        </div>
				                        <div class="tab-pane" id="tab3">
				                        				                          <p>
									
¡Felicitaciones por adquirir un producto de ESCALERAS Y MANIOBRAS! Todos nuestros productos cuentan con una garantía por defecto de fabricación, contados a partir de la fecha de compra del producto. <br>
La garantía no aplica si: <br>
	<div class="about">
		<ul class="normal">										
			<li>El período de garantía ha expirado.</li>
			<li>El producto lo ha modificado o reparado un agente no autorizado.</li>
			<li>El defecto ha sido sujeto a abuso, uso inapropiado que no cumple con las instrucciones del manual del producto o las condiciones del medio ambiente no son las indicadas.</li>
			<li>El defecto está sujeto a fuerza mayor, tales como actos de inundaciones, relámpagos, terremotos, robo, etc.</li>
			<li>Si el producto del cliente no tiene garantía, ESCALERAS Y MANIOBRAS puede ofrecer servicios de reparación con costos para el cliente.</li>
		</ul>
	</div>
 <br>
Los servicios con garantía o sin ella se pueden obtener al ponerse en contacto con el vendedor de dicho producto o llamando al teléfono (01) 424-4631. Al solicitar un servicio, se deben presentar la prueba de compra del producto. La devolución de productos defectuosos debe hacerse solamente a donde se compró y el cliente debe empacar bien el producto para evitar que sufra daños durante el transporte.
 <br>Adentro, no hay partes que el usuario pueda reparar. No permita que personas o agentes no autorizados, reparen o modifiquen el producto.

 </p>
				                        </div>     
				                    </div>
		                		</div>
		                	</div> ';
                 	break;
                 	case 'alquiler-de-equipos':
                 	 	echo '<div class="col-sm-4">                 
		                    	<img src="'.base_url('admin/'.$content->url_img).'" class="img-responsive">
		                	</div>';
		                echo '<div class="col-sm-8 col-pane">
		                        <div class="bs-example">
				                    <ul class="nav nav-tabs">
				                        <li class="active">
				                        <a href="#tab1" data-toggle="tab" class="a-tab" aria-expanded="true"> Alquiler de Equipos de Izaje</a>
				                        </li>
				                        <!--<li class="">
				                        <a href="#tab2" data-toggle="tab" class="a-tab" aria-expanded="false">Mantenimiento Correctivo</a></li>
				                        <li class="">
				                        <a href="#tab3" data-toggle="tab" class="a-tab" aria-expanded="false"><span class="fa fa-group"></span>Garantia de Equipos</a>
				                        </li>  -->           
				                    </ul>
				                    <div class="tab-content">
				                        <div class="tab-pane active" id="tab1">				
											<div class="about">											
												<ul class="normal">
												<li>Tecles o Polipastos Electricos.</li>
												<li>Winches Electricos.</li>
												<li>Tecle manual y tipo Rachet.</li>
												<li>Tirfor y Poleas.</li>
												<li>... y mas.</li>						

												</ul>
											</div>
											   <p>'. $content->descripcion.'</p>	


				                        </div>
				                        <div class="tab-pane" id="tab2">                     
				                          	<div class="about">
					                          	<ul class="normal">
													<li><h3>Mision</h3>
														Contar con amplio stock de todos nuestros productos, tener disponibilidad de equipos manuales y eléctricos de altas capacidades, de hasta 50T, todo esto con el fin de satisfacer las necesidades de nuestros clientes, las cuales saltan en cualquier momento y a veces en grandes cantidades, cuando suceda, nosotros estaremos preparados; pero eso sí siempre con el respaldo de grandes marcas como TXK, HARU, YALE, YOKE, BULL SLING.
													</li>
													<li><h3>Vision</h3>
													En el 2015-2016 consolidarnos como empresa líder en el mercado especializado de equipos de izaje y maniobras en general, ser la primera opción de todo pequeño, mediano y gran cliente. Mediante el trabajo eficiente de todo el equipo humano que conformamos, ofreciendo productos y servicios de alta calidad, precios competitivos, amplio stock e infraestructura adecuada; con el fin de alcanzar nuestros objetivos.
													</li>
												</ul>
											</div> 				
				                        </div>
				                        <div class="tab-pane" id="tab3">
				                          <p>
										  Garantía de Productos
¡Felicitaciones por adquirir un producto de ESCALERAS Y MANIOBRAS! Todos nuestros productos cuentan con una garantía por defecto de fabricación, contados a partir de la fecha de compra del producto.
La garantía no aplica si: <br>
-	El período de garantía ha expirado,
-	El producto lo ha modificado o reparado un agente no autorizado,
-	El defecto ha sido sujeto a abuso, uso inapropiado que no cumple con las instrucciones del manual del producto o las condiciones del medio ambiente no son las indicadas.
-	El defecto está sujeto a fuerza mayor, tales como actos de inundaciones, relámpagos, terremotos, robo, etc.
-	Si el producto del cliente no tiene garantía, ESCALERAS Y MANIOBRAS puede ofrecer servicios de reparación con costos para el cliente.
 <br>
Los servicios con garantía o sin ella se pueden obtener al ponerse en contacto con el vendedor de dicho producto o llamando al teléfono (01) 424-4631. Al solicitar un servicio, se deben presentar la prueba de compra del producto. La devolución de productos defectuosos debe hacerse solamente a donde se compró y el cliente debe empacar bien el producto para evitar que sufra daños durante el transporte.
Adentro, no hay partes que el usuario pueda reparar. No permita que personas o agentes no autorizados, reparen o modifiquen el producto.

 </p>
 				                        </div>     
				                    </div>
		                		</div>
		                	</div> ';
                 	break;
                 	 	
                 	 	default:
                 	 		# code...
                 	 		break;
                 	 } 
                
                 	?>
           
 

                
                </div>
                        
            
					  </div>
					</div>
				</div>
			</div>     


    </div> 
</div>