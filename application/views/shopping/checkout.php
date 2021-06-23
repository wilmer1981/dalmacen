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
	if(empty($cart)) {									
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

<form id="form-shopping" name="form-shopping" class="form-horizontal" method="post" >
	<div class="container">
		<div class="check">
		<div class="row">
	 		<div class="col-sm-9 sin-espacio-der cart-items">	
			  <div class="process">
			   <div class="process-row nav nav-tabs">
						<div class="process-step">
						 <button type="button" class="btn btn-warning btn-circle" data-toggle="tab" href="#menu1"><i class="fa fa-map-marker fa-3x"></i></button>
						 <p><small>Direccion <br />de Envio</small></p>
						</div>
						<div class="process-step">
						 <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu2"><i class="fa fa-money fa-3x"></i></button>
						 <p><small>Metodo <br />de Pago</small></p>
						</div>
						<!--
						<div class="process-step">
						 <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu3"><i class="fa fa-truck fa-3x"></i></button>
						
						 <p><small>Metodo <br />de Envio</small></p>
						</div>
						-->
						<div class="process-step">
						 <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu4"><i class="fa fa-check fa-3x"></i></button>
						  <p><small>Confirmar <br />Pedido</small></p>
						</div>
			   </div>
			  </div>
	  <div class="tab-content">
	   <div id="menu1" class="tab-pane fade active in">
		   <h4 class="tabs-panel-title"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> Dirección de envío</h4>
			<?php if(empty($direcciones)){ ?>
				<div class="row">  
					<div class="col-md-12"> 
							
					</div>
					<div class="col-xs-12">
						<button type="button" class="btn btn-default btn-xsm"  data-toggle="modal" data-target="#new_addresses">
						  Agregar nueva dirección
						</button>
					 </div>
				</div>
			
		<?php		
		 }else{
		?>
			<div class="row">  
				<div class="col-md-4 sin-espacio-der">	
					<div class="panel panel-default">
									
						<div class="panel-heading heading-text" ><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i><b> Direccion de envío  (Entregas de Lun a Sáb de 8am-10pm)</b></div> 
							
						<div class="panel-body panel-body-color">	
							<input type="hidden" name="txtIdDireccion" id="txtIdDireccion" value="<?php echo $cliente[0]->iddireccion;  ?>">					
							<div align="left">
								<table class="table">	
								<?php 	
										//echo $direcciones[0]->direccion."<br>";
										$ubigeo       = $cliente[0]->cod_ubigeo;
										$iddpto       = $cliente[0]->CodDpto;
										$idprov       = $cliente[0]->CodProv;  
										$nombdist     = $cliente[0]->distrito;  
										$provincia    = getProvincia($iddpto,$idprov);
										$departamento = getDepartamento($iddpto);
										
										//echo "<b>".$cliente[0]->nombres." ".$cliente[0]->apellidos."</b><br>";
										echo $cliente[0]->nombres." ".$cliente[0]->apellidos."<br>";
										echo $cliente[0]->direccion."<br>";
										echo $departamento[0]->Nombre.", ".$nombdist.", ".$provincia[0]->Nombre."<br>";
										echo "Telefono: ".$cliente[0]->telefono."<br>";
									
										

								?>	
								
															
								</table>
							</div>                  
						
						</div>
					</div>
				
				</div>
			</div>
		<?php } ?>

			<div class="botones">
			<ul class="list-unstyled list-inline pull-right">
			 <li><button type="button" class="btn btn-warning next-step">Siguiente <i class="fa fa-chevron-right"></i></button></li>
			</ul>
		  </div>
	   </div>
	   
	    <div id="menu2" class="tab-pane fade">
	     	<h4 class="tabs-panel-title"><i class="fa fa-money fa-lg" aria-hidden="true"></i> Metodo de Pago</h4>
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title">			  		
						<div class="radio">
							<label>
							<input type="radio" name="optPago" id="optPago" value="CE">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								Paga al recibir tu producto en efectivo				
							</a>
							</label>	
						</div>
					  </h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse in">
					  <div class="panel-body">
					  <p><strong>¡Haz tu pedido ahora y págalo en efectivo al recibir tu producto!</strong></p>
					  <p>Recuerda que si no podrás estar presente para la entrega, debes dejar a un tercero con el monto exacto a pagar.</p>

						<p>Y si no estás satisfecho con tu producto, puedes devolverlo completamente gratis dentro de los 10 días naturales posteriores a la entrega (se aplican términos y condiciones).</p></div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<div class="radio">
							<label>
							<input type="radio" name="optPago" id="optPago" value="DB">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
						 		 Depósito Bancario
						    </a>
						    </label>
						</div>
					  </h4>
					</div>
					<div id="collapse2" class="panel-collapse collapse">
					  <div class="panel-body">
							<p>Tienes hasta <b>48 horas calendario</b> para efectuar el pago, realizando el deposito en los Agentes del BCP y Oficinas BCP a Nivel nacional al siguiente numero de cuenta :<b> 123-5678999-0-92</b>.</p>

							<p>Y si no estás satisfecho con tu producto, puedes devolverlo completamente gratis dentro de los 10 días naturales posteriores a la entrega (se aplican términos y condiciones).</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title">			  		
						<div class="radio">
							<label>
							<input type="radio" name="optPago" id="optPago" value="MP">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
								Pagar con Mercado Pago			
							</a>
							</label>	
						</div>
					  </h4>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
					  <div class="panel-body">
					  <p><strong>¡Haz tu pedido ahora y págalo en efectivo al recibir tu producto!</strong></p>
					  <p>Recuerda que si no podrás estar presente para la entrega, debes dejar a un tercero con el monto exacto a pagar.</p>

						<p>Y si no estás satisfecho con tu producto, puedes devolverlo completamente gratis dentro de los 10 días naturales posteriores a la entrega (se aplican términos y condiciones).</p></div>
					</div>
				</div>		
		    </div>
				<div class="botones">
					<ul class="list-unstyled list-inline pull-right">
					 <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Atrás</button></li>
					 <li><button type="button" class="btn btn-warning next-step">Siguiente <i class="fa fa-chevron-right"></i></button></li>
					</ul>
				</div>
	    </div>
	   <!--
	   <div id="menu3" class="tab-pane fade">		
		<h4><i class="fa fa fa-truck fa-lg" aria-hidden="true"></i> Metodo de Envio</h4>		
		
		<ul class="list-unstyled list-inline pull-right">
		 <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Atras</button></li>
		 <li><button type="button" class="btn btn-warning next-step">Siguiente <i class="fa fa-chevron-right"></i></button></li>
		</ul>
	   </div>
	   -->
	    <div id="menu4" class="tab-pane fade">
		    <h4 class="tabs-panel-title"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Tus Productos</h4>	      				   
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
								echo form_open('shopping/update_cart');
									$grand_total = 0;
									$i = 1;
									foreach ($cart as $item):
										//   echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
										//  Will produce the following output.
										// <input type="hidden" name="cart[1][id]" value="1" />							
										echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
										echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
										echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']);
										echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
										echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
										echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
										
										$image       = base_url('admin/'.$item['image']);							
										$grand_total = $grand_total + $item['subtotal'];
								?>								
									<tr>
										<td class="cart_product">
											<a href=""><img src="<?php echo $image; ?>" alt="" class="img-thumbnail"></a>
											<!--
											<a href=""><img src="<?php echo base_url('assets/images/cart/one.png')?>" alt=""></a>
											-->
										</td>
										<td class="cart_description">
											<h4><?php echo $item['name']; ?></h4>
											<p>Web ID: 1089772</p>
											<p>
												<?php
												if ($this->cart->has_options($item['rowid'])){
			                                    	foreach ($this->cart->product_options($item['rowid']) as $opcion => $value){
			                                        	echo "<strong>" .$opcion . ":</strong> <em>" . $value . "</em>";
				                                    }
				                                }
				                                ?>
				                                </p>
				                                
										</td>
										<td class="cart_price">
											<p><?php echo "S/ ".$item['price']; ?></p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
												<!--
												<a class="cart_quantity_up" href="" id="<?php echo 'cart_' . $item['id'] . ''; ?>"> + </a>									
												<input class="cart_quantity_input" type="text" name="<?php echo 'cart[' . $item['id'] . '][qty]'; ?>" id="<?php echo 'cart_' . $item['id'] . ''; ?>" value="<?php echo $item['qty']; ?>" autocomplete="off" size="2">
												<a class="cart_quantity_down" href="" id="<?php echo 'cart_' . $item['id'] . ''; ?>"> - </a>
												-->
																						
												<input class="cart_quantity_input" type="text" name="<?php echo 'cart[' . $item['id'] . '][qty]'; ?>" value="<?php echo $item['qty']; ?>" autocomplete="off" size="2" readonly>
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
												
												
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price"><?php echo "S/ ".number_format($item['subtotal'], 2) ?></p>
										</td>
															
									</tr>
									<?php endforeach; ?>				
								
								</tbody>
							</table>
						</div>
					</div> 
				</div> 
				<div class="botones">
						<ul class="list-unstyled list-inline pull-right">
						 <li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Atras</button></li>
						 <li><button type="button" class="btn btn-warning" id="btn-saveorder"><i class="fa fa-check"></i> Finalizar Pedido</button></li>
						</ul>
				</div>	  
	    </div>
	  </div>

	  </div>
	  <div class="col-sm-3 sin-espacio-der">	
			<div class="panel panel-default">	
				<div class="panel-heading heading-text">RESUMEN DE TU PEDIDO</div>					
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
							<td><strong>S/.<?php echo number_format($grand_total,2);?></strong></td>
							</tr>
							<tr><td>Descuento   :</td><td>S/.<?php echo number_format(0, 2); ?></td></tr>
							<tr><td>Costo Envio :</td><td>S/.<?php echo number_format(0, 2); ?></td></tr>
							<tr><td>TOTAL</td><td><strong>S/.<?php echo number_format($this->cart->total(),2);?></strong></td></tr>
							<!--
							<tr>
							<td colspan="2">								
							<button type="button" class="btn btn-warning" id="btn-saveorder"><i class="fa fa-check"></i> Finalizar Pedido</button>
							</td>
							</tr>
							-->									
						</table>
					</div>       		
				</div>
			
			</div>
		  <div id="message-finalizar"></div>
	  </div>

	 </div>
	</div>
</div>
</form>



<div class="modal fade" id="new_addresses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<form method="post" id="formAddress" name="formAddress" class="form-horizontal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva Dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div  class="row" id="ubigeos_content">
		<div class="col-md-4">
		<div class="form-group">
		<label for="id_ubigeos_3">Departamento</label>
		<div class="cont">
		<select id="cboDpto" name="cboDpto" class="form-control ubigeos">
			<option value="0">Seleccione</option>
			<?php
			 foreach($departamentos as $r){
				 $ubigeo = $r->CodDpto;
				 $nombre = $r->Nombre;
				 echo '<option value="'.$ubigeo.'">'.$nombre.'</option>';
			 }
			
			?>
		</select>
		</div>
		</div>
		</div>
		<div class="col-md-4">
		<div class="form-group"><label for="id_ubigeos_2">Provincia</label>
		<div class="cont">
		<select id="cboProvincia" name="cboProvincia" class="form-control ubigeos" disabled="disabled">
			<option value="0">Seleccione</option>
		</select>
		</div>
		</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="id_ubigeos">Distrito</label>
				<div class="cont">
					<select id="cboDistrito" name="cboDistrito" class="form-control" disabled="disabled">
						<option value="0">Seleccione</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
			<label for="address_description">Dirección <small class="error-text"></small></label>
			<textarea id="txtDireccion" name="txtDireccion" class="form-control" rows="2" placeholder="Ingrese dirección" required=""></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
			<label for="address_refer">Referencia <small class="error-text"></small></label>
			<textarea id="txtReferencia" name="txtReferencia" class="form-control" rows="3" placeholder="Ingresar referencia"></textarea>
			</div>
		</div>
		<div class="col-md-12" id="promotion_locker">
			<div class="form-group">
				<label for="address_default">Usar como direccion predeterminada <small class="error-text"></small></label>
				<div class="controls">
					   <label class="radio-inline"><input type="radio" id="rdoDefault" name="rdoDefault" value="1">  Si</label>
					   <label class="radio-inline"><input type="radio" id="rdoDefault" name="rdoDefault" value="0">  No</label>
					
				</div>
			</div>
		</div>
		</div>
      </div>
      <div class="modal-footer">
		<div id="message-error"></div>
        <button type="button" class="btn btn-primary btn-regAddress">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
	</form>
  </div>
</div>

	
	