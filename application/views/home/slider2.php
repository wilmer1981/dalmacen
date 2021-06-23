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

      //$parte4=$array[3];
    //echo "<br>parte1:".$parte1;
    //echo "<br>parte2:".$parte2;
    // echo "<br>parte3:".$parte3;
?>
  <section id="slider"><!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
			 <?php
				$count = count($banners);
				 //echo "Contador: ".$count;
				 $i=0;
				 for ($i = 0; $i < $count; $i++){
					 if($i==0){
						$active="active";
					 }else{
						$active="";
					 }
				 echo '<li data-target="#slider-carousel" data-slide-to="'.$i.'" class="'.$active.'"></li>';	
				}
				 
			 ?>
			 <!--
              <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
			  -->
            </ol>
            
            <div class="carousel-inner">
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
					echo '<div class="item '.$active.'">                    
                      <div class="col-xs-12 col-sm-12 col-md-12 item_spacing">
                        <img src="'.base_url('admin/'.$imagen).'" class="girl img-responsive" alt="" />
                        </div>
                    </div>'; 				
                 
                   /* echo '<div class="item '.$active.'">
                      <div class="col-sm-6">
                        <h1><span>E</span>-'.$titulo.'</h1>
                        <h2>Free E-Commerce Template</h2>
                        <p>'.$descrip.'</p>
                        <button type="button" class="btn btn-default get">Consíguelo ahora</button>
                      </div>
                      <div class="col-sm-6">
                        <img src="'.base_url('admin/'.$imagen).'" class="girl img-responsive" alt="" />
                        <img src="'.base_url('assets/images/home/pricing.png').'"  class="pricing" alt="" />
                      </div>
                    </div>';  */                         
                }         
              ?> 
            </div>
            
            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </section><!--/slider-->