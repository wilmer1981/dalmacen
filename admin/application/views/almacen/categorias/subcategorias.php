<?php
 $idcat = $this->uri->segment(3);
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> CATEGORIA : <?php echo mb_strtoupper($categoria->nombre,'utf-8'); ?></span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="botones"> 

		<button type="button" class="btn btn-success open-form" data-toggle="modal" data-target="#modal-register" >
		<i class="glyphicon glyphicon-plus icon-white"></i> Agregar Subcategoria</button>	
<!--       
	   <a href="<?php echo base_url('categorias/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Agregar Categoria</a> 
    -->
	</div>
  
    <div class="box-body">                 
        <div id="VerListado" class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subcategoria</th>  
                                    <th>Publicados</th>                          
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subcategorias as $r) {                    
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td><a href="'.base_url().'categorias/items/'.$r->id.'" title="Ver Subcategorias">'.$r->nombre.'</a></td>';  
                                    echo '<td><span class="badge">'.$r->id.'</span></td>';                        
                                    echo '<td>'.$r->estado.'</td>';
                                    echo '<td>';
                                   
                                   if($this->permission->checkPermission($this->session->userdata('permiso'),'vCategoria')||
									$this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
                                        echo '<a href="'.base_url().'clientes/visualizar/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }						
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'eCategoria')||
									$this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
                                         /*echo '<button type="button" class="btn btn-info btn-xs editar_button" data-toggle="modal" data-name="'.$r->nombre.'" data-id="'.$r->id.'"><i class="glyphicon glyphicon-pencil icon-white"></i>
                                                  </button>';
                                                  */
                                         echo '<button type="button" class="btn btn-info btn-xs btn-xs edit_button_sub" 
                                                                data-toggle="modal" data-target="#myModal"
                                                                data-name="'.$r->nombre.'"
                                                                data-id="'.$r->id.'">
                                                                <i class="glyphicon glyphicon-pencil icon-white"></i>
                                                        </button>';  
                            

                                       // echo '<a style="margin-right: 1%" class="btn btn-info btn-xs" title="Editar Categoria" id="btn-edit" data-id="'.$r->id.'"><i class="glyphicon glyphicon-pencil icon-white"></i></a>';
                                        /* echo '<a href="'.base_url().'clientes/editar/'.$r->id.'" style="margin-right: 1%" class="btn btn-info btn-xs" title="Editar Cliente"><i class="glyphicon glyphicon-pencil icon-white"></i></a>';*/ 
                                    }

                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'dCategoria')){
                                        echo '<a href="#modal-excluir" role="button" data-toggle="modal" categoria="'.$r->id.'" style="margin-right: 1%" class="btn btn-danger btn-xs" title="Eliminar Categoria"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
                                    }   
                                     if($this->permission->checkPermission($this->session->userdata('permiso'),'dCategoria')){
                                        echo '<button type="button" class="btn btn-danger btn-xs btn-eliminar" data-name="'.$r->nombre.'" data-id="'.$r->id.'"><i class="glyphicon glyphicon-remove icon-white"></i>
                                                  </button>'; 
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
				  <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Registrar Subcategoria</span>
	
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</div>                   
                <form id="formSubcategoria" name="formSubcategoria" method="post">                 
		                <div class="modal-body">				    
							<div class="row">
							  <div class="col-lg-12 left">
								  <div class="row">
									  <div class="col-xs-12">
										  <div class="form-group has-success">
											  <label for="inputMarca">Subcategoria:</label>
                          <input id="txtIdCat" type="hidden" name="txtIdCat" required="" class="form-control" value="<?php echo $idcat;  ?>">
											  <input id="txtNombre" type="text" name="txtNombre" required="" class="form-control" placeholder="Ingrese subcategoria" autofocus="">
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
              <button id="btn-cancelar" type="button" class="btn btn-default" data-dismiss="modal" ><i class="fa fa-remove"></i> Cancelar</button> 
							<button id="btn-registerSub" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>
                         						                   	
				        </div>
                    </form>                    
                </div>
     
                
			</div>
	</div>
    <!-- END # MODAL LOGIN -->



    <!-- Modal for Edit button -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Editar Subcategoria</h4>
      </div>
   
       <form id="formUpdateSubcat" name="formUpdateSubcat" method="post">          

          <div class="modal-body">
               <div class="form-group has-success">
                <label for="inputMarca">Subcategoria:</label>            
                <input class="form-control subcat_id"  name="txtId" type="hidden">
                <input class="form-control subcat_name" name="txtNombre" placeholder="Ingrese Subcategoria" required>
              </div>     
          </div>
          <div class="modal-footer">
            <div id="statusE"></div>   
            <input class="form-control"  name="opcion" id="opcion" type="hidden" value="subcategoria">       
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
            <button  id="btn-editSubcat" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Modificar</button>
          </div>
      </form>
    </div>
  </div>
    </div>

<!--
        <div class="modal fade" id="modal_form_categoria" role="dialog" aria-hidden="true"></div>
        -->
	
	<div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Eliminar Categoria</h4>
          </div>     
           <form id="formDeleteCat" name="formDeleteCat" method="post">
              <div class="modal-body">
                   <input type="hidden" id="idCategoria" name="id" />
                   <h5 style="text-align: center">¿Realmente deseas eliminar esta Categoria?</h5>    
              </div>
              <div class="modal-footer">    
				<div id="statusD"></div>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>       
                <button type="button" class="btn btn-danger" id="btn-deleteCat">Eliminar</button>
                </div>
          </form>
        </div>
      </div>
  </div>





