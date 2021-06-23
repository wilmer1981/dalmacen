<div class="page-content">
	<div class="page-header">
		<h1>Catalogo
			<small><i class="ace-icon fa fa-angle-double-right"></i>Productos</small>
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
		<!--
		   <div class="clearfix">
				<div class="pull-right tableProductTools-container"></div>
			</div>  
			-->			
			<div>
			<form role="form" name="form-products" id="form-products" method="post" >				
      		<table id="productos" class="table table-striped table-bordered table-hover">			
				<thead>
				   <tr>
						<th class="text-center">
							  <label class="pos-rel">
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							  </label>
						</th>						
						<th class="text-center">Imagen</th>
						<th class="text-center">Codigo</th>
						<th>Producto</th>
						<th>Categoria</th>
						<th>Precio</th>
						<th>Stock</th> 
						<th>Estado</th>						
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					  foreach ($productos as $r) {                                  
						  $img  = $r->url_imagen;         
						if($img){
							//$image='uploads/'.$img;
							$image=$img;
							$image='<img class="img-thumbnail" src="'.base_url($image).'" />';
						}else{
							$image='assets/images/no_image.png';
							$image='<img class="img-thumbnail" width="307" height="240" src="'.base_url($image).'" />';
						}
						if($r->estado==1){
						  $class='label label-success';
						  $estado='ACTIVO';
						  
						}else{
						  $class='label label-danger';
						  $estado='INACTIVO';
						}
						

						if($r->stock <=5){
						  //$pintar='label label-warning';
						  $pintar='label label-danger';
						}else{
						  $pintar='label label-primary';
						}

						echo '<tr>';
						echo '<td class="center">
							  <label class="pos-rel">
								<input type="checkbox"  name="selected[]" value="'.$r->id.'" class="ace" />
								<span class="lbl"></span>
							  </label>
							</td>';
						echo '<td class="text-center">'.$image.'</td>';
						echo '<td class="text-center">'.$r->codigo.'</td>';
						echo '<td class="text-left">'.$r->nombre.'</td>';
						echo '<td class="text-center">'.$r->categoria.'</td>';
						echo '<td class="text-right">'.number_format($r->precio, 2, '.', ' ').'</td>';
						echo '<td class="text-center"><span class="'.$pintar.'">'.$r->stock.'</span></td>';   
						echo '<td class="text-center"><span class="'.$class.'">'.$estado.'</span></td>';  						
						echo '<td class="text-right">';				                       
						//if($this->permission->checkPermission($this->session->userdata('permiso'),'eProducto')){
						if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){
							echo '<a href="'.base_url('productos/editar/'.$r->id).'" class="green" title="Editar"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
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


