  <div id='flyout_menu'>
                      <ul>
                            <?php                    
                          foreach($categorias as $cat){    

                              $id  = $cat->id;       
                              //$des =utf8_encode($cat->titulo);
                              $des   = mb_strtoupper($cat->titulo, 'UTF-8'); 
                              $link1 = $id."-".$des;
                              $url1  = urls_amigables($link1);
              							  $link  = $cat->url;    
              							  $url0  = urls_amigables($link);							  
              								$sub   = $cat->sub;                        
                             // echo '<li><a href="#">'.$des.'</a>';
                              echo '<li><a href="'.base_url().'catalogo/productos/'.$url0.'">'.$des.'</a>';
                              if($sub==1){                      
                                echo '<ul>';
                                foreach($subcategorias as $sub){
                                  $subid  = $sub->id; 
                                    $catid  = $sub->categoria_id; 
                                    $subdes = utf8_encode($sub->descripcion);
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
           
