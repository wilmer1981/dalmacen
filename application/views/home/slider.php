<?php
      $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
     // echo $url;
      $rurl=$_SERVER["REQUEST_URI"];
     // echo "<br> ".$rurl ;

    $array = explode("/", $rurl);
    $parte0=$array[0];
   // $parte1=$array[1]; //manioper.com
  // echo $parte0;
  if(isset($array[1])){ //si existe
         $parte1=$array[1];
    }
  if(isset($array[2])){ //si existe
         $parte2=$array[2];
    }
    if(isset($array[3])){ //si existe
        $parte3=$array[3];
    }
    if(isset($array[4])){ //si existe    
        $parte4=$array[4];
     }

?>
<div class="slider-container  sin-espacio">
      <div  id="top" class="callbacks_container">
        <ul class="rslides" id="slider">      
              <?php                    
                foreach($banners as $b){               
                    $id      = $b->id;       
                    $titulo  = $b->titulo;
                    $link1   = $id."-".$titulo;
                    $url1    = urls_amigables($link1);
                    $descrip = $b->descripcion; 
                    $imagen  = $b->url_imagen;     
                    $orden   = $b->orden;  
                    if($orden==1){
                      $active='active';
                    }else{
                      $active='';
                    }  
					         echo '<li><img src="'.base_url('admin/'.$imagen).'" alt="" /></li>'; 	                      
                }         
              ?> 
          </ul>
      </div>
  </div>
            
  

