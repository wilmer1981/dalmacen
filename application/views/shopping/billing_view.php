<?php defined('BASEPATH') OR exit('No direct script access allowed');

$grand_total = 0;
// Calculate grand total.
if ($cart = $this->cart->contents()):
    foreach ($cart as $item):
        $grand_total = $grand_total + $item['subtotal'];
    endforeach;
endif;
?>


<div class="container-page">
<div class="container">
	<div class="row">
	<div class="col-md-9 sin-spacio">


		<div data-wizard-init>
		<ul class="steps">
		  <li data-step="1">Datos del Cliente</li>
		  <li data-step="2">Resumen de Cotizacion</li>	 
		</ul>
		<?php 
		//if ($custom_error != '') {
		  //  echo '<div class="alert alert-danger">' . $custom_error . '</div>';
		//}
		
	if ($cart = $this->cart->contents()){

	  ?>	
	
	
    <form id="formCompra" name="formCompra" class="form-horizontal" method="post" >
    <div class="steps-content">
      
		<div data-step="1">
		  <div class="row" style="margin-top:0">
			<div class="col-md-12">
			  <div class="widget-box">              
				<div class="widget-content nopadding">					
					  <div class="row ">                        
						  <div class="col-md-12">                                           
							  <div class="form-group">
								  <label for="sd_lastname" class="col-md-2 control-label">Nombres:</label>
								  <div class="col-md-5">
									  <input type="text" name="txtNombres" id="txtNombres" class="form-control" placeholder="Nombre o Razon Social" >
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="sd_firstname" class="col-md-2 control-label">Direccion:</label>
								  <div class="col-md-5">
									  <input type="text" name="txtDireccion" id="txtDireccion" class="form-control" placeholder="Direccion(Opcional)"  >
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="sd_firstname" class="col-md-2 control-label">RUC:</label>
								  <div class="col-md-5">
									  <input type="text" name="txtRuc" id="txtRuc" class="form-control" placeholder="RUC(Opcional)"  >
								  </div>
							  </div>
							  
							 <div class="form-group">
								<label for="sd_firstname" class="col-md-2 control-label">E-mail</label>
								<div class="col-md-5">
									<input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="E-mail"  >
								</div>
							</div>
							<div class="form-group">
								<label for="sd_firstname" class="col-md-2 control-label">Telefono</label>
								<div class="col-md-3">
									<input type="text" name="txtTelefono" id="txtTelefono" class="form-control" placeholder="Telefono" >
								</div>
							</div>
						  </div>
					  </div>
				
		  
						  

				</div>
			  </div>
			</div>
		  </div>
		</div>  
  
 
		<div data-step="2">     
			<div class="row">
				<div class="col-md-12">
				  <div class="widget-box">    
					<div class="widget-content nopadding">                 
						<div class="row">  
							<div class="col-md-12 form-cinicial">                 				   
								<div class="row">
									<div id="cart"> 								
										<table class="table">											
																           
													<thead>
														<tr>
														<th>#</th>
														<th>PRODUCTO</th>							                  
														<th>CANTIDAD</th>
														<th>OBSERVACION</th>
														<th></th>
														</tr>
													</thead>
														<tbody>
													<?php
													 // Create form and send all values in "shopping/update_cart" function.
												
													$grand_total = 0;
													$i = 1;

													foreach ($cart as $item):
														//   echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
														//  Will produce the following output.
														// <input type="hidden" name="cart[1][id]" value="1" />
													
														echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
														echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
														echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
														echo form_hidden('cart[' . $item['id'] . '][marca]', $item['marca']);
														echo form_hidden('cart[' . $item['id'] . '][modelo]', $item['modelo']);
														echo form_hidden('cart[' . $item['id'] . '][message]', $item['message']);
														echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
														echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
													
														?>
														<tr>
															<td><?php echo $i++; ?></td>
															<td><?php echo $item['name']." Modelo ".$item['modelo']." ".$item['marca']; ?></td>													
															<td><?php echo $item['qty']; ?></td>
								
															 <?php $grand_total = $grand_total + $item['subtotal']; ?>
														
															<td><?php echo $item['message']; ?></td>													
															<td></td>
													 <?php endforeach; ?>
													   </tr>

														<tr>
														<td colspan="3">							                    
														</td>	
														<td colspan="2" align="right">							                    
														 <b>TOTAL ITEMS: <?php echo $this->cart->total_items(); ?></b>
														</td>														
														</tr>
														<tr>
														<td colspan="2" >
														<?php														
														//echo "<a class ='btn btn-default' id='back' href=" . base_url() . "><i class='fa fa-reply'></i> SEGUIR COMPRANDO</a>"; 
														echo "<a class ='btn btn-default' href=" . base_url('Shopping') . "><i class='fa fa-reply'></i> REGRESAR AL CARRO</a>"; 
					
														?>
																														</td>						                      
														<td colspan="3" align="right">							                 
														</td>
														</tr>
													<tbody>
												
										</table>
									</div> 
								</div>               
							
							</div>                 
						</div>           
					</div>
				 </div>
			  </div>
			</div>
		</div>
 
    </div>
	
  
    
	</div>
					
	</div>
	
	
	<div class="col-sm-3 sin-espacio-der">	
			<div class="panel panel-primary">		
				 <div class="panel-heading heading-text" >
				 RESUMEN DE TU PEDIDO</div>				 
					
				<div class="panel-body panel-body-color">       			
		   
                			<div align="center">
                                <table class="table">						
									<thead>
									<tr>
										<th>RESUMEN PEDIDO</th>
										<th></th>
									</tr>
									</thead>
									<tr>
									<td>SubTotal(<?php echo $this->cart->total_items();?> articulos)</td>
									<td><strong>S/.<?php echo number_format($this->cart->total(),2);//echo number_format($grand_total, 2); ?></strong></td>
									</tr>
									<tr><td>Costo Envio</td><td>S/.<?php echo number_format(0, 2); ?></td></tr>
									<tr><td>TOTAL</td><td><strong>S/.<?php 
									echo number_format($this->cart->total(),2);
									//echo number_format($grand_total, 2); ?></strong></td></tr>

									<tr>
									<td colspan="2">
								
									<button type="button" id="btn-pedidos" name="btn-pedidos" class ="btn btn-success"><i class="glyphicon glyphicon-floppy-save icon-white"></i> FINALIZAR PEDIDO</button>
									<!--
									<input class="btn btn-success align-right" id="btn-pedidos" name="btn-pedidos" type="button" value="Enviar Solicitud" />
									-->
									</td>
									</tr>                                                
                                </table>
                            </div>                  
        		
				</div>
			</div>
		 <div id="status">gfgjghj</div>
	</div>

	</div>
	
	</form> 
	  <?php } ?>
</div>
</div>

