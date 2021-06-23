<script src="<?php echo base_url();?>assets/js/jquery.functions.popup.js"></script>
<div class="modal-dialog">
  <div class="modal-content">
		<div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Clientes</span>
		</div>  
  
		<div class="widget-content">
   
            <table id="empleadoslista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                   <th>#</th>
                                    <th>Cliente</th>
                                    <th>Ruc</th>
                                    <th>Direccion</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $r) {                    
                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$r->cliente_nombre.'</td>';
                                    echo '<td>'.$r->num_documento.'</td>';
                                    echo '<td>'.$r->direccion.' - '.$r->ubigeo.'</td>';
                                    echo '<td>'.$r->estado.'</td>';
                                    echo '<td>';
									?>
									<input type="hidden" id="idcliente<?php echo $r->id;?>" value="<?php echo $r->id;?>">
                                    <input type="hidden" id="codcliente<?php echo $r->id;?>" value="<?php echo $r->codigo;?>">
									<input type="hidden" id="cliente<?php echo $r->id;?>"   value="<?php echo $r->cliente_nombre;?>">
									<?php    
									echo '<a style="margin-right: 1%" class="btn  btn-default btn-xs close-modal-p" title="Agregar Proveedor" data-id="'. $r->id.'"><i class="glyphicon glyphicon-saved"></i></a>'; 									 
						       
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
 



