	
	<!--
	<ul class="nav navbar-nav collapse navbar-collapse">
	-->
	<ul class="memenu skyblue">
		<?php						         
        foreach($menus as $r){               
            $id      = $r->id;       
            $titulo     = $r->titulo;
           // $link1   = $id."-".$titulo;			
            $url1    = urls_amigables($titulo);
         	$sub     = $r->sub;       
            if($titulo=="Home"){
				$active="active";
				$link = base_url();
			}else{
            	$active="";
				//$link = base_url('catalogo/productos/'.$url1);
				$link = base_url('catalogo/'.$url1);
            }          
			 
            if($sub==1){	
				echo '<li class="dropdown"><a href="#">'.$titulo.'<i class="fa fa-angle-down"></i></a>'; 
		            echo '<ul role="menu" class="sub-menu">';
		         	 	foreach($submenus as $sub){
		         	 		$subid  = $sub->id;
		         	 		$subdes = $sub->titulo; 
		         	 	    $menuid = $sub->relacion;             	 	    
		         	 	    //$link   = $subid."-".$subdes;
							$link   = $subdes;
		         	 	    $url    = urls_amigables($link);
		         	 	    if($id==$menuid){						             	 	 
								echo '<li><a href="'.base_url('catalogo/'.$url1.'/'.$url).'">'.$subdes.'</a></li>';		
								//echo '<li><a href="'.base_url('catalogo/productos/'.$url).'">'.$subdes.'</a></li>';										
		         			}
		         		}
		         	echo '</ul>';
		        echo '</li>';
            }else{
				echo '<li class="'.$active.'"><a href="'.$link.'" >'.$titulo.'</a></li>';
				//echo '<li><a href="'.$link.'" class="'.$active.'">'.$titulo.'</a></li>';
			}		
        }
        ?> 
	</ul>

	