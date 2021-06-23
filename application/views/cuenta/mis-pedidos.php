<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
	<div class="content-cuenta">
		<div class="row">
		    <div class="col-sm-3 hidden-xs column-left" id="column-left">
		      <div class="categories left-sidebar-widget">
		        <h2 class="section-title">MENU DE USUARIO</h2>
				<div class="category_block">
		        <?php  if(isset($menuser)){ $this->load->view($menuser);} ?>	
		        </div>
		      </div>
		    </div>
		    <div class="col-sm-9" id="content">
				<div class="Categories right-sidebar-widget">
				<h2 class="section-title">Mis Pedidos</h2>
				<div class="profile-form">
				<form method="post" id="formProfile" class="form-horizontal">
			      <div class="row">  
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
							  <thead>
								<tr>
								  <td class="text-right">Orden ID</td>
								  <td class="text-left">Cliente</td>
								  <td class="text-right">No. de Productos</td>
								  <td class="text-left">Estado</td>
								  <td class="text-right">Total</td>
								  <td class="text-left">Fech.Pedido</td>
								  <td></td>
								</tr>
							  </thead>
							  <tbody>
								<?php 
								foreach($pedido as $r){
									$id      = $r->id;
									$cliente = $r->nombres.''.$r->apellidos;
									
									$cantidad= $r->cantidad;
									$total   = $r->total;
									$fecha   = fsalida_mysql($r->fech_reg,'-');	
									if($r->estado==1){
										$estado  = "Pendiente";
									}else if($r->estado==2){
										$estado  = "Despachado";
									}else{
										$estado  = "Anulado";
									}		
									
									echo '<tr>';
									echo '<td class="text-right">'.$id.'</td>';
									echo '<td class="text-left">'.$cliente.'</td>';
									echo '<td class="text-right">'.$cantidad.'</td>';
									echo '<td class="text-left">'.$estado.'</td>';
									echo '<td class="text-right">S/ '.$total.'</td>';
									echo '<td class="text-left">'.$fecha.'</td>';
									echo '<td class="text-right"><a href="'.base_url('cuenta/mis-pedidos/'.$id).'" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a></td>';
									echo '</tr>';			
								}			
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
		