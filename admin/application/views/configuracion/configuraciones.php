<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-lock" aria-hidden="true"></i> Permisos</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	
   <div class="botones">       
        <a href="<?php echo base_url('permisos/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Agregar Permiso</a> 
    </div>
<?php
if(!$results){?>
   <div class="box-body">
        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Fecha de Creación</th>
                        <th>Situación</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Ningún Permiso fue Registrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php }else{ ?>

	<div class="box-body">
		<table class="table table-bordered ">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Fecha de Creación</th>
					<th>Situación</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($results as $r) {
					if($r->estado == 1){$estado = 'Ativo';}else{$estado = 'Inativo';}
					echo '<tr>';
					echo '<td>'.$r->idpermiso.'</td>';
					echo '<td>'.$r->nombre.'</td>';
					echo '<td>'.date('d/m/Y',strtotime($r->fech_reg)).'</td>';
					echo '<td>'.$estado.'</td>';
					echo '<td>
							  <a href="'.base_url().'permisos/editar/'.$r->idpermiso.'" class="btn btn-info tip-top btn-xs" title="Editar Permisos"><i class="fa fa-pencil" aria-hidden="true"></i></a>
							  <a href="#modal-excluir" role="button" data-toggle="modal" permissao="'.$r->idpermiso.'" class="btn btn-danger tip-top btn-xs" title="Desactivar Permisos"><i class="fa fa-remove fa-lg" aria-hidden="true"></i></a>
						  </td>';
					echo '</tr>';
				}?>
				<tr>
					
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?php echo $this->pagination->create_links();}?>



 
<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/permissoes/desativar" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Eliminar Permisos</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idPermissao" name="id" value="" />
    <h5 style="text-align: center">Desea realmente eliminar estos permisos?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Eliminar</button>
  </div>
  </form>
</div>


<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var permissao = $(this).attr('permissao');
        $('#idPermissao').val(permissao);

    });

});

</script>
