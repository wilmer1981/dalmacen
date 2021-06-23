<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 

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
				                $id   = $cat->id;       
				                $des  = $cat->titulo;
				                $link1= $id."-".$des;
				                $url1 = urls_amigables($link1);
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