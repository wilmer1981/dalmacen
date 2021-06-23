<div class="box box-default">
  	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="glyphicon glyphicon-user"></i> Gestor de Grupo de Usuarios</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="botones"> 
		<button type="button" class="btn btn-success open-form" data-toggle="modal" data-target="#modal-register" >
		<i class="glyphicon glyphicon-plus icon-white"></i> Agregar Grupo</button>

	</div>
    <div class="box-body">
        <table id="userlista" class="table table-bordered table-striped" role="grid">
			<thead>
				<tr>
					<th>#</th>
					<th>Titulo</th>
					<th>Descripcion</th>
					<th>Fech.Registro</th>
					<th>Estado</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($roles as $r) {    

				if($r->estado==1){
						$estado='<span class="label label-success">ACTIVO</label>';						
					}else{
						$estado='<span class="label label-danger">INACTIVO</label>';
					}	
					$fechreg= fsalida_mysql($r->fech_reg,'-');
					echo '<tr>';
					echo '<td>'. $r->idtipo .'</td>';
					echo '<td>'. $r->nombre .'</a></td>';
					echo '<td>'. $r->descripcion .'</a></td>';
					echo '<td>'. $fechreg .'</a></td>';
					echo '<td>'. $estado .'</td>';
					echo '<td>';
			
					if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){
					   echo '<a role="button" data-toggle="modal" data-target="#modal-update" data-id="'.$r->idtipo.'" data-titulo="'.$r->nombre.'" data-descrip="'. $r->descripcion .'" class="btn btn-info btn-xs btn_update" title="Actualizar"><i class="glyphicon glyphicon-pencil icon-white"></i></a>'; 
			
					}

					if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){
						echo '<a role="button" data-id="'.$r->idtipo.'" data-status="'.$r->estado.'" data-modulo="usuario" class="btn btn-danger btn-xs btn_delete" title="Eliminar Usuario"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
					}    

				echo '</td>';
				echo '</tr>';
				}
				?>
			
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

<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				  <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Registrar Grupo</span>
	
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</div>                   
        <form id="formNivelAdd" name="formNivelAdd" method="post">                 
		        <div class="modal-body">				    
							<div class="row">
							  <div class="col-lg-12 left">
							  	  <div class="row">
									  <div class="col-xs-12">
										  <div class="form-group has-success">
											  <label for="inputMarca">Titulo:</label>
											  <input id="txtTitulo" type="text" maxlength="20" name="txtTitulo" required="" class="form-control" placeholder="Ingrese titulo menu" autofocus="">
										  </div>
									  </div>

								  </div>  
								  <div class="row">
									  <div class="col-xs-12">
										  <div class="form-group has-success">
											  <label for="inputMarca">Descripcion:</label>
											  <textarea id="txtDescripcion" type="textarea" name="txtDescripcion" class="form-control"></textarea>
										  </div>
									  </div>

								  </div>                              
							  </div>
							</div>						  
               	    	</div>
				        <div class="modal-footer"> 
    						<?php if (isset($custom_error) != '') {
    							echo '<div class="alert alert-danger">' . $custom_error . '</div>';
    						} ?>						
							<div id="status"></div>
							<input id="txtOpcion" name="txtOpcion" type="hidden" value="register">
							<button id="btn-cancelar" type="button" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-remove"></i> Cancelar</button> 
							<button id="btn-registerNivel" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>
                         						                   	
				        </div>
                    </form>                    
                </div>
     
                
			</div>
	</div>
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Actualizar Grupo</span>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</div>                   
			<form id="formNivelUpd" name="formNivelUpd" method="post">                 
		    <div class="modal-body">				    
				<div class="row">
					<div class="col-lg-12 left">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group has-success">
									<label for="inputMarca">Titulo:</label>
									<input id="txtTitulo" type="text" maxlength="20" name="txtTitulo" required="" class="form-control" placeholder="Ingrese titulo menu" autofocus="">
								</div>
							</div>
						</div>  
						<div class="row">
							<div class="col-xs-12">
							  <div class="form-group has-success">
								  <label for="inputMarca">Descripcion:</label>
								  <textarea id="txtDescripcion" type="textarea" name="txtDescripcion" class="form-control"></textarea>
							  </div>
							</div>
						</div>                              
					</div>
				</div>						  
            </div>
			<div class="modal-footer"> 
				<?php if (isset($custom_error) != '') {
					echo '<div class="alert alert-danger">' . $custom_error . '</div>';
				} ?>						
				<div id="statusUpd"></div>
				<input id="txtId" name="txtId" type="hidden">
				<button id="btn-cancelar" type="button" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-remove"></i> Cancelar</button> 
				<button id="btn-updateNivel" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Actualizar</button>									
			</div>
            </form>                    
        </div>            
	</div>
</div>





