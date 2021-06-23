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
                              echo '<div class="hidden-sm hidden-xs action-buttons">
                                <a class="blue" href="#">
                                  <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>

                                <a class="green" href="'.base_url('permisos/editar/'.$r->id).'">
                                  <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red" href="#">
                                  <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                              </div>

                              <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                  <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                  </button>

                                  <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                    <li>
                                      <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                        <span class="blue">
                                          <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                        </span>
                                      </a>
                                    </li>

                                    <li>
                                      <a href="'.base_url('permisos/editar').'" class="tooltip-success" data-rel="tooltip" title="Edit">
                                        <span class="green">
                                          <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                                      </a>
                                    </li>

                                    <li>
                                      <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                        <span class="red">
                                          <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>';
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





