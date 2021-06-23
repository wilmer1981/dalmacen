<script src="<?php echo base_url();?>assets/js/jquery.functions.popup.js"></script>
<div class="modal-dialog">
  <div class="modal-content">
		<div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Empleados</span>
		</div>  
  
		<div class="widget-content">
   
            <table id="empleadoslista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>EStado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($empleados as $r) {                    
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->nombres.' '.$r->apellidos.'</td>';
                                    echo '<td>'.$r->email.'</td>';
                                    echo '<td>'.$r->telefono.'</td>';
                                    echo '<td>'.$r->estado.'</td>';
                                    echo '<td>';
									?>
									<input type="hidden" id="idempleado<?php echo $r->id;?>" value="<?php echo $r->id;?>">
									<input type="hidden" id="empleado<?php echo $r->id;?>"   value="<?php echo $r->nombres.' '.$r->apellidos;?>">
																	<?php    
									echo '<a style="margin-right: 1%" class="btn  btn-default btn-xs close-modal" title="Agregar Empleado" data-id="'. $r->id.'"><i class="glyphicon glyphicon-saved"></i></a>'; 
									 
														   
                                  /*  if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                        echo '<a href="'.base_url().'clientes/visualizar/'.$r->customers_id.'-'.$r->customers_category.'-CC" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'eCliente')){
                                       // echo '<a href="'.base_url().'clientes/editar/'.$r->customers_id.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>'; 
                                        echo '<a href="'.base_url().'clientes/cuenta/'.$r->customers_id.'-'.$r->customers_category.'" style="margin-right: 1%" class="btn  btn-default btn-xs" title="Cambiar Clave"><i class="glyphicon glyphicon-user"></i></a>'; 
                                    }
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'eCliente')){
                                       // echo '<a href="'.base_url().'clientes/editar/'.$r->customers_id.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>'; 
                                        echo '<a href="'.base_url().'clientes/editar/'.$r->customers_id.'-'.$r->customers_category.'" style="margin-right: 1%" class="btn btn-info btn-xs" title="Editar Cliente"><i class="glyphicon glyphicon-pencil icon-white"></i></a>'; 
                                    }

                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'dCliente')){
                                        echo '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="'.$r->customers_id.'-'.$r->customers_category.'" style="margin-right: 1%" class="btn btn-danger btn-xs" title="Eliminar Cliente"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
                                    }     */         
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
 <script type="text/javascript">
		$(document).ready(function() {
		       $('#empleadoslista').DataTable({
		            responsive: true,
					lengthMenu: [5, 10, 25, 50, 100],
					//Set column definition initialisation properties.
				"columnDefs": [{ 
					"targets": [ -1 ], //last column
					"orderable": false, //set not orderable
				}],
		        });
				
		    });
</script>
 



