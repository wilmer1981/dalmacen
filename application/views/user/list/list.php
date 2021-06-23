<!--<div class="container">
	<div class="row">
	-->
		<div class="panel panel-default">
			<div class="panel-heading"><h5 class="panel-title">Lista de Usuario</h5></div>			
			<div class="panel-body">	
				<table class="table table-bordered table-hover table-striped">
				    <thead>
				      <tr>
				        <th>Foto</th>
				        <th>Nombre</th>
				        <th>Grupo</th>
				        <th>Estado</th>
				        <th class="td-actions" align="right">
				        	<a  class='btn btn-primary btn-xs btn-register' href='<?php echo base_url() ?>index.php/user/register' title='Register'>
				        		<i class='glyphicon glyphicon-plus-sign' title='Register'></i>
				        	</a><!--
				        	<a class="btn btn-primary btn-xs"></a>-->
						</th>
				      </tr>
				    </thead>	 			
				     <tbody>
						<?php
						 $cont=1;
					    foreach($users as $fila)
					    {
					    ?>
					        <tr>
					            <td>foto</td>
				                <td><?php echo $fila->apellidos.', '.$fila->nombre;?></td>
				                <td><?php echo $fila->grupo;?></td>
				                <td><?php echo $fila->status;?></td>
				                <td class="td-actions">
				                	<a href="<?php echo base_url() ?>index.php/user/user_edit/<?php echo $fila->id; ?>" data-id='<?php echo $fila->id; ?>' class="btn btn-info btn-xs btn-edit">
												<i class="glyphicon glyphicon-zoom-in"></i>													
									</a>&nbsp;&nbsp;&nbsp;
								<!--
								<td><a href='$edit' data-id='$row->id' class='btnedit' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='$delete' data-id='$row->id' class='btndelete' title='delete'><i class='glyphicon glyphicon-remove'></i></a></td>
									<a class="btn btn-danger btn-xs eliminar-user" href="<?php echo base_url() ?>index.php/user/eliminar_user/<?php echo $fila->id ?>"> Eliminar </a>
								
									<a class="btn btn-danger btn-xs delete-user" data-id="<?php echo $fila->id; ?>">
										<i class="glyphicon glyphicon-remove-circle"></i>
									</a>
								-->
								    <a href='<?php echo base_url() ?>index.php/user/edit_user' data-id='<?php echo $fila->id; ?>' class='btnedit' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i></a>&nbsp;&nbsp;&nbsp;						
									<a class="btn btn-danger btn-xs delete-user3" data-id="<?php echo $fila->id; ?>" href="<?php echo base_url() ?>index.php/user/eliminar_user3/<?php echo $fila->id ?>">
										<i class="glyphicon glyphicon-remove-circle"></i>
									 </a>
																
				                </td>
							</tr>
					    <?php
					    }
					    ?>
					</tbody>
				</table>
				<!--
				<ul class="pagination">-->
	            <?php
	              /* Se imprimen los números de página */           
	              echo $this->pagination->create_links();
	            ?>
	            <!--
	            </ul>-->
			</div>
		</div>
		<!--
	</div>
	
</div>-->
	<div id="form-delete" style="display:none" ></div>


