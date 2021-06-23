 <?php						         
	foreach($categorias as $cat){               
		$id		=	$cat->id; 			
		$des    =	mb_strtoupper($cat->titulo,'utf-8');
		//$link1  =	$id."-".$des;
		$link1  =	$des;
		$url1   =	urls_amigables($link1);

		$sup = getSubcategoria($id);
		if(count($sup) > 0){                                       
			$idcat = $sup[0]->id_categoria; 
		}else{
			$idcat = '0';
		}  
          					          
            //echo "SUB:".$sub1;
			if($id==$idcat){ 
            //echo "entrooo";  
              echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">';
                  echo '<h4 class="panel-title">';
                  echo '<a data-toggle="collapse" data-parent="#accordian" href="#'.$url1.'"><span class="badge pull-right"><i class="fa fa-plus"></i></span>'.$des.'</a>';
                  echo '</h4>';
                echo '</div>';
              
                echo '<div id="'.$url1.'" class="panel-collapse collapse">';
                  echo '<div class="panel-body">';
                    echo '<ul>';
                        foreach($subcategorias as $sub){
                          $subid  = $sub->id; 
                          $catid  = $sub->id_categoria; 
                          $subdes = htmlentities($sub->titulo);
                          //$link   = $subid."-". $sub->descripcion;
						              $link   = $sub->titulo;
                          //$link   = $subid."-". quitar_tildes($sub->descripcion);
                          $url    = urls_amigables($link);
                          if($id==$catid){                             
                            echo '<li><a href="'.base_url('catalogo/productos/'.$url).'">'.$subdes.'</a></li>';
                          }
                        }
                    echo '</ul>';
                  echo '</div>';
                echo '</div>';              
              echo '</div>';
            }else{
              echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">';
                  //echo '<h4 class="panel-title"><a href="'.base_url('catalogo/categoria/'.$url1).'">'.$des.'</a></h4>';
				  echo '<h4 class="panel-title"><a href="'.base_url('catalogo/productos/'.$url1).'">'.$des.'</a></h4>';
                echo '</div>';
              echo '</div>';
            }
    }				                    
	?> 	  