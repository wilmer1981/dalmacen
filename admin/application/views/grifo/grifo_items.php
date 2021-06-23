<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Aplicacion Grifo</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
<!--
	<div class="botones"> 

	
	<button type="button" class="btn btn-success open-form" data-toggle="modal" data-target="#modal-register" >
		<i class="fa fa-file-excel-o" aria-hidden="true"></i> Importar Data</button>
	
	</div>
	-->

  
    <div class="box-body">
               
                  <div class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <!--
									<th>Duracion</th>
									-->
                                    <th>Factura</th>
									<th>Cantidad</th>
									<th>Dinero</th>	
									<th>Hr Anterior</th>
									<th>Hr Actual</th>																			
                                    <!--
									<th>Estado</th>
									-->
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($empleados as $r) {  

                                    if($r->estado==1){
                                      $estado='<span class="label label-success">ACTIVO</label>';           
                                    }else{
                                      $estado='<span class="label label-danger">INACTIVO</label>';
                                    }

                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->fecha.'</td>';
                                   // echo '<td>'.$r->duracion.'</td>';
									echo '<td><a role="button" class="btnBuscarFactura" data-id="'.$r->id.'"  title="Ver Detalle"><span class="badge badge-info">'.$r->factura.'</span></a></td>';
									echo '<td>'.number_format($r->cantidad,3).'</td>';
                                    echo '<td>'.number_format($r->dinero,2).'</td>';								
                                    echo '<td>'.number_format($r->hr_anterior,3).'</td>';
									echo '<td>'.number_format($r->hr_actual,3).'</td>';
									//echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                                                          
									if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')){
									
										echo '<button type="button" data-id="'.$r->id.'" class="btn btn-default btn-xs btnBuscarFactura" title="Ver Detalle"><i class="glyphicon glyphicon-eye-open icon-white"></i></button>'; 
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
				
             
    </div>
	<div class="modal fade" id="modal_form_search" role="dialog" aria-hidden="true"></div>
	
	
	<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog">
			<div class="modal-content">
				<form role="form" name="formFile" id="formFile" method="post" enctype="multipart/form-data">
                <div class="modal-header">
				  <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Importar Data</span>
	
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</div>                   
                             
				<div class="modal-body">				    
					<div class="row">
					    <div class="col-md-12 left">
						    <div class="form-group">                                        
                                <input id="txtDescripcion" name="txtDescripcion" type="text" class="form-control" autofocus="" placeholder="Descripcicion" >     

                            </div> 
				     
                            <div class="form-group">                                        
                                <input id="imagenProd" type="file" class="form-control filestyle" name="imagenProd" data-placeholder="Seleccionar archivo" data-buttonText="Buscar archivo" data-buttonName="btn-default" data-buttonBefore="true" data-size="md">     

                            </div>                                             
                        </div>                                      
					</div>								  
				</div>
				<div class="modal-footer"> 
    						<?php if (isset($custom_error) != '') {
    							echo '<div class="alert alert-danger">' . $custom_error . '</div>';
    						} ?>						
					<div id="status"></div>
                    <button id="btn-cancelar" type="button" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-remove"></i> Cancelar</button> 
					<!--<button id="btn-register" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>-->
					<button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Cargar</button> 
                         						                   	
				</div>
            </form>                    
            </div>
     
                
		</div>
	</div>
	
	
