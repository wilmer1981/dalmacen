<?php 
//defined('BASEPATH') OR exit('No direct script access allowed'); 

	$logado = $this->session->userdata('logado');
	$user   = $this->session->userdata('nombres');
	//echo "Login: ".$logado." - ".$user;

    $cart_check = $this->cart->contents();     
    if(empty($cart_check)){
        $total=0;
    }else{
		if($cart = $this->cart->contents()){
            $i	= 1;
			foreach($cart as $item){
				$i++;
			}
		    $total=$i-1;
        }
    } 
	
?>
	<script type="text/javascript">
            // Estas variables pasaran al JS para mostrar en Chart
            var totalcart = "<?php echo $total; ?>";
    </script>
    <div class="header">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-8">
						<div class="logo">
							<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt=""></a>	
						</div>
						<div class="search">
							<form class="nav-search" action="" method="GET" role="search">
							<!--	
							<form class="nav-search" action="https://www.mercadolibre.com.pe/jm/search" method="GET" role="search">	
							-->		
								<div id="custom-search-input">
					                <div class="input-group">
					                    <input type="text" class="form-control" placeholder="Buscar productos, marcas y más..." />
					                    <span class="input-group-btn">
					                        <button class="btn btn-info btn-lg" type="button">
					                            <i class="glyphicon glyphicon-search"></i>
					                        </button>
					                    </span>
					                </div>
					            </div>
				        	</form>
						</div>
					</div>
					 <div class="col-xs-6 col-sm-6 col-md-4 not-lef">
						<div class="header-left">		
							<ul>
								<?php
								if(!$this->session->userdata('logado')){ 
									//echo "no iniciado";
								?>
								<li>
								<a href="<?php echo base_url('cuenta/login'); ?>">
									<i class="fa fa-user-circle-o fa-2"></i><p>Mi Cuenta</p>
								</a>
								</li>
								<?php 
								}else{ 
									//echo "iniciado";
							    ?>
							    <li class="dropdown">
							    	<a href="<?php echo base_url("cuenta/mi-cuenta"); ?>" title="Mi Cuenta" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-user-circle-o fa-2"></i><p>Mi Cuenta</p><span class="caret"></span></a>
									<ul class="dropdown-menu dropdown-menu-right ulcol">
										<li><a href="<?php echo base_url("cuenta/mi-cuenta"); ?>"><i class="fa fa-user-circle-o text-warning" aria-hidden="true"></i> Mi Cuenta</a></li>
										<li><a href="<?php echo base_url("cuenta/mis-pedidos"); ?>"><i class="fa fa-truck text-warning" aria-hidden="true"></i> Mis Pedidos</a></li>
										<!--
										<li><a href="http://localhost/opencart/index.php?route=account/transaction">Transactions</a></li>
										<li><a href="http://localhost/opencart/index.php?route=account/download">Downloads</a></li>
										-->
										<li><a href="<?php echo base_url("cuenta/logout"); ?>"><i class="fa fa-power-off text-warning" aria-hidden="true"></i> Cerrar Sesión</a></li>
									</ul>
								</li>
							    <?php } ?>

								<li>
									<a href="<?php echo base_url('shopping'); ?>"  ><i class="fa fa-shopping-cart fa-2"></i><p>Mi Carrito</p></a>									
								</li>					
							</ul>					
						</div>
					</div>
			    </div>
				<!--<div class="clearfix"> </div>-->
			</div>
		</div>

		<div class="container">
			<div class="head-top">
				<div class="logo-min">
					<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt=""></a>	
				</div>
				
		 	<div class=" h_menu4">
		 		<?php 
				//$this->load->view($menusup);
				$this->load->view($menucat);
				?>

			</div>	
			<div class=" h_user">
		 		<?php 
		 		if($this->session->userdata('logado')){ 
		 			echo "Bienvenido ".$this->session->userdata('nombres');
		 		}
		 		?>

			</div>				
			<div class="clearfix"> </div>
		</div>
		</div>

	</div>