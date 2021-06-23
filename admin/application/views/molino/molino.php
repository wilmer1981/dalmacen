<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Aplicacion Molino</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<!--
	<div class="botones">       
        <a href="<?php echo base_url()?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Agregar Usuario</a> 
    </div>
	-->
  
    <div class="box-body">
            <!--      
                  <div id="VerListado">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
									<th>Permiso</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($empleados as $r) {  

                                    if($r->status==1){
                                      $estado='<span class="label label-success">ACTIVO</label>';           
                                    }else{
                                      $estado='<span class="label label-danger">INACTIVO</label>';
                                    }

                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->nombres.'</td>';
                                    echo '<td>'.$r->email.'</td>';
                                    echo '<td>'.$r->telefono.'</td>';
									echo '<td>'.$r->permiso.'</td>';
                                    echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                                   /*
                                 if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                        echo '<a href="'.base_url().'clientes/visualizar/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }
                                    */
                              
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){
                                  
                                        echo '<a href="'.base_url().'usuarios/editar/'.$r->id.'" style="margin-right: 1%" class="btn btn-info btn-xs" title="Editar Empleado"><i class="glyphicon glyphicon-pencil icon-white"></i></a>'; 
                                    }

                                 
									if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){
										//echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->estado.'" class="btn btn-danger btn-xs btn_delete_e" title="Eliminar Empleado"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 

										echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->status.'" data-modulo="usuario" class="btn btn-danger btn-xs btn_delete" title="Eliminar Empleado"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
									}       

                                echo '</td>';
                                   echo '</tr>';
                                }
                                ?>
                          
                            </tbody>
                        </table>  
                  </div>                
          
                </div>
         
                <div class="box-footer no-padding">
          
                </div>
       -->
    </div>
    <!--
</section>
-->