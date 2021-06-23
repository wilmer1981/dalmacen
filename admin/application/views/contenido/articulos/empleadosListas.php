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
									<input type="hidden" id="nombre<?php echo $r->id;?>"   value="<?php echo $r->nombres;?>">
                                    <input type="hidden" id="apellido<?php echo $r->id;?>"   value="<?php echo $r->apellidos;?>">
                                    <input type="hidden" id="telefono<?php echo $r->id;?>"   value="<?php echo $r->telefono;?>">
                                    <input type="hidden" id="numdoc<?php echo $r->id;?>"   value="<?php echo $r->num_documento;?>">
                                    <input type="hidden" id="direccion<?php echo $r->id;?>"   value="<?php echo $r->direccion;?>">
									<?php    
									echo '<a style="margin-right: 1%" class="btn  btn-default btn-xs close-emp" title="Agregar Empleado" data-id="'. $r->id.'"><i class="glyphicon glyphicon-saved"></i></a>'; 										   
                            
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
 



