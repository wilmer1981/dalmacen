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
	<div class="check">
	<div class="row">		
		<div class="col-md-9">
			<div class="row resumen">                        
				<div class="col-md-6"> 
				   <div class="row ">                                           
					<div class="form-group">
						  <label for="sd_lastname" class="col-md-2 control-label">Nombres:</label>
						  <div class="col-md-10">
							  <label><?php echo $this->session->userdata('nombre');?></label>
						  </div>
					</div>
					</div>
					<div class="row "> 
					<div class="form-group">
						  <label for="sd_firstname" class="col-md-2 control-label">Direccion:</label>
						  <div class="col-md-10">
							 <label><?php echo $this->session->userdata('nombre');?></label>
						  </div>
					</div>
				    </div>
				    <div class="row "> 
					<div class="form-group">
						<label for="sd_firstname" class="col-md-2 control-label">E-mail</label>
						<div class="col-md-10">
							<label><?php echo $this->session->userdata('email');?></label>
						</div>
					</div>
				    </div>
				</div>
				<div class="col-md-6"> 
				   <div class="row ">                                           
					<div class="form-group">
						  <label for="sd_lastname" class="col-md-4 control-label">Telefono:</label>
						  <div class="col-md-8">
							  <label><?php echo $this->session->userdata('nombre');?></label>
						  </div>
					</div>
					</div>
					<div class="row "> 
					<div class="form-group">
						  <label for="sd_firstname" class="col-md-4 control-label">Metodo de pago:</label>
						  <div class="col-md-8">
							 <label><?php echo $this->session->userdata('nombre');?></label>
						  </div>
					</div>
				    </div>
				    <div class="row "> 
					<div class="form-group">
						<label for="sd_firstname" class="col-md-4 control-label">Email</label>
						<div class="col-md-8">
							<label><?php echo $this->session->userdata('email');?></label>
						</div>
					</div>
				    </div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div id="cart"> 								
					<div class="table-responsive cart_info">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th>Item</th>
									<th></th>
									<th>Precio</th>
									<th>Cantidad</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							<?php
							// Create form and send all values in "shopping/update_cart" function.
						
								$grand_total = 0;
								$i = 1;
								foreach ($cart as $item):
									
									
									$image       = base_url('admin/'.$item['image']);							
									$grand_total = $grand_total + $item['subtotal'];
							?>								
								<tr>
									<td class="cart_product">
										<img src="<?php echo $image; ?>" alt="" class="img-thumbnail">
									</td>
									<td class="cart_description">
										<h4><?php echo $item['name']; ?></h4>
										<p>Web ID: 1089772</p>		                                
									</td>
									<td class="cart_price">
										<p><?php echo "S/ ".$item['price']; ?></p>
									</td>
									<td class="cart_quantity">
										<p><?php echo $item['qty']; ?></p>							
									</td>
									<td class="cart_total">
										<p><?php echo "S/ ".number_format($item['subtotal'], 2) ?></p>
									</td>
														
								</tr>
								<?php endforeach; ?>				
							
							</tbody>
						</table>
					</div>
				</div> 
			</div>
		</div>
		
		<div class="col-md-3">	
			<div class="panel panel-default">	
				 <div class="panel-heading heading-text" >RESUMEN DE TU PEDIDO</div>				
				<div class="panel-body panel-body-color">       			
		   
                			<div align="center">
                                <table class="table">						
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
									<a href="<?php echo $MP_Checkout; ?>" class="order"> PAGAR ORDEN </a>
									<!--
									<a href="
									<?php //echo $preference->init_point; ?>" class="order"> PAGAR ORDEN </a>
								-->

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
</div>
</section>

