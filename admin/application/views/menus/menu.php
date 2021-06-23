<div class="page-content">
    <div class="page-header">
        <h1>Menus<small><i class="ace-icon fa fa-angle-double-right"></i>
                Gestor de Menus
            </small>
        </h1>
			
		<div class="botones pull-right">
		<button type="button" data-toggle="tooltip" title="" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg" data-original-title="Filter"><i class="fa fa-filter"></i></button>
		<a href="<?php echo base_url('menus/addmenu');?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
		<button type="submit" form="form-product" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/copy&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Copy"><i class="fa fa-copy"></i></button>
		<button type="button" data-toggle="tooltip" class="btn btn-danger btn_deleteuser" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
		</div>
		
    </div>
	<div class="espacio-fila"></div>  
   <div class="row">
      <div class="col-xs-12">
	  <!--
        <div class="clearfix">
        <div class="pull-right tableMenusTools-container"></div>
        </div> 
		-->		
        <div>		
        <table id="menus" class="table table-bordered table-striped" role="grid">
			<thead>
				<tr>
					<th class="text-center">
						  <label class="pos-rel">
							<input type="checkbox" class="ace" />
							<span class="lbl"></span>
						  </label>
					</th>
					<th>Titulo</th>
					<th>Publicado</th>
					<th>Despublicado</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($menus as $r) {    

				if($r->estado==1){
						$estado='<span class="label label-success">ACTIVO</label>';						
					}else{
						$estado='<span class="label label-danger">INACTIVO</label>';
					}			
					echo '<tr>';
					echo '<td class="center">
							  <label class="pos-rel">
								<input type="checkbox"  name="chkRegistro[]" value="'.$r->id.'" class="ace" />
								<span class="lbl"></span>
							  </label>
							</td>';
					echo '<td><a href="'. base_url('menus/items/'.$r->id) .'">'. $r->titulo .'</a></td>';
					echo '<td><a href="" class="badge badge-success" >'. $r->publicados .'</a></td>';
					echo '<td><a href="" class="badge" >'. $r->despublicados .'</a></td>';
					echo '<td>'. $estado .'</td>';
					echo '<td>';			   
			
					if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
			         $this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
							echo '<div class="hidden-sm hidden-xs action-buttons">
                                <a class="blue" href="#">
                                  <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>

                                <a class="green" href="'.base_url('menus/updatemenu/'.$r->id).'">
                                  <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red" href="#">
                                  <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                              </div>';
					}				  

				echo '</td>';
				   echo '</tr>';
				}
				?>			
			</tbody>
		</table>         
       </div>
      </div>
    </div>
</div>

