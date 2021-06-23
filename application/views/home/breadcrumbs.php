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
  <section id="breadcrumb"><!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">			
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url()?>" title="Home"><i class="fa fa-home"></i></a></li>
					
					<?php if($this->uri->segment(1) != null && empty($this->uri->segment(2))){ ?>
					<li class="active"><?php echo ucfirst($this->uri->segment(1));?></li>
					<?php }?>
					
					<?php if($this->uri->segment(1) != null && $this->uri->segment(2)!= null && empty($this->uri->segment(3))){ ?>
					 <li>
						<a href="<?php echo base_url($this->uri->segment(1)); ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(1)); ?>">
						<?php echo ucfirst($this->uri->segment(1)); ?>            
						</a>
					</li>
					<li class="active"><?php echo ucfirst($this->uri->segment(2)); ?></li>				
					<?php }?>
					
					<?php if($this->uri->segment(1) != null && $this->uri->segment(2) != null && $this->uri->segment(3) != null){ ?>
				     <li>
						<a href="<?php echo base_url($this->uri->segment(1));?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(1)); ?>">
						<?php echo ucfirst($this->uri->segment(1)); ?>            
						</a>
					</li>
					<li>
						<a href="<?php echo base_url($this->uri->segment(1)."/".$this->uri->segment(2));?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>">
						<?php echo ucfirst($this->uri->segment(2)); ?>            
						</a>
					</li>
					<li class="active"><?php echo ucfirst($this->uri->segment(3)); ?></li> 					
					<?php }?>					
							
				</ol>
		
			
			<!--
		    <div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url()?>" title="Dashboard"><i class="fa fa-home"></i> Home</a></li>
					
					<?php if($this->uri->segment(1) != null && empty($this->uri->segment(2))){ ?>
					<li class="active"><?php echo ucfirst($this->uri->segment(1));?></li>
					<?php }?>
					
					<?php if($this->uri->segment(1) != null && $this->uri->segment(2)!= null && empty($this->uri->segment(3))){ ?>
					 <li>
						<a href="<?php echo base_url($this->uri->segment(1)); ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(1)); ?>">
						<?php echo ucfirst($this->uri->segment(1)); ?>            
						</a>
					</li>
					<li class="active"><?php echo ucfirst($this->uri->segment(2)); ?></li>				
					<?php }?>
					
					<?php if($this->uri->segment(1) != null && $this->uri->segment(2) != null && $this->uri->segment(3) != null){ ?>
				     <li>
						<a href="<?php echo base_url($this->uri->segment(1));?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(1)); ?>">
						<?php echo ucfirst($this->uri->segment(1)); ?>            
						</a>
					</li>
					<li>
						<a href="<?php echo base_url($this->uri->segment(1)."/".$this->uri->segment(2));?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>">
						<?php echo ucfirst($this->uri->segment(2)); ?>            
						</a>
					</li>
					<li class="active"><?php echo ucfirst($this->uri->segment(3)); ?></li> 					
					<?php }?>					
							
				</ol>
			</div>
			-->
	
		  <!--
          <ol class="breadcrumb"> 
            <li><a href="<?php echo base_url()?>" title="Dashboard">
            <i class="fa fa-home"></i></a></li>
            <?php 
              if($this->uri->segment(1) != null){
            ?>
            <li class="active"><a href="<?php echo base_url().$this->uri->segment(1)?>" class="tip-bottom" title="<?php echo ucfirst($this->uri->segment(1));?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>

            <?php 
            if($this->uri->segment(2) != null){
            ?>
              <li class="active"><a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2) ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>">
                <?php echo ucfirst($this->uri->segment(2)); 
            } 
            ?>            
            </a>
            </li> 
            <?php }?>
          </ol>		
		-->         
          
        </div>
      </div>
    </div>
  </section><!--/slider-->