<?php
	$idcat = $this->uri->segment(3);
	
?>
<div class="page-content">
	<div class="page-header">
		<h1>Gestión
			<small><i class="ace-icon fa fa-angle-double-right"></i> Marcas</small>
		</h1>	
		<div class="botones pull-right">
		<button type="button" data-toggle="tooltip" title="" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg" data-original-title="Filter"><i class="fa fa-filter"></i></button>
		<a href="<?php echo base_url('productos/addmarca');?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
		<!--
		<button type="submit" form="form-product" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/copy&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Copy"><i class="fa fa-copy"></i></button>
		
		-->
		<button type="button" data-toggle="tooltip" title="" class="btn btn-danger btn_deletemarca" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
		</div>
	
	</div>
	<!--
	
	<div class="botones"> 

		<button type="button" class="btn btn-success open-form" data-toggle="modal" data-target="#modal-register" >
		<i class="glyphicon glyphicon-plus icon-white"></i> Agregar Categoria</button>	
	</div>
	-->
  
  	<div class="row">
		<div class="col-md-12">
		<!--
		   <div class="clearfix">
				<div class="pull-right tableBrandProducts-container"></div>
			</div> 
-->		
			<div>
			<form role="form" name="form-brands" id="form-brands" method="post" >	
            <table id="brandproducts" class="table table-bordered table-striped" role="grid">
				<thead>
					<tr>
						<th class="text-center">
							  <label class="pos-rel">
								<input type="checkbox" class="ace">
								<span class="lbl"></span>
							  </label>
						</th>
						<th>Marca</th>  
						<th>Fech.Reg</th>  
						<th>Imagen</th>  									
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($registros as $r) {   

						if($r->estado==1){
						  $estado='<span class="label label-success">ACTIVO</label>';           
						}else{
						  $estado='<span class="label label-danger">INACTIVO</label>';
						}

						echo '<tr>';
						echo '<td class="center">
							  <label class="pos-rel">
								<input type="checkbox" name="selected[]" value="'.$r->id.'" class="ace">
								<span class="lbl"></span>
							  </label>
							</td>';
						echo '<td><a href="'.base_url('productos/updatemarca/'.$r->id).'" title="Ver Subcategorias">'.$r->titulo.'</a></td>';  
						echo '<td><span class="badge">'.$r->fech_reg.'</span></td>';                        
						echo '<td><span class="badge">'.$r->fech_act.'</span></td>';                        
					   
						echo '<td>'.$estado.'</td>';
						echo '<td>';                                   
										
						if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
						$this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
						echo '<a class="green" href="'.base_url('productos/updatemarca/'.$r->id).'">
							  <i class="ace-icon fa fa-pencil bigger-130"></i></a>';    
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
			</form>
            </div>                
          
        </div>
    </div>
 </div>
	
	

<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				  <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Registrar Categoria</span>
	
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</div>                   
                <form id="formCategoria" name="formCategoria" method="post">                 
		                <div class="modal-body">				    
							<div class="row">
							  <div class="col-lg-12 left">
								  <div class="row">
									  <div class="col-xs-12">
										  <div class="form-group has-success">
											  <label for="inputMarca">Categoria:</label>
											  <input id="txtNombre" type="text" maxlength="20" name="txtNombre" required="" class="form-control" placeholder="Ingrese categoria" autofocus="">
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
							<button id="btn-register" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>
                         						                   	
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
            <h4 class="modal-title" id="myModalLabel">Editar Categoria</h4>
      </div>
   
       <form id="formUpdateCat" name="formUpdateCat" method="post"> 
         
    <!--
      <form method="post" action="<?php echo base_url(); ?>categorias/editar">
	  -->
    
          <div class="modal-body">
               <div class="form-group has-success">
                <label for="inputMarca">Categoria:</label>
                <input class="form-control cat_id"  name="txtId" type="hidden">
                <input class="form-control cat_name" name="txtNombre" placeholder="Ingrese Categoria" required>
              </div>     
          </div>
          <div class="modal-footer">
            <div id="statusE"></div>      
            <input class="form-control"  name="opcion" id="opcion" type="hidden" value="categoria">       
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
            <button  id="btn-editCat" type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Modificar</button>
       
		   <!--
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>Modificar</button>
          -->
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





