<ul class="menu">
 <?php		
  $cont= 1;				         
	foreach($categories as $cat){               
		$id		  =	$cat->id; 			
		$des    =	$cat->titulo;
		$link1  =	$des;
		$url1   =	urls_amigables($link1);
		$sup1   = getSubcategoria($id);
		if(count($sup1) > 0){                                       
			$idcat = $sup1[0]->id_categoria; 
		}else{
			$idcat = '0';
		}         					          
      //echo "SUB:".$idcat." -- ".$id;
		if($id==$idcat){ 
        echo '<li class="item'.$cont.'"><a href="'.base_url('productos/catalogo/'.$url1).'">'.$des.'</a>';
          echo '<ul class="cute">';
            $contsub=1;             
            foreach($subcategorias as $sub){
                $subid  = $sub->id; // id zapato = 16
                $catid  = $sub->id_categoria; 
                $subdes = htmlentities($sub->titulo);                     
	              $link   = $sub->titulo;            
                $url    = urls_amigables($link);
               // echo "categoria:".$idcat."--";
                $sup2   = getSubcategoria($idcat);
                //var_dump($sup2);
                if(count($sup2) > 0){                                       
                    $idcat1 = $sup2[0]->id_categoria;                      
                }else{
                    $idcat1 = '0';
                }  
                //echo "Categoria: ".$subid.'/'.$catid.'--';
                if($catid ==$idcat1){
                  echo '<li class="subitem'.$contsub.'"><a href="'.base_url('productos/catalogo/'.$url).'">'.$subdes.'</a></li>';
                }
            $contsub ++; 
            }             
          echo '</ul>';
        echo '</li>'; 
      }else{         
        echo '<li class="item'.$cont.'"><a href="'.base_url('productos/catalogo/'.$url1).'">'.$des.'</a></li>';    
      }
    $cont++;
    }				                    
	?> 	  
</ul>
