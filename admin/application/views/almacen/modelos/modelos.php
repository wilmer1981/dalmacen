<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Modelos</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="botones">       
        <a href="<?php echo base_url('modelos/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Agregar Modelo</a> 
    </div>
  
    <div class="box-body">
                  
                  <div id="VerListado" class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Otro</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($modelos as $r) {                    
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->nombre.'</td>';
                                    echo '<td>'.$r->marca.'</td>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->estado.'</td>';
                                    echo '<td>';
                                   
                                if($this->permission->checkPermission($this->session->userdata('permiso'),'vModelo')){
                                        echo '<a href="'.base_url().'modelos/visualizar/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'eModelo')){
                                        echo '<a href="'.base_url().'modelos/editar/'.$r->id.'" style="margin-right: 1%" class="btn  btn-info btn-xs" title="Cambiar Clave"><i class="glyphicon glyphicon-pencil icon-white"></i></a>'; 
                                    }                             

                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'dModelo')){
                                        echo '<a href="#modal-excluir" role="button" data-toggle="modal" modelo="'.$r->id.'" style="margin-right: 1%" class="btn btn-danger btn-xs" title="Eliminar Cliente"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
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




