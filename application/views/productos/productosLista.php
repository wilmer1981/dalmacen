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
			
	<div class="col-sm-3 sin-spacio category-sec">
				<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading heading-text" >
					    <!--
							<i class="glyphicon glyphicon-list color-icon"></i>
						-->
					    Productos</div><p class="panel-heading-1" >&nbsp;</p>
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
							                echo '<li><a href="'.base_url().'Catalogo/paginas/'.$url1.'">'.$des.'</a>';
							                if($sub==1){						          
								                echo '<ul>';
								             	 	foreach($subcategorias as $sub){
								             	 		$subid  = $sub->id; 
								             	 	    $catid  = $sub->categoria_id; 
								             	 	    $subdes = $sub->descripcion;
								             	 	    $link   = $subid."-".$subdes;
								             	 	    $url    = urls_amigables($link);
								             	 	    if($id==$catid){						             	 	 
								             	 	    	echo '<li><a href="'.base_url().'Catalogo/productos/'.$url.'">'.$subdes.'</a></li>';						             	 	
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
		</div>

		<div class="col-sm-9 sin-espacio-der">
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
							
					 	<div class="row">
					 	<br>		

						<div class="product-details">
							<div class="col-lg-3 col-sm-3">
							 	<div class="grid foto">
							 		<img class="etalage_image" src="<?php echo base_url($image); ?>" />
								</div>					
							</div>
							<div class="col-lg-9 col-sm-9">
								<div class="desc span_31_of_2">
									<h2>
									<?php 

										if($mar=="STANDARD") {
											echo $titulo;
										}else if($mar!="STANDARD" && $mod!="STANDARD"){ //
											echo $titulo." Modelo ".$mod." ".$mar;
										}else{ //
											echo $titulo." ".$mar;
										}
									 ?>													
									</h2>
									<p><?php echo $descri; ?></p>
									<div class="row">
										<div class="col-lg-6 sin-spacio">												
											<div class="table-responsive">
											<?php
											  //	if($catid!=12){ //si no es ecalera
											  		switch ($idprod) {
											  			case '41':
											  			case '125':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Capacidad</th>
											  				<th>Apertura</th>
											  				</thead>
											  				<tbody>									
																<tr><td>1t</td><td>0-22mm</td></tr>
																<tr><td>2t</td><td>0-32mm</td></tr>
																<tr><td>3t</td><td>0-36mm</td></tr>
																<tr><td>5t</td><td>0-50mm</td></tr>
															</tbody>
															</table>';
											  				break;
											  			case '2':
											  			case '126':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Capacidad</th>
											  				<th>Apertura</th>
											  				</thead>
											  				<tbody>									
																<tr><td>1t</td><td>0-20mm</td></tr>
																<tr><td>2t</td><td>0-25mm</td></tr>
																<tr><td>3t</td><td>0-30mm</td></tr>
																<tr><td>5t</td><td>0-52mm</td></tr>
																<tr><td>8t</td><td>40-80mm</td></tr>
															</tbody>
															</table>';
											  				break;
											  				case '3':
											  				case '127':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Capacidad</th>
											  				<th>Apertura</th>
											  				</thead>
											  				<tbody>									
																<tr><td>1t</td><td>1-13mm</td></tr>
																<tr><td>2t</td><td>3-22mm</td></tr>
																<tr><td>3t</td><td>12-35mm</td></tr>					
															</tbody>
															</table>';
											  				break;
											  				case '5':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Capacidad</th>
											  				<th>Regulable</th>
											  				</thead>
											  				<tbody>									
																<tr><td>1t</td><td>75-230mm</td></tr>
																<tr><td>2t</td><td>75-230mm</td></tr>
																<tr><td>3t</td><td>80-320mm</td></tr>
																<tr><td>5t</td><td>80-320mm</td></tr>
																<tr><td>10t</td><td>90-320mm</td></tr>					
															</tbody>
															</table>';
											  				break;

											  				case '110':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Capacidad</th>
											  				<th>Regulable</th>
											  				</thead>
											  				<tbody>
											  					<tr><td>0.5t</td><td>50-152mm</td></tr>					
																<tr><td>1t</td><td>64-203mm</td></tr>
																<tr><td>2t</td><td>88-203mm</td></tr>
																<tr><td>3t</td><td>100-203mm</td></tr>
																<tr><td>5t</td><td>114-203mm</td></tr>
																<tr><td>10t</td><td>125-210mm</td></tr>					
															</tbody>
															</table>';
											  				break;
											  				case '111':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Capacidad</th>
											  				<th>Regulable</th>
											  				</thead>
											  				<tbody>									  								
																<tr><td>1t</td><td>64-203mm</td></tr>
																<tr><td>2t</td><td>88-203mm</td></tr>
																<tr><td>3t</td><td>100-203mm</td></tr>
																<tr><td>5t</td><td>114-203mm</td></tr>
																<tr><td>10t</td><td>125-210mm</td></tr>	
																<tr><td>20t</td><td>125-210mm</td></tr>					
															</tbody>
															</table>';
											  				break;
											  				case '112':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Capacidad</th>
											  				<th>Regulable</th>
											  				</thead>
											  				<tbody>									  						
											  				   <tr><td>0.5t</td><td>75-130mm</td></tr>			
																<tr><td>1t</td><td>75-130mm</td></tr>
																<tr><td>2t</td><td>75-200mm</td></tr>
																<tr><td>3t</td><td>75-200mm</td></tr>
																<tr><td>5t</td><td>100-300mm</td></tr>			
																		
															</tbody>
															</table>';
											  				break;

											  				case '113':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Capacidad</th>
											  				<th>Regulable</th>
											  				</thead>
											  				<tbody>									  						
											  				   <tr><td>1t</td><td>75-220mm</td></tr>			
																<tr><td>2t</td><td>75-220mm</td></tr>
																<tr><td>3t</td><td>80-320mm</td></tr>
																<tr><td>5t</td><td>80-320mm</td></tr>
																<tr><td>10t</td><td>80-350mm</td></tr>			
																		
															</tbody>
															</table>';
											  				break;

											  				case '120':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Arrastre</th>
											  				<th>Izaje</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>BHW-800</td><td>360kg</td><td>180kg</td></tr>		
																<tr><td>BHW-1200</td><td>540kg</td><td>270kg</td></tr>
																<tr><td>BHW-1800</td><td>820kg</td><td>410kg</td></tr>
																<tr><td>BHW-2600</td><td>1200kg</td><td>600kg</td></tr>			
															</tbody>
															</table>';
											  				break;
											  				case '121':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Arrastre</th>
											  				<th>Izaje</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>PNW-1000</td><td>1t</td><td>0.5t</td></tr>		
																<tr><td>PNW-2000</td><td>2t</td><td>1t</td></tr>
																<tr><td>PNW-3000</td><td>3t</td><td>1.5t</td></tr>			
															</tbody>
															</table>';
											  				break;
											  					//escaleras

											  				case '206':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>FTS113-5I</td><td>5</td><td>6.90</td><td>1.52</td></tr>		
																<tr><td>FTS113-6I</td><td>6</td><td>7.90</td><td>1.83</td></tr>
																<tr><td>FTS113-7I</td><td>7</td><td>9.55</td><td>2.13</td></tr>
																<tr><td>FTS113-8I</td><td>8</td><td>10.85</td><td>2.44</td></tr>	
															
															</tbody>
															</table>';
											  				break;											  	

															case '207':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>FTD150-5IA</td><td>5</td><td>9.50</td><td>1.52</td></tr>		
																<tr><td>FTD150-6IA</td><td>6</td><td>10.90</td><td>1.83</td></tr>
																<tr><td>FTD150-7IA</td><td>7</td><td>12.80</td><td>2.13</td></tr>
																<tr><td>FTD150-8IA</td><td>8</td><td>14.40</td><td>2.44</td></tr>
																<tr><td>FTD150-10IA</td><td>10</td><td>18.85</td><td>3.05</td></tr>		
																<tr><td>FTD150-12IA</td><td>12</td><td>24.50</td><td>3.66</td></tr>
																<tr><td>FTD150-14IA</td><td>14</td><td>31.60</td><td>4.27</td></tr>
																<tr><td>FTD150-16IA</td><td>16</td><td>35.90</td><td>4.88</td></tr>	
															
															</tbody>
															</table>';
											  				break;											  		
															case '208':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>FA150-8IA</td><td>8</td><td>5.80</td><td>2.44</td></tr>		
																<tr><td>FA150-10IA</td><td>10</td><td>7.10</td><td>3.05</td></tr>
																<tr><td>FA150-12IA</td><td>12</td><td>8.40</td><td>3.66</td></tr>
																<tr><td>FA150-14IA</td><td>14</td><td>9.60</td><td>4.27</td></tr>	
															
															</tbody>
															</table>';
											  				break;	
											  	
															case '209':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>FTT102-16II</td><td>16</td><td>12.50</td><td>4.11</td></tr>		
																<tr><td>FTT102-20II</td><td>20</td><td>15.70</td><td>5.33</td></tr>
																<tr><td>FTT102-24II</td><td>24</td><td>19.20</td><td>6.55</td></tr>
																<tr><td>FTT102-28II</td><td>28</td><td>22.80</td><td>7.77</td></tr>
																<tr><td>FTT113-32I</td><td>32</td><td>24.70</td><td>8.99</td></tr>		
																<tr><td>FTT136-36IA</td><td>36</td><td>38.10</td><td>10.21</td></tr>
																<tr><td>FTT136-40IA</td><td>40</td><td>42.30</td><td>11.43</td></tr>		
															
															</tbody>
															</table>';
											  				break;	
											 
											  				case '210':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>FTT150-16IA</td><td>16</td><td>15.60</td><td>4.11</td></tr>		
																<tr><td>FTT150-20IA</td><td>20</td><td>18.75</td><td>5.33</td></tr>
																<tr><td>FTT150-24IA</td><td>24</td><td>21.85</td><td>6.55</td></tr>
																<tr><td>FTT150-28IA</td><td>28</td><td>24.95</td><td>7.77</td></tr>			
															
															</tbody>
															</table>';
											  				break;	
											  			
															case '218':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				<th>Altura Tipo<br>Arrimo(m)</th>
											  				<th>Altura Tipo<br>Tijera(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>FM150-12IA+P</td><td>12</td><td>19.50</td><td>0.95</td><td>3.55</td><td>1.74</td></tr>										
															
															</tbody>
															</table>';
											  				break;	
					





											  				case '230':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>ATS90-3III</td><td>3</td><td>3.60</td><td>0.88</td></tr>		
																<tr><td>ATS90-4III</td><td>4</td><td>4.20</td><td>1.22</td></tr>
																<tr><td>ATS90-5III</td><td>5</td><td>5.15</td><td>1.53</td></tr>
																<tr><td>ATS90-6III</td><td>6</td><td>5.85</td><td>1.83</td></tr>		
															</tbody>
															</table>';
											  				break;
											  				case '231':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>ATS113-3I</td><td>3</td><td>4.05</td><td>0.88</td></tr>		
																<tr><td>ATS113-4I</td><td>4</td><td>4.77</td><td>1.22</td></tr>
																<tr><td>ATS113-5I</td><td>5</td><td>5.86</td><td>1.52</td></tr>
																<tr><td>ATS113-6I</td><td>6</td><td>6.82</td><td>1.83</td></tr>	
																<tr><td>ATS113-7I</td><td>7</td><td>8.05</td><td>2.13</td></tr>	
																<tr><td>ATS113-8I</td><td>8</td><td>8.90</td><td>2.44</td></tr>
																<tr><td>ATS113-10I</td><td>10</td><td>14.40</td><td>3.05</td></tr>		
															</tbody>
															</table>';
											  				break;
											  				case '232':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>ATD150-4IA</td><td>4</td><td>7.15</td><td>1.22</td></tr>		
																<tr><td>ATD150-5IA</td><td>5</td><td>8.60</td><td>1.52</td></tr>
																<tr><td>ATD150-6IA</td><td>6</td><td>11.30</td><td>1.83</td></tr>
																<tr><td>ATD150-7IA</td><td>7</td><td>13.10</td><td>2.13</td></tr>	
																<tr><td>ATD150-8IA</td><td>8</td><td>14.85</td><td>2.44</td></tr>	
																<tr><td>ATD150-10IA</td><td>10</td><td>19.50</td><td>3.05</td></tr>
																<tr><td>ATD150-12IA</td><td>12</td><td>23.55</td><td>3.66</td></tr>		
															</tbody>
															</table>';
											  				break;
											  				case '233':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>AA150-8IA</td><td>8</td><td>3.80</td><td>2.44</td></tr>		
																<tr><td>AA150-10IA</td><td>10</td><td>4.80</td><td>3.05</td></tr>
																<tr><td>AA150-12IA</td><td>12</td><td>5.80</td><td>3.66</td></tr>
																<tr><td>AA150-14IA</td><td>14</td><td>6.77</td><td>4.27</td></tr>		
															</tbody>
															</table>';
											  				break;
											  				case '234':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>ATT102-16II</td><td>16</td><td>12.30</td><td>4.05</td></tr>		
																<tr><td>ATT102-20II</td><td>20</td><td>14.85</td><td>5.27</td></tr>
																<tr><td>ATT102-24II</td><td>24</td><td>16.40</td><td>6.49</td></tr>
																<tr><td>ATT102-28II</td><td>28</td><td>22.70</td><td>7.71</td></tr>	
																<tr><td>ATT102-32II</td><td>32</td><td>26.50</td><td>8.93</td></tr>	
																<tr><td>ATT102-36II</td><td>36</td><td>30.90</td><td>9.75</td></tr>
																<tr><td>ATT102-40II</td><td>40</td><td>34.45</td><td>10.97</td></tr>		
															</tbody>
															</table>';
											  				break;
											  				case '235':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				<th>Altura Tipo <br>Arrimo(m)</th>
											  				<th>Altura Tipo <br>Tijera(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>AM150-12IA+P</td><td>12</td><td>17</td><td>0.98</td><td>3.55</td><td>1.74</td></tr>	
											  				      <tr><td>AM150-16IA</td><td>16</td><td>15.5</td><td>1.26</td><td>4.67</td><td>2.30</td></tr>										
															</tbody>
															</table>';
											  				break;
											  				case '236':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>AB150-2IA</td><td>2</td><td>2.70</td><td>0.40</td></tr>		
																<tr><td>AB150-3IA</td><td>3</td><td>3.20</td><td>0.62</td></tr>
																<tr><td>AB150-4IA</td><td>4</td><td>3.85</td><td>0.84</td></tr>
																<tr><td>AB150-5IA</td><td>5</td><td>4.55</td><td>1.06</td></tr>	
																<tr><td>AB150-6IA</td><td>6</td><td>5.90</td><td>1.28</td></tr>	
																<tr><td>AB150-7IA</td><td>7</td><td>7.10</td><td>1.50</td></tr>
																<tr><td>AB150-8IA</td><td>8</td><td>8.15</td><td>1.72</td></tr>		
															</tbody>
															</table>';
											  				break;
											  				case '237':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Cerrado(m)</th>
											  				<th>Altura Maxima<br>Extensible(m)</th>							  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>AAA150-10IA</td><td>12</td><td>11.20</td><td>0.78</td><td>3.20</td></tr>	
											  											
															</tbody>
															</table>';
											  				break;

											  				case '212':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura hasta<br>Plataforma (m)</th>							  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>AB150-2IA</td><td>2</td><td>2.70</td><td>0.40</td></tr>	
											  										
															</tbody>
															</table>';
											  				break;

											  				case '214':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura (m)</th>							  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>BASE</td><td>8</td><td>12.50</td><td>2.44</td></tr>	
											  					<tr><td>EXTENSIBLE</td><td>8</td><td>12.50</td><td>2.44</td></tr>							
															</tbody>
															</table>';
											  				break;
											  				case '215':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura (m)</th>							  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>EFVE-BASE</td><td>8</td><td>9.78</td><td>2.44</td></tr>	
											  					<tr><td>EFVE-EXTENSIBLE</td><td>8</td><td>10.04</td><td>2.44</td></tr>							
															</tbody>
															</table>';
											  				break;

											  				case '379':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Extendido (m)</th>							  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>FTT102-16II</td><td>16</td><td>12.50</td><td>4.11</td></tr>	
											  				    <tr><td>FTT102-20II</td><td>20</td><td>15.70</td><td>5.33</td></tr>	
											  				    <tr><td>FTT102-24II</td><td>24</td><td>19.20</td><td>6.55</td></tr>	
											  				    <tr><td>FTT102-28II</td><td>28</td><td>22.80</td><td>7.77</td></tr>
											  				    <tr><td>FTT102-32II</td><td>32</td><td>24.70</td><td>8.99</td></tr>
											  				    <tr><td>FTT102-36II</td><td>36</td><td>38.10</td><td>10.21</td></tr>	
											  				    <tr><td>FTT102-40II</td><td>40</td><td>42.30</td><td>11.43</td></tr>			
											  										
															</tbody>
															</table>';
											  				break;

											  				case '381':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura <br>Extendido (m)</th>							  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>FTT150-16IA</td><td>16</td><td>15.60</td><td>4.11</td></tr>	
											  				    <tr><td>FTT150-20IA</td><td>20</td><td>18.75</td><td>5.33</td></tr>	
											  				    <tr><td>FTT150-24IA</td><td>24</td><td>21.85</td><td>6.55</td></tr>	
											  				    <tr><td>FTT150-28IA</td><td>28</td><td>24.95</td><td>7.77</td></tr>						 			
											  										
															</tbody>
															</table>';
											  				break;

											  				case '382':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura (m)</th>							  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>BASE</td><td>8</td><td>12.50</td><td>2.44</td></tr>	
											  				    <tr><td>EXTENSIBLE</td><td>8</td><td>12.50</td><td>2.44</td></tr>							  						 			
											  										
															</tbody>
															</table>';
											  				break;


											  				case '384':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Pasos</th>
											  				<th>Peso(kg)</th>
											  				<th>Altura (m)</th>							  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>EFVE-BASE</td><td>8</td><td>9.78</td><td>2.44</td></tr>	
											  				    <tr><td>EFVE-CUERPO</td><td>8</td><td>10.04</td><td>2.44</td></tr>							  						 			
											  										
															</tbody>
															</table>';
											  				break;

											  				case '359':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Arrastre</th>
											  				<th>Izaje</th>			  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>BHW-800</td><td>360kg</td><td>180kg</td></tr>	
											  				    <tr><td>BHW-1200</td><td>540kg</td><td>270kg</td></tr>	
											  				    <tr><td>BHW-1800</td><td>820kg</td><td>410kg</td></tr>	
											  				    <tr><td>BHW-2600</td><td>1200kg</td><td>600kg</td></tr>	
											  										  						 			
											  										
															</tbody>
															</table>';
											  				break;
											  				case '360':
											  				# code...
											  				echo '<table class="table">
											  				<thead>
											  				<th>Modelo</th>
											  				<th>Arrastre</th>
											  				<th>Izaje</th>			  										  		
											  				</thead>
											  				<tbody>									  						
											  				    <tr><td>PNW-1000</td><td>1t</td><td>0.5t</td></tr>	
											  				    <tr><td>PNW-2000</td><td>2t</td><td>1.t</td></tr>	
											  				    <tr><td>PNW-3000</td><td>3t</td><td>1.5t</td></tr>	
											  											  										  						 			
											  										
															</tbody>
															</table>';
											  				break;

											  			
											  			default:
											  				# code...
											  		echo '<table class="table">	';
											  		if(!empty($cap)){
											  			echo '<tr class><td><span>Capacidad: </span></td><td>'.$cap.'</td></tr>';
											  		}
											  		if(!empty($pot)){
											  		echo '<tr class><td><span>Potencia: </span></td><td>'.$pot.'</td></tr>';
											  		}
											  		if(!empty($vel)){
													echo '<tr class><td><span>Velocidad: </span></td><td>'.$vel.'</td></tr>';
													}
													if(!empty($iza)){
													echo '<tr class><td><span>Izaje: </span></td><td>'.$iza.'</td></tr>';
													}
													if(!empty($med)){
													echo '<tr class><td><span>Medidas: </span></td><td>'.$med.'</td></tr>';
													}
														if(!empty($pes)){
													echo '<tr class><td><span>Peso: </span></td><td>'.$pes.'</td></tr>';
													}
														if(!empty($lon)){
													echo '<tr class><td><span>Longitud Cable: </span></td><td>'.$lon.'</td></tr>';
													}
														if(!empty($cer)){
													echo '<tr class><td><span>Certificaciones: </span></td><td>'.$cer.'</td></tr>';
													}
														if(!empty($cru)){
													echo '<tr class><td><span>Cap.Ruptura: </span></td><td>'.$cru.'</td></tr>';
													}
														if(!empty($ome)){
													echo '<tr class><td><span>Otras Medidas: </span></td><td>'.$ome.'</td></tr>';
													}
												echo '</table>';
											  				break;
											  		}
											?>	
											
											<?php
											  	//}else{ // si es escalera
								     		?>
								     		<!--
								     			<table class="table table-bordered">
								     			<thead>
											        <tr>
											            <th>Modelo</th>
											            <th>Pasos</th>
											            <th>Peso (Kg)</th>
											            <th>Altura Cerrado (m)</th>
											        </tr>
											    </thead>
											    <tbody>
										        <tr>
										            <td>FTD150-5IA</td>
										            <td>5</td>
										            <td>9.50</td>
										            <td>1.52</td>
										        </tr>
										            <tr>
										            <td>FTD150-6IA</td>
										            <td>5</td>
										            <td>9.50</td>
										            <td>1.52</td>
										        </tr>
										            <tr>
										            <td>FTD150-7IA</td>
										            <td>5</td>
										            <td>9.50</td>
										            <td>1.52</td>
										        </tr>
										            <tr>
										            <td>FTD150-8IA</td>
										            <td>5</td>
										            <td>9.50</td>
										            <td>1.52</td>
										        </tr>
										            <tr>
										            <td>FTD150-10IA</td>
										            <td>5</td>
										            <td>9.50</td>
										            <td>1.52</td>
										        </tr>
										            <tr>
										            <td>FTD150-12IA</td>
										            <td>5</td>
										            <td>9.50</td>
										            <td>1.52</td>
										        </tr>
										            <tr>
										            <td>FTD150-14IA</td>
										            <td>5</td>
										            <td>9.50</td>
										            <td>1.52</td>
										        </tr>
										            <tr>
										            <td>FTD150-16IA</td>
										            <td>5</td>
										            <td>9.50</td>
										            <td>1.52</td>
										        </tr>
										        </tbody>
												</table>
												-->

								     		<?php
											  	//}
								     		?>

											</div>
										</div>
										<div class="col-lg-6 sin-spacio-right">
											<div class="wish-list">
											 	<ul>
											 		<li class="wish">
											 		  <?php

												 		if($archivo!=''){ // si archivo no es null
												 			echo '<a href="'. base_url($archivo).'" class="btn btn-primary btn-lg" target="_blank"><span class="glyphicon glyphicon-download"></span> Ficha Tecnica</a>';
																				
														}else{
															echo '';
														}		

												 		?>

											 		</li>

											 	    <li class="compare">									 	         
									                <?php
												 		echo '<a href="#txtbox'.$idprod.'" class="btn btn-success btn-lg btn-mostrar" data-id="'.$idprod.'"><span class="glyphicon glyphicon-ok-sign"></span> Agregar a solictud</a>';
												 		//echo "id producto:".$idprod;
												 	?>  		 	    
													</li>	
													<li class="txtbox" id="txtbox<?php echo $idprod;?>">
												 	    <?php
													 	   $price="100.6"; 								                 
									                       // echo form_open('Shopping/add');
									                        $attributes = array('class' => 'form', 'id' => 'prodForm'.$idprod, 'name' => 'prodForm'.$idprod);
									                        
									                        //echo "id producto:".$idprod;
									                        echo form_open('',$attributes);
									                            echo form_hidden('id', $idprod);
										                        echo form_hidden('name', $titulo);	  
										                        echo form_hidden('marca', $mar);	
										                        echo form_hidden('modelo', $mod);	       				           
										                        echo form_hidden('price', $price);
										                      /* $message = array('name' => 'message',
																	              'id'          => 'message'.$idprod,
																	              'value'       => '',
																	              'maxlength'   => '200',
																	              'size'        => '150',
																	              'style'       => 'width:100%');*/
																//echo form_input($message);

																$textarea = array(
																      'name' 		=> 'message',
																	  'id'          => 'message'.$idprod,
																      'value'       => '',
																      'rows'        => '3',
																      'cols'        => '100',
																      'placeholder' => 'Observaciones (opcional) Ejm: cantidad, izaje, capacidad, marca, etc.',				      
																      'style'       => 'width:100%',
																    );
																echo form_textarea($textarea);

										                       //echo form_input('message');
										                      /* echo form_input(array('name'=>'price','value'=>$item['price'],'size'=>'6',
																     'readonly'=>'true'));
																      //Or 'readonly'=>'readonly'	*/  
								                        						 	   
										 	  								                    
										                        $data = array(
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
															    );									                        
									                       
									                        echo form_button($data);
									                       // echo form_submit($data);
									                        echo form_close();
									                        ?>								              
											 	    
													</li>									
												
											 	</ul>															              
							                

											</div>
											<div class="alerta-prod" id="alerta-prod<?php echo $idprod;?>" >&nbsp;</div>
										</div>
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



	  
	




