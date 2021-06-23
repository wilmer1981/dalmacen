<div class="page-content">
	<div class="page-header">
		<h1>Gestión
			<small><i class="ace-icon fa fa-angle-double-right"></i> Banners</small>
		</h1>
	
		<div class="botones pull-right">
		<button type="button" data-toggle="tooltip" title="" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg" data-original-title="Filter"><i class="fa fa-filter"></i></button>
		
		<a href="<?php echo base_url('banners/adicionar');?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add New"><i class="fa fa-plus"></i></a>
					
		<button type="submit" form="form-product" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/copy&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Copy"><i class="fa fa-copy"></i></button>
		<button type="button" form="form-product" formaction="https://demo.opencart.com/admin/index.php?route=catalog/product/delete&amp;user_token=lSMeimbudzc3yHGZRH9ly3QuX1MkKy35" data-toggle="tooltip" title="" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-product').submit() : false;" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
		</div>
	
	</div>
	
	<div class="row">
		<div class="col-md-12">
		   <div class="clearfix">
				<div class="pull-right tableBannersTools-container"></div>
			</div>                 
			<div>
                <table id="banners" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                     <th class="text-center">
										  <label class="pos-rel">
											<input type="checkbox" class="ace">
											<span class="lbl"></span>
										  </label>
									</th>
                                    <th>Nombre</th>                 
                             
									<th>Fech.Reg</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($banners as $r) {  

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
                                    echo '<td>'.$r->titulo.'</td>';                             
                                    //echo '<td>'.$r->descripcion.'</td>';
									echo '<td>'.$r->fech_reg.'</td>';
                                    echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                                    echo '<div class="hidden-sm hidden-xs action-buttons">';
              if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
                    $this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
                                echo '<a class="blue" href="#">
                                  <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>';
                                 }
              if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
                    $this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){
                                echo '<a class="green" href="'.base_url().'banners/editar/'.$r->id.'">
                                  <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>';
                            }

              if($this->permission->checkPermission($this->session->userdata('permiso'),'cUsuario')||
                    $this->permission->checkPermission($this->session->userdata('permiso'),'mPex')){

                                echo '<a class="red" href="#">
                                  <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>';
                              }

                              echo '</div>';

                              
                         

                                 
									
										//echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->estado.'" class="btn btn-danger btn-xs btn_delete_e" title="Eliminar Empleado"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 


										//echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->estado.'" data-modulo="banner" class="btn btn-danger btn-xs btn_delete" title="Eliminar Banner"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
							     

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
    </div>               
          
</div>