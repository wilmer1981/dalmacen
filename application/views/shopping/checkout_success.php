<?php defined('BASEPATH') OR exit('No direct script access allowed');

$grand_total = 0;
// Calculate grand total.
if ($cart = $this->cart->contents()):

	$i = 1;
    foreach ($cart as $item):
        $grand_total = $grand_total + $item['subtotal'];
		$i++;	
		
    endforeach;
	$total=$i-1;
endif;
?>

 <?php  
	$cart = $this->cart->contents();            
	// If cart is empty, this will show below message.
	if(empty($cart)){									
		$total=0;
	}else{ 					 
				 
		if ($cart = $this->cart->contents()){
			$i = 1;
			foreach ($cart as $item){
				$i++;
			}
			$total=$i-1;
		}
	}
 
									 
?>

<section id="cart_items">
<div class="container">
	<div class="row">		
		<div class="col-md-9">
			<div class="row">
				<div class="col-xs-2 col-md-2"></div> 
				<div class="col-xs-8 col-md-8 centrar">					
					<h3>¡Su requerimiento fue enviado correctamente!</h3>
					<hr></hr>
					<p><h4>Puede ver su historial de pedidos yendo a la página de "Mi cuenta" y haciendo clic en "Mis Pedidos".</h4></p>
					<p><h4>¡Gracias por comprar con nosotros en línea!</h4></p>
					<hr></hr>
					<a type="button" href="<?php echo base_url('shopping'); ?>" class="btn btn-warning">COMPRAR AHORA</a>
					<br><br>
				</div>
				<div class="col-xs-2 col-md-2"></div> 
			</div>
		</div>
		
		<div class="col-md-3">	
			<div class="panel panel-default">	
				 <div class="panel-heading heading-text" >
				 RESUMEN DE TU PEDIDO</div>				 
					
				<div class="panel-body panel-body-color">       			
		   
                			<div align="center">
                                <table class="table">						
									<!--
									<thead>
									<tr>
										<th>RESUMEN PEDIDO</th>
										<th></th>
									</tr>
									</thead>
									-->
									<tr>
									<td>SubTotal(<?php echo $this->cart->total_items();?> articulos):</td>
									<td><strong>S/.<?php 
									echo number_format($grand_total,2);
									//echo number_format($this->cart->total(),2);
									
									//echo number_format($grand_total, 2); 
									?></strong></td>
									</tr>
									<tr><td>Descuento   :</td><td>S/.<?php echo number_format(0, 2); ?></td></tr>
									<tr><td>Costo Envio :</td><td>S/.<?php echo number_format(0, 2); ?></td></tr>
									<tr><td>TOTAL</td><td><strong>S/.<?php 
									echo number_format($this->cart->total(),2);
									//echo number_format($this->cart->total(),2);
									//echo number_format($grand_total, 2); ?></strong></td></tr>

									<tr>
									<td colspan="2">
									
									</td>
									</tr>                                                
                                </table>
                            </div>                  
        		
				</div>
			</div>
		 <div id="status"></div>
		</div>	 
	 </div>
</div>
</section>

