<div class="box box-default">
  	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="glyphicon glyphicon-user"></i> Usuarios</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="botones">       
        <a href="<?php echo base_url('usuarios/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Agregar Usuario</a> 
    </div>
    <div class="box-body">
        <table id="userlista" class="table table-bordered table-striped" role="grid">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Nivel Usuario</th>
					<th>Login</th>
					<th>Estado</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($usuarios as $r) {    

				if($r->estado==1){
						$estado='<span class="label label-success">ACTIVO</label>';						
					}else{
						$estado='<span class="label label-danger">INACTIVO</label>';
					}

					echo '<tr>';
					echo '<td>'.$r->id.'</td>';
					echo '<td>'.$r->nombres.' '.$r->apellidos.'</td>';
					echo '<td>'.$r->nivel.'</td>';
					echo '<td>'.$r->login.'</td>';
					echo '<td>'.$estado.'</td>';
					echo '<td>';				   
				/*
					if($this->permission->checkPermission($this->session->userdata('permiso'),'eCliente')){			
						echo '<a href="'.base_url().'clientes/cuenta/'.$r->id.'" style="margin-right: 1%" class="btn  btn-default btn-xs" title="Cambiar Clave"><i class="glyphicon glyphicon-user"></i></a>'; 
					}
					*/
					if($this->permission->checkPermission($this->session->userdata('permiso'),'eCliente')){
						echo '<a href="'.base_url().'usuarios/editar/'.$r->id.'" style="margin-right: 1%" class="btn btn-info btn-xs" title="Editar Usuario"><i class="glyphicon glyphicon-pencil icon-white"></i></a>'; 
					}

					if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){
						echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->estado.'" data-modulo="usuario" class="btn btn-danger btn-xs btn_delete" title="Eliminar Usuario"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
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
	<div class="box-footer no-padding">
	  <!--
	  <ul class="nav nav-pills nav-stacked">
		<li><a href="#">United States of America
		  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
		<li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
		</li>
		<li><a href="#">China
		  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
	  </ul>
	  -->
	</div>     
</div>





