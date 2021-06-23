<div class="page-content">
	<div class="page-header">
		<h1>Gestor
			<small><i class="ace-icon fa fa-angle-double-right"></i> Niveles de Acceso</small>
		</h1>
	
		<div class="botones pull-right">
		<button type="button" data-toggle="tooltip" title="" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg" data-original-title="Filter"><i class="fa fa-filter"></i></button>
		<a href="<?php echo base_url('usuarios/adicionar');?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
		<button type="submit" form="form-product" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/copy&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Copy"><i class="fa fa-copy"></i></button>
		<button type="button" data-toggle="tooltip" class="btn btn-danger btn_deleteuser" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
		</div>
	
	</div>
  	<div class="row">
		<div class="col-md-12">
		   <div class="clearfix">
				<div class="pull-right tableProductTools-container"></div>
			</div>                 
			<div>
			<table id="userlista" class="table table-bordered table-striped" role="grid">
			<thead>
				<tr>
					<th>#</th>
					<th>Permiso</th>
					<th>Fecha de Creación</th>
					<th>Situación</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($results as $r) {
					if($r->estado == 1){$estado = 'Ativo';}else{$estado = 'Inativo';}
					echo '<tr>';
					echo '<td>'.$r->idpermiso.'</td>';
					echo '<td>'.$r->nombre.'</td>';
					echo '<td>'.date('d/m/Y',strtotime($r->fech_reg)).'</td>';
					echo '<td>'.$estado.'</td>';
					echo '<td>
							  <a href="'.base_url().'permisos/editar/'.$r->idpermiso.'" class="btn btn-info tip-top btn-xs" title="Editar Permisos"><i class="fa fa-pencil" aria-hidden="true"></i></a>
							  <a href="#modal-excluir" role="button" data-toggle="modal" permissao="'.$r->idpermiso.'" class="btn btn-danger tip-top btn-xs" title="Desactivar Permisos"><i class="fa fa-remove fa-lg" aria-hidden="true"></i></a>
						  </td>';
					echo '</tr>';
				}?>
			</tbody>
		</table>
       
			</div>
		</div>
	</div>
</div>
