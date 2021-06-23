<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i> Clientes</span></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="botones">       
        <a href="<?php echo base_url('clientes/adicionar')?>" class="btn btn-success btn-nuevo"><i class="glyphicon glyphicon-plus icon-white"></i> Agregar Cliente</a> 

        <a href="<?php echo base_url('reporte')?>" class="btn btn-success btn-nuevo"><i class="fa fa-print" aria-hidden="true"></i> Exportar</a> 
  </div>
  
    <div class="box-body">               
                  <div id="VerListado" class="table-responsive">
                         <table id="userlista" class="table table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Num.Doc</th>
                                    <th>Direccion</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $r) {   
                                   $tipo=$r->id_tipocliente;
                                   if($tipo==1){                                      
                                      $cliente=$r->nombres;
                                   }else{
                                      $cliente=$r->razon_social;
                                   } 

                                   if($r->estado==1){
                                      $estado='<span class="label label-success">ACTIVO</label>';           
                                    }else{
                                      $estado='<span class="label label-danger">INACTIVO</label>';
                                    }  

                                    echo '<tr>';
                                    echo '<td>'.$r->id.'</td>';
                                    echo '<td>'.$cliente.'</td>';
                                    echo '<td>'.$r->num_documento.'</td>';
                                    echo '<td>'.$r->direccion.'</td>';
                                    //echo '<td>'.$r->direccion.' - '.$r->provincia.' - '.$r->pais.'</td>';
                                    echo '<td>'.$estado.'</td>';
                                    echo '<td>';
                                   
                                  if($this->permission->checkPermission($this->session->userdata('permiso'),'vCliente')){
                                        echo '<a href="'.base_url().'clientes/visualizar/'.$r->id.'" style="margin-right: 1%" class="btn btn-default btn-xs" title="Ver mas detalles"><i class="glyphicon glyphicon-eye-open"></i></a>'; 
                                    }                                   
                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'eCliente')){
                                       // echo '<a href="'.base_url().'clientes/editar/'.$r->customers_id.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>'; 
                                        echo '<a href="'.base_url().'clientes/editar/'.$r->id.'" style="margin-right: 1%" class="btn btn-info btn-xs" title="Editar Cliente"><i class="glyphicon glyphicon-pencil icon-white"></i></a>'; 
                                    }

                                    if($this->permission->checkPermission($this->session->userdata('permiso'),'dCliente')){
                                        //echo '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="'.$r->id.'" style="margin-right: 1%" class="btn btn-danger btn-xs" title="Eliminar Cliente"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 

                                         echo '<a role="button" data-id="'.$r->id.'" data-status="'.$r->estado.'" data-modulo="cliente" class="btn btn-danger btn-xs btn_delete" title="Eliminar Cliente"><i class="glyphicon glyphicon-remove icon-white"></i></a>'; 
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
    <!--
</section>
-->
<!-- page script -->
<!--
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
-->
<script type="text/javascript">
//var table;

</script>




