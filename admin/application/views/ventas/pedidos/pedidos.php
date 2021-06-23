<div class="page-content">
	<div class="page-header">
		<h1>Lista de
			<small><i class="ace-icon fa fa-angle-double-right"></i> Pedidos</small>
		</h1>	
		<div class="botones pull-right">
		<button type="button" data-toggle="tooltip" title="" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg" data-original-title="Filter"><i class="fa fa-filter"></i></button>
		<a href="<?php echo base_url('productos/adicionar');?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
		<!--
		<button type="submit" form="form-products" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/copy&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Copy"><i class="fa fa-copy"></i></button>
		-->
		<button type="button" data-toggle="tooltip" title="" class="btn btn-danger btn_deleteproduct" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
		</div>	
	</div>
	<div class="espacio-fila"></div>  
	<div class="row">
		<div class="col-md-12">
		   <div class="clearfix">
		   <!--
				<div class="pull-right tableProductTools-container"></div>
				-->
			</div>                 
			<div>
			<!--
			<div class="table-header">Results for "Latest Registered Domains"</div>
			-->
			<form role="form" name="form-products" id="form-products" method="post" >				
      		<table id="pedidos" class="table table-striped table-bordered table-hover">			
				<thead>
				   <tr>
						<th class="text-center">
							  <label class="pos-rel">
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							  </label>
						</th>						
						<th class="text-center">Pedido ID</th>
						<th class="text-center">Cliente</th>
						<th>Estado</th>
						<th>Total</th>
						<th>Fech.Pedido</th>									
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					  foreach ($pedidos as $r) {                              
					
						if($r->estado==1){
							$color='label label-warning';
							$estado = "Pendiente";
						}else if($r->estado==2){
							$color='label label-success';
							$estado = "Procesado";
						}else{
							$color='label label-danger';
							$estado = "Anulado";
						}						


						echo '<tr>';
						echo '<td class="center">
							  <label class="pos-rel">
								<input type="checkbox"  name="selected[]" value="'.$r->id.'" class="ace" />
								<span class="lbl"></span>
							  </label>
							</td>';					
						echo '<td class="text-center">'.$r->id.'</td>';
						echo '<td class="text-left">'.$r->cliente.'</td>';
						echo '<td class="text-center"><span class="'.$color.'">'.$estado.'</span></td>'; 
						echo '<td class="text-right">'.number_format($r->total, 2, '.', ' ').'</td>';
						echo '<td class="text-right">'.$r->fech_reg.'</td>';						
						echo '<td class="text-right">';	         
						
						if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){
							echo '<div class="hidden-sm hidden-xs action-buttons">
                                <a class="blue" href="'.base_url('pedidos/visualizar/'.$r->id).'">
                                  <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>';

                                /*echo '<a class="green" href="'.base_url('pedidos/edit/'.$r->id).'">
                                  <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>';*/

                                /*echo '<a class="red" href="#">
                                  <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>';*/
								
                              echo '</div>';
						
						}				         
						echo '</td>';
					echo '</tr>';
					}
					?>
				</tbody>
            </table>
			</form>
			</div>
		</div>
	</div>
</div>


