	<ul class="popular-products">
					<?php               
						 $cont=1;
						  foreach($latests as $latest){               
							$id     = $latest->id;           
							$des    = utf8_encode($latest->nombre);
							//$precio = $latest->precio;  
							//$dcto   = $latest->dcto;
							//$preciof= $precio - (($precio*$dcto)/100);   
							$img    = $latest->url_img;   
							$link1   = $id."-".$des;
							//$url1    = urls_amigables($link1);	
							$url1    = $latest->url;					
							  if($img)
								$image=$img;
							  else
								$image='assets/images/text.png';
						?>
				
						<li>
							 <h4><a href="<?php echo base_url('productos/preview/'.$url1);?>"><?php echo $des; ?></a></h4>
							  <a href="<?php echo base_url('productos/preview/'.$url1);?>"><img src="<?php echo base_url('admin/'.$image) ?>" alt="" /></a>
							  <div class="price-details">
						    <!--
						       <div class="price-number">
									<p><span class="rupees line-through">$899.95 </span> &nbsp; <span class="rupees">$839.93 </span></p>
							    </div>
								-->
							  
							    <div class="add-carrito">								
									<h4><a href="<?php echo base_url('productos/preview/'.$url1);?>" >Ver m&aacute;s...</a></h4>
					
								</div>
								<div class="clear"></div>
							</div>					 
						</li>
						<?php
						}
						?>
			
	</ul>