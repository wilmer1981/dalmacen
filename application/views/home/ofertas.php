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
  <div class="section-header">
          <h3>OFERTAS DEL MES</h3>
  </div>
  <div class="divider"></div> 
  <div class="w3l_related_products">
    <ul id="flexiselOferta"> 
    <?php                    
      foreach($offerts as $o){  
        $idprod   = $o->id;      
        $producto = $o->nombre;
        $precio   = $o->precio;
        $poferta  = $o->precio_oferta;
        $link     = $idprod."-".$producto;
        $imagen   = $o->url_imagen; 
        //$url      = urls_amigables($link);
        $url      = $idprod."-".$o->url;
        $images   = getProductImages($idprod);
 
        echo '<li>
                <div class="w3l_related_products_grid">
                  <div class="agile_ecommerce_tab_left dresses_grid">
                    <div class="hs-wrapper hs-wrapper3">';            
                      //foreach ($images as $key => $value) {
                      foreach ($images as $i){
                          $img      = $i->url_imagen; 
                          if($img){
                            $image=$img;
                            $image='<img src="'.base_url('admin/'.$image).'" class="img-responsive"  />';
                          }else{
                            $image=$imagen;
                            $image='<img src="'.base_url('admin/'.$image).'" class="img-responsive"  />';
                          }     
              
                          echo $image; 
                      }
                     /* echo '<div class="hs-overlay">
                        <span>Summer <strong>2012</strong></span>
                      </div>';*/
                  echo '<div class="w3_hs_bottom">
                          <div class="flex_ecommerce">
                            <a href="'.base_url('productos/preview/'.$url).'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                          </div>
                        </div>';
                echo '</div>';//wrapper

                echo '<h5><a href="'.base_url('productos/preview/'.$url).'">'.$producto.'</a></h5>';
                echo '<div class="simpleCart_shelfItem">';
                  echo '<p class="flexisel_ecommerce_cart"><span> S/ '.$precio.'</span><i class="item_price"> S/ '.$poferta.'</i></p>';
                  //echo '<p class="number"><i> </i><a class="item_add" href="#">Add to cart</a></p>';
                echo '</div>';

              echo '</div>'; //agile;
            echo '</div>';
          echo '</li>';
        }
?>
    </ul>
  </div>            
  

