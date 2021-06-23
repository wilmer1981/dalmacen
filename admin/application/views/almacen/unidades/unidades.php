<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Unidades de Medida</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="botones">       
        <button type="button" class="btn btn-success open-form" data-toggle="modal" data-target="#modal-register" >
    <i class="glyphicon glyphicon-plus icon-white"></i> Agregar Unidad</button>  
    </div>
  
    <div class="box-body">
                 
                  <div id="VerListado" class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Unidad Medida</th>  
                                    <th>Prefijo</th>                             
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($unidades as $r) {   

                                    if($r->estado==1){
                                      $estado='<span class="label label-success">ACTIVO</label>';           
                                    }else{
                                      $estado='<span class="label label-danger">INACTIVO</label>';
                                    }                   
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->nombre.'</td>';   
                                    echo '<td>'.$r->prefijo.'</td>';                                
                                    echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                                     if($this->permission->checkPermission($this->session->userdata('permiso'),'eMarca')){
                                        echo '<a href="#modal-editar" style="margin-right: 1%" class="btn btn-info btn-xs edit_button_unid" title="Editar Unidad" data-toggle="modal" data-name="'.$r->nombre.'" data-prefijo="'.$r->prefijo.'" data-id="'.$r->id.'"><i class="glyphicon glyphicon-pencil icon-white"></i></a>';
                                    }                   
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'dMarca')){
                                        //echo '<a href="#modal-excluir" role="button" data-toggle="modal" unidad="'.$r->id.'" style="margin-right: 1%" class="btn btn-danger btn-xs" title="Eliminar Unidad Medida"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 

                                         echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->estado.'" data-modulo="unidad" class="btn btn-danger btn-xs btn_delete" title="Eliminar Unidad de Medida"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
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


<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Registrar Unidad de Medida</span>
  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </button>
        </div>                   
            <form id="formUnidad" name="formUnidad" method="post">                 
                    <div class="modal-body">            
              <div class="row">
                <div class="col-lg-12 left">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="form-group has-success">
                        <label for="inputMarca">Nombre:</label>
                        <input id="txtNombre" type="text" maxlength="20" name="txtNombre" required="" class="form-control" placeholder="Ingrese Unidad de Medida" autofocus="">
                      </div>
                        <div class="form-group has-success">
                        <label for="inputMarca">Prefijo:</label>
                        <input id="txtPrefijo" type="text" maxlength="20" name="txtPrefijo" required="" class="form-control" placeholder="Ingrese Prefijo" autofocus="">
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
                <input name="opcion" id="opcion" type="hidden" value="register">
                <button id="btn-cancelar" type="button" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-remove"></i> Cancelar</button> 
                <button id="btn-registerUnd" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>
                                                        
                </div>
                    </form>                 
                </div>              
      </div>
  </div>


<div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Editar Unidad de Medida</h4>
          </div>
          <!--
           <form id="formCategoriaUp" name="formCategoriaUp" method="post"> 
           --> 
        
          <form method="post" action="<?php echo base_url(); ?>unidades/editar">    
              <div class="modal-body">
                   <div class="form-group has-success">
                    <label for="inputMarca">Unidad Medida:</label>
                    <input class="form-control unidad_id"  name="txtId" type="hidden">
                    <input class="form-control unidad_name" name="txtNombre" placeholder="Ingrese Unidad" required>
                  </div>   
                  <div class="form-group has-success">
                    <label for="inputMarca">Prefijo:</label>                
                    <input class="form-control unidad_prefijo" name="txtPrefijo" placeholder="Ingrese Prefijo" required>
                  </div>   
              </div>
              <div class="modal-footer">
                <div id="status"></div>
                <input  name="opcion" id="opcion" type="hidden" value="editar">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
            <!--
                <button type="button" class="btn btn-primary" id="btn-editCat"><i class="fa fa-floppy-o"></i>Modificar</button>
               -->
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Modificar</button>
              
              </div>
          </form>
        </div>
      </div>
  </div>

  <div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Eliminar Unidad Medida</h4>
          </div>     
           <form action="<?php echo base_url() ?>unidades/excluir" method="post" >   
              <div class="modal-body">
                   <input type="hidden" id="idUnidad" name="id" />
                   <h5 style="text-align: center">¿Realmente deseas eliminar esta Unidad de Medida?</h5>    
              </div>
              <div class="modal-footer">    
           
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>       
                <button class="btn btn-danger">Eliminar</button>
              
              </div>
          </form>
        </div>
      </div>
  </div>



