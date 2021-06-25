<ul class="memenu skyblue">
 <?php						         
	foreach($categorias as $cat){               
		$id		  =	$cat->id; 			
		$des    =	mb_strtoupper($cat->titulo,'utf-8');
    //$url1   =	urls_amigables(normaliza($cat->titulo));
    $url1   = $cat->url;
		$sup1   = getSubcategoria($id);

		if(count($sup1) > 0){                                       
			$idcat = $sup1[0]->id_categoria; 
		}else{
			$idcat = '0';
		}  
          					          
            //echo "SUB:".$sub1;
			if($id==$idcat){ 
          //echo $idcat."--";  
              echo '<li><a class="color1" href="'.base_url('productos/'.$url1).'">'.$des.'</a>';              
                echo '<div class="mepanel">';
                  echo '<div class="row">';
                      foreach($subcategorias as $sub){
                          $subid  = $sub->id; // id zapato = 16
                          $catid  = $sub->id_categoria; 
                          $subdes = htmlentities($sub->titulo);                     
						              $link   = $sub->titulo;            
                          //$url    = urls_amigables($link);
                          $url    = $sub->url;
                          //echo "categoria:".$idcat."--";
                          $sup2   = getSubcategoria($catid);
                          //var_dump($sup2);
                          if(count($sup2) > 0){                                       
                              $idcat1 = $sup2[0]->id_categoria;                      
                          }else{
                              $idcat1 = '0';
                          }  
                          // echo "   ".$subid.'/'.$idcat1.'--';
                          if($idcat==$idcat1){  
                                echo '<div class="col3">';
                                  echo '<div class="h_nav">';
                                  echo '<h5><a href="'.base_url('productos/'.$url).'">'.$subdes.'</a></h5>';
                                      echo '<ul>';
                                      foreach($subcategorias as $sub){  
                                        $subid2  = $sub->id; // id zapato = 16
                                        $catid  = $sub->id_categoria; 
                                        $subdes = htmlentities($sub->titulo);           
                                        $link   = $sub->titulo;            
                                        //$url    = urls_amigables($link);
                                        $url    = $sub->url;
                                        //echo "categoria:".$subid."--";
                                        $sup3   = getSubcategoria($subid);
                                        //var_dump($sup2);

                                        if(count($sup3) > 0){                           
                                            $idcat2 = $sup3[0]->id_categoria;      
                                        }else{
                                            $idcat2 = '0';
                                        } 

                                       // echo "   ".$catid .'/'.$idcat2.'--'; 
                                        if($catid ==$idcat2){
                                          echo '<li><a href="'.base_url('productos/'.$url).'">'.$subdes.'</a></li>'; 
                                        }                                
                                      }
                                      echo '</ul>';
                                  echo '</div>';
                                echo '</div>';                  
                          }
                        }             
                  echo '</div>';
                echo '</div>'; 
      }else{         
        echo '<li><a class="color1" href="'.base_url('productos/'.$url1).'">'.$des.'</a></li>';          
      }
    }				                    
	?> 	  
</ul>
