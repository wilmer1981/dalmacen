<?php
$cart = $this->cart->contents();   

//var_dump($cart);  
?>    
<script type="text/javascript">
            // To conform clear all data in cart.
        function clear_cart() {
            var result = confirm('Are you sure want to clear all bookings?');
            if (result) {
                window.location = "<?php echo base_url('shopping/remove/all'); ?>";
            } else {
                return false; // cancel button
            }
        }
    </script>
    <!--
    	<script>$(document).ready(function(c) {
					$('.close1').on('click', function(c){
						$('.cart-header1').fadeOut('slow', function(c){
							$('.cart-header1').remove();
						});
						});	  
					});
		</script>
		 <script>$(document).ready(function(c) {
					$('.close2').on('click', function(c){
							$('.cart-header2').fadeOut('slow', function(c){
						$('.cart-header2').remove();
					});
					});	  
					});
			 </script>
		<script>$(document).ready(function(c) {
					$('.close3').on('click', function(c){
							$('.cart-header3').fadeOut('slow', function(c){
						$('.cart-header3').remove();
					});
					});	  
					});
			 </script>
			-->
<section id="cart_items">
<div class="container">
	<?php 				     
	if(empty($cart)){									
		$total=0;									 
	?>
	<div class="row">										
		<div class="col-xs-2 col-md-2"></div> 						 
		<div class="col-xs-8 col-md-8 centrar"> 
			<img src="<?php echo base_url('assets/images/cart/shopping-cart-icon.png') ?>" class="img-responsive centrar-img">
			<h2 class="highlight">NO TIENES PRODUCTOS EN TU CARRO</h2>
			<h3>Encuentra los mejores productos, a los mejores precios.</h3>
			<hr></hr>
			<a type="button" href="<?php echo base_url(); ?>" class="btn btn-warning">COMPRAR AHORA</a>
		</div>					
		<div class="col-xs-2 col-md-2"></div> 										
	</div>
	<?php
	}else{ 								 
		if($cart = $this->cart->contents()){
			$i = 1;
			foreach ($cart as $item){
				$i++;
			}
			$total=$i-1;
		}
	?>
	<div class="check">	 
		<h1>CARRITO DE PEDIDOS (<?php echo $this->cart->total_items(); ?>)</h1>
		<div class="col-md-9 cart-items">			
			<?php
			echo form_open('shopping/update_cart');
				$grand_total = 0;
				$i = 1;
				foreach ($cart as $item){
					//   echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
					//  Will produce the following output.
					// <input type="hidden" name="cart[1][id]" value="1" />					
					echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
					echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
					echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']);
					echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
					echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
					echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
					
					$image= base_url('admin/'.$item['image']);
					
					$grand_total = $grand_total + $item['subtotal'];
			?>
			<div class="cart-header">
				<div class="close">					
					<a class="cart_quantity_delete" href="<?php echo base_url('shopping/remove/'. $item['rowid']); ?>"><i class="fa fa-times"></i></a>
							
				</div>
			    <div class="cart-sec simpleCart_shelfItem">
					<div class="cart-item cyc">				
						<img src="<?php echo $image; ?>" class="img-responsive" alt=""/>
					</div>
				    <div class="cart-item-info">
						<h3>
							<a href="#"><?php echo $item['name']; ?></a>
							<span>Model No: 3578</span>
							<span>Precio: <?php echo "S/ ".number_format($item['price'], 2, '.', ''); ?></span>
						</h3>

						<ul class="qty">
							<li><p>Size : 5</p></li>
							<li>
								<p>Cantidad : 		
								<input class="number_box" type="number" name="<?php echo 'cart[' . $item['id'] . '][qty]'; ?>" value="<?php echo $item['qty']; ?>" min="1">
									
										<?php 					
											
										$data = array(
											'name' => 'cart[' . $item['id'] . '][qty]',
											'value' => $item['qty'],
											'size'=>'2',
											'min'=>'1',
											'maxlength'=>'3',
											'class' => 'cart_quantity_input size-number',
											'title'         =>'Clik en ACTUALIZAR para modificar!',	
											'data-toggle'   => 'tooltip',
											'data-placement'=>'right',										
										  'type' => 'number'      //it's 'number', not 'numeric'
										);
										//echo form_input($data);
										
										
										//echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="2" ');
										?>
										</p>
								</li>
						</ul>
						<!--
						<div class="delivery">
							 <p>Service Charges : Rs.100.00</p>
							 <span>Delivered in 2-3 bussiness days</span>
							 <div class="clearfix"></div>
				        </div>
				        -->	
				    </div>
				   <div class="clearfix"></div>											
			    </div>
			</div>
			<?php $i++; } ?>
				</div>
		<div class="col-md-3 cart-total">
			<a class="continue" href="<?php echo base_url(); ?>">SEGUIR COMPRANDO</a>
			 <!--<h1>RESUMEN DE TU PEDIDO</h1>-->
			 <div class="price-details">
				 <h3>Detalles de Precio</h3>
				 <span>Subtotal (<?php  $text = $this->cart->total_items()>1 ? 'artículos' : 'artículo'; echo $this->cart->total_items().' '.$text; ?>) </span>
				 <span class="total1"><?php echo "S/ ".$this->cart->format_number($this->cart->total()); ?></span>
				 <span>Descuento</span>
				 <span class="total1">0.00</span>
				 <span>Gastos de envío</span>
				 <span class="total1">0.00</span>
				 <div class="clearfix"></div>				 
			 </div>	
			 <ul class="total_price">
			   <li class="last_price"> <h4>TOTAL</h4></li>	
			   <li class="last_price"><span><?php echo "S/ ".number_format($grand_total, 2, '.', ''); ?></span></li>
			   <div class="clearfix"> </div>
			 </ul>			 
			 <div class="clearfix"></div>
			 <a class="order" href="<?php echo base_url('shopping/checkout');?>">PROCESAR PEDIDO</a>
		
			 <div class="total-item">
			 	<button class ='btn btn-default cpns update' type="submit" ><i class="fa fa-refresh"></i> ACTUALIZAR</button>
				<a class="btn btn-default cpns removeall" href="<?php echo base_url('shopping/remove/all'); ?>"><i class="fa fa-trash"></i> ANULAR</a>
			 </div>
			 <!--
			 <div class="total-item">
			 	 <h3>OPTIONS</h3>
				 <h4>COUPONS</h4>
				 <a class="cpns" href="#">Aplicar cupones</a>
				 <p><a href="#">Iniciciar sesión</a> usar cuentas - cupones vinculados</p>
			 </div>
			-->
		</div>
		
		<div class="clearfix"> </div>

		<?php echo form_close(); ?>
	</div>

    <?php } ?>
</div>
</section>