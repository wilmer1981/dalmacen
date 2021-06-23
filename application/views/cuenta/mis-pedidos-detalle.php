<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
	<div class="content-cuenta">
		<div class="row">
		    <div class="col-sm-3 hidden-xs column-left" id="column-left">
		    	<div class="Categories left-sidebar-widget">
			        <h2 class="section-title">MENU DE USUARIO</h2>
					<div class="category_block">
			           <?php  if(isset($menuser)){ $this->load->view($menuser);} ?>	
			        </div>
		    	</div>
		    </div>
		    <div class="col-sm-9" id="content">
				<div class="Categories right-sidebar-widget">
				    <h2 class="section-title">Resumen de tu pedido</h2>
					<div class="profile-form">
						<form method="post" id="formProfile" class="form-horizontal">	
							<div class="row">
								<fieldset>           
								  <div class="col-md-12">
									 <table class="table table-bordered">                    
									  <tbody>
										 <tr>
										  <th scope="row" class="active"># Pedido</th>
										  <td><?php echo $pedido[0]->id; ?> </td>
										  <th scope="row" class="active">METODO DE PAGO</th>
										  <td><?php echo $pedido[0]->pago_codigo; ?></td>                              
										</tr>
										
										<tr>
										  <th scope="row" class="active">CLIENTE</th>
										  <td><?php echo $pedido[0]->cliente; ?></td>
										  <th scope="row" class="active">FECHA PEDIDO</th>
										  <td><?php echo $pedido[0]->fech_reg; ?></td>
										</tr>
										<tr>
										  <th scope="row" class="active">DIRECCION</th>
										  <td colspan="3"><?php echo $pedido[0]->direccion; ?></td>
										</tr>
										
									  </tbody>
									</table>          
								  </div>
								</fieldset>
							</div>
						    <div class="row">  
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-bordered table-hover">
										  <thead>
											<tr class="active">
											  <th class="text-right">Item</th>
											  <th class="text-left">Cliente</th>
											  <th class="text-right">Cantidad</th>
											  <th class="text-left">Precio Unit.</th>
											  <th class="text-right">Total S/</th>					  
											</tr>					
										  </thead>
										  <tbody>
											<?php 
											$cont=1;
											$sum=0;
											foreach($detalle as $r){
												$id       = $r->id;
												$cliente  = $r->nombres.''.$r->apellidos;
												$producto = $r->producto;
												$punit    = $r->precio_unit;
												
												$cantidad= $r->cantidad;
												$total   = number_format($r->cantidad * $r->precio_unit,2,'.','');
												$sum    = $sum + $total;
												
												$fecha   = fsalida_mysql($r->fech_reg,'-');	
												
												echo '<tr>';
												echo '<td class="text-right">'.$cont.'</td>';
												echo '<td class="text-left">'.$producto.'</td>';
												echo '<td class="text-right">'.$cantidad.'</td>';
												echo '<td class="text-right">'.$punit.'</td>';
												echo '<td class="text-right">'.$total.'</td>';
												echo '</tr>';
												$cont++;
												
											}
											echo '<tr class="active">';
												echo '<th class="text-right" colspan="4">TOTAL S/</th>';
												echo '<th class="text-right">'.number_format($sum,2,'.','').'</th>';
											echo '</tr>';
											?>
											</tbody>
										</table>
									</div>
								</div>	
					        </div>
						</form>
					</div>
			    </div>
			</div>
		</div>
    </div>
</div>
		