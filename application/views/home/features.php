              <!-- Features -->
   
                <?php
                  foreach($features as $feature){               
                    $id  = $feature->producto_id;           
                    $des = $feature->nombre;
                    $img = $feature->url_img;   

          $subid  = $feature->subcategoria_id; 
                    $subdes = $feature->descripcion;
                    $link   = $subid."-".$subdes;  
            
                      if($img)
                        $image=$img;
                      else
                        $image='assets/images/text.png';
                  ?>
        <div class="grid_list ">        
			<div class="col-xs-3 col-sm-5 col-md-5 sin-espacio">
			  <div class="grid_img"> 
				<a href="<?php echo base_url('catalogo/productos/'.$link);?>"> 
				<img src="<?php echo base_url('admin/'.$image);?>" class="img-responsive-destacado" alt="<?php echo $des; ?>"/>
				</a>
			  </div>
			</div>						
			<div class="col-xs-5 col-sm-7 col-md-7 sin-espacio-der">
			  <div class="grid_text">
			  <h3><a href="<?php echo base_url('catalogo/productos/'.$link);?>"><?php echo $des; ?></a></h3>
			 
			  </div>
			</div>
			<div class="clearfix"></div>              
        </div>
                <?php 
                  }              
                ?>            
         
              <!-- End Features -->