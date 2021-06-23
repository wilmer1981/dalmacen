<!--
<div class="box box-default">
  	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="glyphicon glyphicon-user"></i> Menu : Items (<?php echo $tipo[0]->titulo;?>)</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	
	<div class="botones"> 
	  <a href="<?php echo base_url('menu/menuadd/'.$tipo[0]->id) ?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Agregar</a> 
	</div>
    <div class="box-body">
	-->
	
	<div class="page-content">
    <div class="page-header">
        <h1>Menus<small><i class="ace-icon fa fa-angle-double-right"></i> <?php echo $titulomenu;?></small>
        </h1>
		<div class="botones pull-right">
		<button type="button" data-toggle="tooltip" title="" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg" data-original-title="Filter"><i class="fa fa-filter"></i></button>
		<a href="<?php echo base_url('menus/additems');?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
		<button type="submit" form="form-product" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/copy&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Copy"><i class="fa fa-copy"></i></button>
		<button type="button" data-toggle="tooltip" class="btn btn-danger btn_deleteuser" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
	<div class="espacio-fila"></div>  
    <div class="row">
      <div class="col-xs-12">
        <div class="clearfix">
		<!--
        <div class="pull-right tableUserTools-container"></div>
		-->
        </div>                 
        <div>	
        <table id="menuitems" class="table table-bordered table-striped" role="grid">
			<thead>
				<tr>
					<th class="text-center">
						  <label class="pos-rel">
							<input type="checkbox" class="ace" />
							<span class="lbl"></span>
						  </label>
					</th>
					<th>Titulo</th>					
					<th>Menu</th>			
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
					echo '<td><a href="'. base_url('menus/updateitems/'.$r->id) .'">'. $r->titulo .'</a> (Alias: '.$r->alias.')</td>';
					echo '<td>'. $r->menu .'</td>';	
					//echo '<td><a href="" class="badge badge-success" >'. $r->menu .'</a></td>';						
					echo '<td>'. $estado .'</td>';
					echo '<td>';		   
				
					if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
			         $this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
						echo '<div class="hidden-sm hidden-xs action-buttons">
                                <a class="blue" href="#">
                                  <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>

                                <a class="green" href="'.base_url('menus/updateitems/'.$r->id).'">
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
				<!--
				<tr>
					
				</tr>
				-->
			</tbody>
		</table>         
        </div>
      </div>
    </div>
</div>






