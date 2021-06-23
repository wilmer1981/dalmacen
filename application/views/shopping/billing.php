<?php
$grand_total = 0;

$total=0;
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


		<div class="row">
		   <form  class="form-horizontal" role="form" name="billing" method="post" action="<?php echo base_url() . 'Shopping/save_order' ?>" >
				<div class="col-lg-6 col-sm-6">	
					<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading-car heading-text" >Informacion Pedido</div>
						<div class="panel-body">	       				
						         
						  

									  <div class="form-group">
									    <label for="solicitud" class="col-lg-4 control-label">Razon Social <span class="required">*</span></label>
									    <div class="col-lg-6">
									      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Obligatorio">
									    </div>
									  </div>

									  <div class="form-group">
									    <label for="solicitud" class="col-lg-4 control-label">RUC:</label>
									    <div class="col-lg-6">
									      <input type="text" class="form-control" name="ruc" id="ruc" placeholder="Opcional">
									    </div>
									  </div>

									    <div class="form-group">
									    <label for="solicitud" class="col-lg-4 control-label">E-mail <span class="required">*</span></label>
									    <div class="col-lg-6">
									      <input type="email" class="form-control" name="email" id="email" placeholder="Obligatorio">
									    </div>
									  </div>
									    <div class="form-group">
									    <label for="solicitud" class="col-lg-4 control-label">Telefono <span class="required">*</span></label>
									    <div class="col-lg-6">
									      <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Obligatorio">
									    </div>
									  </div>
							
									  <div class="form-group">
									    <div class="col-lg-offset-2 col-lg-10">	
									    <?php
									    echo "<a class ='btn btn-primary ' id='back' href=" . base_url() . "Shopping><span class='glyphicon glyphicon-circle-arrow-left'> Regresar</a>";
									    ?>								
									      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-saved"></span> Enviar Solicitud</button>
									    </div>
									  </div>
						 	</div>
						</div>
					</div>
							
				</div>

				<div class="col-lg-6 col-sm-6">
						<div class="panel-group">
					<div class="panel panel-primary">
					    <div class="panel-heading-car heading-text" >Resumen Pedido</div>
						<div class="panel-body">
						<!--
						                   <table class="table" >
							                  <?php
							                  // All values of cart store in "$cart". 
							                  if ($cart = $this->cart->contents()): ?>							           
							                    <thead>
											        <tr>
											        <th>Item</th>
							                        <th>Producto</th>							                    
							                        <th>Observaciones</th>	         					                      
							                
											        </tr>
											    </thead>
												    <tbody>
							                    <?php
							                     // Create form and send all values in "shopping/update_cart" function.
							                      $attributes = array('class' => 'form', 'id' => 'cartForm');

							                    echo form_open('',$attributes);
							                    $grand_total = 0;
							                    $i = 1;

							                    foreach ($cart as $item):
							               
							                        
							                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
							                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
							                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
							                        echo form_hidden('cart[' . $item['id'] . '][marca]', $item['marca']);
							                        echo form_hidden('cart[' . $item['id'] . '][modelo]', $item['modelo']);
							                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
							                        echo form_hidden('cart[' . $item['id'] . '][message]', $item['message']);
							                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
							                   

							                        ?>
							                        <tr id="service<?php echo $item['id']; ?>" data="<?php echo $item['id']; ?>">
							                            <td><?php echo $i++; ?></td>
							                            <td>
							                  
							                            <?php echo $item['name']." Modelo ".$item['modelo']." ".$item['marca']; ?>
							                       
							                            </td>							                     
							                            <td>
							                             <?php echo $item['message']; ?>
							                            <?php							                  

							                            $textarea = array(
																      'name' 		  => 'cart[' . $item['id'] . '][message]',
																      'id'			  => 'message',		
																      'value'         => $item['message'],
																      'rows'          => '3',
																      'cols'          => '50',
																      'data-pk'       => $item['rowid'], 
																      'data-toggle'   => 'tooltip',
																      'data-placement'=>'right',
																      'placeholder' => 'Observaciones (opcional)',	
																      'title'         =>'Clik en Actualizar Observaciones para modificar!',		     
																      'style'         => 'width:50%; text-align:left',
																    );
							                           // echo form_textarea($textarea);        


							                 

							                            ?>
							                            <div id="msg">&nbsp;</div>	
							                            </td>						                       	
							                       
							                     <?php endforeach; ?>
							                       </tr>

							                    	<tr>
								                    	<td colspan="2"><span class="totales">Total Items:</span></td>
								                     	<td colspan="1"><b><?php 
								                     	//echo $this->cart->total_items(); 
								                     	echo $i-1; 

								                     	?>
								                     		
								                     	</b></td>
								                     	<td colspan="1"></td>         
							                    	</tr>

							                    	<tr>					                                        
							                  
							                        <td colspan="4" align="right">
							                        	<div id="alerta">&nbsp;</div> 
							                       				              			
							                       		                            	
							                        
							                         
							                        </td>
							                    	</tr>
							                    <tbody>
							                <?php endif; ?>
							            </table>
							            -->

						  </div>
						  </div>
						  </div>
				</div>
			</form>

		</div>
						






	  
	




