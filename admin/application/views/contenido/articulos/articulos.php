<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-file-text-o" aria-hidden="true"></i> Articulos</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="botones">       
        <a href="<?php echo base_url('articulos/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Nuevo</a> 
    </div>
  
    <div class="box-body">
                  
                <div class="table-responsive">
                         <table id="userlista" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titulo</th>
                                    <th>Tipo</th>                                   
									<th>Fech.Reg</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($articulos as $r) {  

                                    if($r->estado==1){
                                      $estado='<span class="label label-success">ACTIVO</label>';           
                                    }else{
                                      $estado='<span class="label label-danger">INACTIVO</label>';
                                    }

                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->titulo.'</td>';
                                    echo '<td>'.$r->tipo.'</td>';	
									echo '<td>'.$r->fech_reg.'</td>';
                                    echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                                   /*
                                 if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                        echo '<a href="'.base_url().'clientes/visualizar/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }
                                    */
                              
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
										$this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
                                  
                                        echo '<a href="'.base_url().'articulos/editar/'.$r->id.'" style="margin-right: 1%" class="btn btn-info btn-xs" title="Editar Empleado"><i class="glyphicon glyphicon-pencil icon-white"></i></a>'; 
                                    }

                                 
									if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
										$this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
										//echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->estado.'" class="btn btn-danger btn-xs btn_delete_e" title="Eliminar Empleado"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 

										echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->estado.'" data-modulo="usuario" class="btn btn-danger btn-xs btn_delete" title="Eliminar Empleado"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
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
                <!-- /.box-body -->
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
                <!-- /.footer -->
    </div>
    <!--
</section>
-->